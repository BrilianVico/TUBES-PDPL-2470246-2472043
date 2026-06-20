<?php

// Bootstrapping Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Tagihan;
use App\Factories\TagihanFactory;
use App\Abstracts\BeasiswaPersen;
use App\Abstracts\BeasiswaNominal;

// Reset DB state first
DB::table('beasiswa_siswa')->where('id', 1)->update(['sisa_potongan' => 1, 'status' => 'AKTIF']);
DB::table('tagihan')->where('id_siswa', 205)->where('bulan', 3)->where('tahun', 2026)->delete();

$id_siswa = 205;
$request = (object)[
    'jenis_tagihan' => 'SPP',
    'bulan' => 3,
    'tahun' => 2026,
    'tahun_ajaran' => '2025/2026',
    'semester' => null
];

// Run the exact logic from prosesPembuatanTagihan
$data = TagihanFactory::create($request->jenis_tagihan, $id_siswa);
$data['potongan_beasiswa'] = 0;
$kurangiBeasiswa = false;

$beasiswaAktif = DB::table('beasiswa_siswa as bs')
    ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
    ->where('bs.id_siswa', $id_siswa)
    ->where('bs.status', 'AKTIF')
    ->where('bs.sisa_potongan', '>', 0)
    ->whereIn('b.status', ['AKTIF', 'TUTUP'])
    ->first();

echo "Beasiswa Aktif Found:\n";
print_r($beasiswaAktif);

if ($beasiswaAktif) {
    $apakahWaktunyaTepat = false;

    $waktuRequest = ($request->tahun * 12) + $request->bulan;
    $waktuBuka    = ($beasiswaAktif->tahun_buka * 12) + $beasiswaAktif->bulan_buka;
    $waktuTutup   = ($beasiswaAktif->tahun_tutup * 12) + $beasiswaAktif->bulan_tutup;

    echo "waktuRequest: $waktuRequest, waktuBuka: $waktuBuka, waktuTutup: $waktuTutup\n";

    if (!is_null($beasiswaAktif->tahun_mulai_potongan) && !is_null($beasiswaAktif->bulan_mulai_potongan)) {
        $waktuMulaiPotongan = ($beasiswaAktif->tahun_mulai_potongan * 12) + $beasiswaAktif->bulan_mulai_potongan;
        echo "waktuMulaiPotongan: $waktuMulaiPotongan\n";
        if ($waktuRequest >= $waktuMulaiPotongan) {
            $apakahWaktunyaTepat = true;
        }
    } else {
        if ($waktuRequest > $waktuTutup) {
            $apakahWaktunyaTepat = true;
        }
    }

    echo "apakahWaktunyaTepat: " . ($apakahWaktunyaTepat ? "true" : "false") . "\n";

    if ($apakahWaktunyaTepat && strtoupper($beasiswaAktif->berlaku_untuk) == strtoupper($request->jenis_tagihan)) {
        $beasiswa = ($beasiswaAktif->jenis_potongan == 'PERSEN')
            ? new BeasiswaPersen($beasiswaAktif->nilai_potongan)
            : new BeasiswaNominal($beasiswaAktif->nilai_potongan);

        $data['potongan_beasiswa'] = $beasiswa->hitungPotongan($data['nominal']);
        $kurangiBeasiswa = true;
        echo "Discount Calculated: " . $data['potongan_beasiswa'] . "\n";
    }
}

$data['bulan'] = $request->bulan;
$data['tahun'] = $request->tahun;
$data['tahun_ajaran'] = $request->tahun_ajaran;
$data['semester'] = $request->semester;
$data['status'] = 'BELUM';

$key = ['id_siswa' => $id_siswa, 'jenis_tagihan' => $request->jenis_tagihan, 'bulan' => $request->bulan, 'tahun' => $request->tahun];
$tagihan = Tagihan::updateOrCreate($key, $data);

echo "Tagihan Created/Updated in DB:\n";
print_r($tagihan->toArray());

if ($kurangiBeasiswa && $tagihan->wasRecentlyCreated) {
    DB::table('beasiswa_siswa')
        ->where('id_siswa', $id_siswa)
        ->where('id_beasiswa', $beasiswaAktif->id_beasiswa)
        ->decrement('sisa_potongan');
    echo "Sisa potongan decremented.\n";
}

echo "Final sisa_potongan in DB:\n";
print_r(DB::table('beasiswa_siswa')->where('id', 1)->first());
