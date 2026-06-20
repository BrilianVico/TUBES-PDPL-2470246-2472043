<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Factories\TagihanFactory;
use App\Models\Tagihan;
use App\Abstracts\BeasiswaPersen;
use App\Abstracts\BeasiswaNominal;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('tagihan as t')
            ->join('siswa as s', 't.id_siswa', '=', 's.id_siswa')
            ->select('t.*', 's.nis', 's.nama');

        if ($request->filled('bulan')) {
            $query->where('t.bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('t.tahun', $request->tahun);
        }

        $tagihan = $query->orderBy('t.id_tagihan', 'desc')->get();

        // Ambil daftar bulan dan tahun unik yang sudah dibuat tagihannya
        $availableMonths = DB::table('tagihan')
            ->select('bulan')
            ->distinct()
            ->orderBy('bulan', 'asc')
            ->pluck('bulan');

        $availableYears = DB::table('tagihan')
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.tagihan.index', compact('tagihan', 'availableMonths', 'availableYears'));
    }

    public function create()
    {
        $siswa = DB::table('siswa')->where('status_siswa', 'Aktif')->orderBy('nama', 'asc')->get();
        return view('admin.tagihan.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_tagihan' => 'required',
            'bulan'         => 'required',
            'tahun'         => 'required',
            'tahun_ajaran'  => 'required',
            'semester'      => 'nullable|numeric',
        ]);

        $daftarSiswaId = [];

        if ($request->mode_generate == 'satu') {
            $request->validate([
                'id_siswa' => 'required'
            ]);
            $daftarSiswaId[] = $request->id_siswa;

            // 1. Validasi SPP per Siswa
            if ($request->jenis_tagihan == 'SPP') {
                $cekSPPSiswa = DB::table('tagihan')->where('id_siswa', $request->id_siswa)->where('jenis_tagihan', 'SPP')->where('bulan', $request->bulan)->where('tahun', $request->tahun)->exists();
                if ($cekSPPSiswa) return back()->with('error', 'Tagihan SPP untuk siswa tersebut pada bulan ini sudah pernah digenerate.');
            }

            // 2. Validasi Buku & Seragam
            if (in_array($request->jenis_tagihan, ['Buku', 'Seragam'])) {
                $cekSekaliBayar = DB::table('tagihan')->where('id_siswa', $request->id_siswa)->where('jenis_tagihan', $request->jenis_tagihan)->exists();
                if ($cekSekaliBayar) return back()->with('error', 'Tagihan ' . $request->jenis_tagihan . ' sudah pernah dibuat.');
            }

            // 3. Validasi Pembangunan
            if ($request->jenis_tagihan == 'Pembangunan') {
                $cekPembangunanSemester = DB::table('tagihan')->where('id_siswa', $request->id_siswa)->where('jenis_tagihan', 'Pembangunan')->where('semester', $request->semester)->exists();
                if ($cekPembangunanSemester) return back()->with('error', 'Tagihan Pembangunan Semester ' . $request->semester . ' sudah pernah dibuat.');
            }

            // 4. Validasi Tagihan Harus Berurutan (Per Siswa)
            if (!in_array($request->jenis_tagihan, ['Buku', 'Seragam', 'Pembangunan']) && $request->bulan > 1) {
                $bulanSebelumnya = $request->bulan - 1;
                $cekBulanSebelumnya = DB::table('tagihan')
                    ->where('id_siswa', $request->id_siswa)
                    ->where('jenis_tagihan', $request->jenis_tagihan)
                    ->where('bulan', $bulanSebelumnya)
                    ->where('tahun', $request->tahun)
                    ->exists();

                if (!$cekBulanSebelumnya) {
                    return back()->with('error', "Gagal: Tagihan {$request->jenis_tagihan} bulan {$bulanSebelumnya} tahun {$request->tahun} belum dibuat. Harap generate secara berurutan dari bulan 1.");
                }
            }

        } else {
            $daftarSiswaId = DB::table('siswa')->where('status_siswa', 'Aktif')->pluck('id_siswa')->toArray();

            // 1. Validasi SPP Masal
            if ($request->jenis_tagihan == 'SPP') {
                $cekSPPGlobal = DB::table('tagihan')->where('jenis_tagihan', 'SPP')->where('bulan', $request->bulan)->where('tahun', $request->tahun)->exists();
                if ($cekSPPGlobal) return back()->with('error', 'Tagihan SPP masal untuk bulan tersebut sudah pernah digenerate.');
            }

            // 2. Validasi Tagihan Harus Berurutan (Masal)
            if (!in_array($request->jenis_tagihan, ['Buku', 'Seragam', 'Pembangunan']) && $request->bulan > 1) {
                $bulanSebelumnya = $request->bulan - 1;
                $cekBulanSebelumnyaGlobal = DB::table('tagihan')
                    ->where('jenis_tagihan', $request->jenis_tagihan)
                    ->where('bulan', $bulanSebelumnya)
                    ->where('tahun', $request->tahun)
                    ->exists();

                if (!$cekBulanSebelumnyaGlobal) {
                    return back()->with('error', "Gagal: Tagihan masal {$request->jenis_tagihan} bulan {$bulanSebelumnya} tahun {$request->tahun} belum dibuat. Harap generate secara berurutan dari bulan 1.");
                }
            }
        }

        $jumlahBerhasil = 0;
        foreach ($daftarSiswaId as $id_siswa) {
            if ($this->prosesPembuatanTagihan($id_siswa, $request)) {
                $jumlahBerhasil++;
            }
        }

        if ($jumlahBerhasil == 0) {
            return redirect()->back()->with('error', 'Tagihan tidak dapat digenerate (sudah ada atau ditolak sistem).');
        }

        // Update status beasiswa menjadi TUTUP untuk beasiswa yang sudah masuk batas bulannya
        DB::table('beasiswa')
            ->where('bulan_tutup', $request->bulan)
            ->where('tahun_tutup', $request->tahun)
            ->where('status', 'AKTIF')
            ->update(['status' => 'TUTUP']);

        // Set jadwal mulai potongan untuk bulan depan
        $bulanMulai = $request->bulan + 1;
        $tahunMulai = $request->tahun;

        if ($bulanMulai > 12) {
            $bulanMulai = 1;
            $tahunMulai++;
        }

        DB::table('beasiswa_siswa as bs')
            ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
            ->whereNull('bs.bulan_mulai_potongan')
            ->where('b.bulan_tutup', $request->bulan)
            ->where('b.tahun_tutup', $request->tahun)
            ->update([
                'bs.bulan_mulai_potongan' => $bulanMulai,
                'bs.tahun_mulai_potongan' => $tahunMulai,
            ]);

        return redirect()->route('admin.tagihan.index')->with('success', $jumlahBerhasil . ' tagihan berhasil diproses.');
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        if (strtoupper($tagihan->status) == 'LUNAS') return back()->with('error', 'Tagihan lunas tidak dapat diubah.');

        $request->validate([
            'id_siswa' => 'required', 'jenis_tagihan' => 'required', 'nominal' => 'required|numeric',
            'bulan' => 'required', 'tahun' => 'required', 'tahun_ajaran' => 'required', 'status' => 'required',
        ]);

        $tagihan->update($request->all());
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        if (strtoupper($tagihan->status) == 'LUNAS') return back()->with('error', 'Tagihan lunas tidak dapat dihapus.');
        $tagihan->delete();
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
    }

    private function prosesPembuatanTagihan($id_siswa, $request)
    {
        // Proteksi Duplikasi
        if (in_array($request->jenis_tagihan, ['Buku', 'Seragam']) && Tagihan::where('id_siswa', $id_siswa)->where('jenis_tagihan', $request->jenis_tagihan)->exists()) return false;
        if ($request->jenis_tagihan == 'Pembangunan' && Tagihan::where('id_siswa', $id_siswa)->where('jenis_tagihan', $request->jenis_tagihan)->where('semester', $request->semester)->exists()) return false;

        $data = TagihanFactory::create($request->jenis_tagihan, $id_siswa);
        $data['potongan_beasiswa'] = 0;
        $kurangiBeasiswa = false;

        // Cari beasiswa yang valid
        $beasiswaAktif = DB::table('beasiswa_siswa as bs')
            ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
            ->where('bs.id_siswa', $id_siswa)
            ->where('bs.status', 'AKTIF')
            ->where('bs.sisa_potongan', '>', 0)
            ->whereIn('b.status', ['AKTIF', 'TUTUP'])
            ->first();

        // PERBAIKAN LOGIKA BEASISWA: Memastikan pengecekan rentang waktu berjalan dengan benar
        if ($beasiswaAktif) {
            $apakahWaktunyaTepat = false;

            // Hitung nilai linear bulan untuk mempermudah perbandingan range (Tahun * 12 + Bulan)
            $waktuRequest = ($request->tahun * 12) + $request->bulan;
            $waktuBuka    = ($beasiswaAktif->tahun_buka * 12) + $beasiswaAktif->bulan_buka;
            $waktuTutup   = ($beasiswaAktif->tahun_tutup * 12) + $beasiswaAktif->bulan_tutup;

            // Jika jadwal mulai potongan spesifik sudah ditentukan di tabel beasiswa_siswa
            if (!is_null($beasiswaAktif->tahun_mulai_potongan) && !is_null($beasiswaAktif->bulan_mulai_potongan)) {
                $waktuMulaiPotongan = ($beasiswaAktif->tahun_mulai_potongan * 12) + $beasiswaAktif->bulan_mulai_potongan;
                if ($waktuRequest >= $waktuMulaiPotongan) {
                    $apakahWaktunyaTepat = true;
                }
            } else {
                // JIKA BELUM DISET: Beasiswa aktif jika bulan generate bernilai setelah bulan tutup pendaftaran
                if ($waktuRequest > $waktuTutup) {
                    $apakahWaktunyaTepat = true;
                }
            }

            // Jika waktunya valid DAN jenis tagihan sesuai (Contoh: SPP == SPP)
            if ($apakahWaktunyaTepat && strtoupper($beasiswaAktif->berlaku_untuk) == strtoupper($request->jenis_tagihan)) {
                $beasiswa = ($beasiswaAktif->jenis_potongan == 'PERSEN')
                    ? new BeasiswaPersen($beasiswaAktif->nilai_potongan)
                    : new BeasiswaNominal($beasiswaAktif->nilai_potongan);

                $data['potongan_beasiswa'] = $beasiswa->hitungPotongan($data['nominal']);
                $kurangiBeasiswa = true;
            }
        }

        $data['bulan'] = $request->bulan;
        $data['tahun'] = $request->tahun;
        $data['tahun_ajaran'] = $request->tahun_ajaran;
        $data['semester'] = $request->semester;
        $data['status'] = 'BELUM';

        $key = ['id_siswa' => $id_siswa, 'jenis_tagihan' => $request->jenis_tagihan, 'bulan' => $request->bulan, 'tahun' => $request->tahun];
        if ($request->jenis_tagihan == 'Pembangunan') $key['semester'] = $request->semester;

        $tagihan = Tagihan::updateOrCreate($key, $data);

        // Kurangi sisa potongan JIKA beasiswa terpakai DAN tagihan ini baru pertama kali dibuat
        if ($kurangiBeasiswa && $tagihan->wasRecentlyCreated) {
            DB::table('beasiswa_siswa')
                ->where('id_siswa', $id_siswa)
                ->where('id_beasiswa', $beasiswaAktif->id_beasiswa)
                ->decrement('sisa_potongan');

            // Ubah status jadi SELESAI jika kuota potongan habis
            if (DB::table('beasiswa_siswa')->where('id_siswa', $id_siswa)->where('id_beasiswa', $beasiswaAktif->id_beasiswa)->value('sisa_potongan') <= 0) {
                DB::table('beasiswa_siswa')
                    ->where('id_siswa', $id_siswa)
                    ->where('id_beasiswa', $beasiswaAktif->id_beasiswa)
                    ->update(['status' => 'SELESAI']);
            }
        }

        return $tagihan->wasRecentlyCreated;
    }
}
