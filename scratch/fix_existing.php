<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Tagihan;
use App\Abstracts\BeasiswaPersen;
use App\Abstracts\BeasiswaNominal;

$bulanFix = 3;
$tahunFix = 2026;
$waktuRequest = ($tahunFix * 12) + $bulanFix;

echo "Starting fix for March 2026 tagihans...\n";

// First, reset all beasiswa_siswa to status AKTIF and sisa_potongan to durasi_potongan IF they were decremented incorrectly.
// To be safe, let's restore sisa_potongan to 1 for student 205 (which is the only one in our database)
DB::table('beasiswa_siswa')->where('id', 1)->update(['sisa_potongan' => 1, 'status' => 'AKTIF']);

// Fetch all active scholarships
$beasiswaList = DB::table('beasiswa_siswa as bs')
    ->join('beasiswa as b', 'bs.id_beasiswa', '=', 'b.id_beasiswa')
    ->where('bs.status', 'AKTIF')
    ->select('bs.*', 'b.nilai_potongan', 'b.jenis_potongan', 'b.berlaku_untuk', 'b.bulan_tutup', 'b.tahun_tutup')
    ->get();

foreach ($beasiswaList as $bs) {
    $waktuTutup = ($bs->tahun_tutup * 12) + $bs->bulan_tutup;
    $apakahWaktunyaTepat = false;

    if (!is_null($bs->tahun_mulai_potongan) && !is_null($bs->bulan_mulai_potongan)) {
        $waktuMulai = ($bs->tahun_mulai_potongan * 12) + $bs->bulan_mulai_potongan;
        if ($waktuRequest >= $waktuMulai) {
            $apakahWaktunyaTepat = true;
        }
    } else {
        if ($waktuRequest > $waktuTutup) {
            $apakahWaktunyaTepat = true;
        }
    }

    if ($apakahWaktunyaTepat) {
        // Find the tagihan for this student and scholarship type
        $tagihan = DB::table('tagihan')
            ->where('id_siswa', $bs->id_siswa)
            ->where('jenis_tagihan', $bs->berlaku_untuk)
            ->where('bulan', $bulanFix)
            ->where('tahun', $tahunFix)
            ->first();

        if ($tagihan) {
            echo "Found tagihan ID {$tagihan->id_tagihan} for student ID {$bs->id_siswa} ({$bs->berlaku_untuk})\n";
            
            $beasiswaObj = ($bs->jenis_potongan == 'PERSEN')
                ? new BeasiswaPersen($bs->nilai_potongan)
                : new BeasiswaNominal($bs->nilai_potongan);

            $potongan = $beasiswaObj->hitungPotongan($tagihan->nominal);
            
            echo "Calculated potongan: Rp " . number_format($potongan, 0, ',', '.') . "\n";

            // Update tagihan
            DB::table('tagihan')
                ->where('id_tagihan', $tagihan->id_tagihan)
                ->update(['potongan_beasiswa' => $potongan]);

            // Decrement sisa_potongan
            DB::table('beasiswa_siswa')
                ->where('id', $bs->id)
                ->decrement('sisa_potongan');

            // Set to SELESAI if <= 0
            $updatedBs = DB::table('beasiswa_siswa')->where('id', $bs->id)->first();
            if ($updatedBs->sisa_potongan <= 0) {
                DB::table('beasiswa_siswa')
                    ->where('id', $bs->id)
                    ->update(['status' => 'SELESAI']);
                echo "Scholarship ID {$bs->id} status set to SELESAI.\n";
            }
            
            echo "Successfully updated tagihan ID {$tagihan->id_tagihan} and decremented scholarship.\n\n";
        } else {
            echo "No tagihan found for student ID {$bs->id_siswa} ({$bs->berlaku_untuk}) in March 2026.\n";
        }
    } else {
        echo "Scholarship ID {$bs->id} timing is not valid for March 2026.\n";
    }
}

echo "Fix completed.\n";
