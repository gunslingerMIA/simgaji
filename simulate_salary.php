<?php

use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Helpers\PphTerCalculator;

// Ambil salah satu pegawai yang memiliki gapok valid (Kita gunakan dummy saja agar terlihat angka pastinya)
$pegawai = (object)[
    'nama_pegawai' => 'Pegawai Dummy (Gol IV)',
    'golongan' => 'IV/b',
    'masa_kerja_golongan' => 24,
    'ptkp_status' => 'K/2',
    'status_kepegawaian' => 'pns',
    'jabatan' => (object)[
        'jenis_jabatan' => 'struktural',
        'tunjangan_resmi' => 1260000,
        'tpp_penyetaraan' => 0
    ],
    'pasangan' => collect([ (object)['dapat_tunjangan' => true] ]),
    'anak' => collect([ (object)['dapat_tunjangan' => true], (object)['dapat_tunjangan' => true] ])
];

echo "=== SIMULASI PERHITUNGAN GAJI ===\n";
echo "Nama Pegawai   : " . $pegawai->nama_pegawai . "\n";
echo "Golongan       : " . $pegawai->golongan . "\n";
echo "Status PTKP    : " . $pegawai->ptkp_status . "\n";
echo "Jenis Jabatan  : " . $pegawai->jabatan->jenis_jabatan . "\n";
echo "Status         : " . $pegawai->status_kepegawaian . "\n";
echo "---------------------------------\n";

// 1. GAPOK (Hardcode dari contoh Bapak/Ibu: 5.182.000)
$gapok = 5182000;

if (strtolower($pegawai->status_kepegawaian) === 'cpns') {
    $gapok = floor($gapok * 0.8);
    echo "Gapok           : Rp " . number_format($gapok, 0, ',', '.') . " (CPNS 80%)\n";
}
echo "1. Gapok Aktual  : Rp " . number_format($gapok, 0, ',', '.') . "\n";

// 2. TUNJANGAN KELUARGA
$pasanganEligible = $pegawai->pasangan->where('dapat_tunjangan', true)->first();
$tunjIstri = $pasanganEligible ? $gapok * 0.10 : 0;
echo "2. Tunj Pasangan : Rp " . number_format($tunjIstri, 0, ',', '.') . " (10% dari gapok aktual)\n";

$anakEligibleCount = $pegawai->anak->where('dapat_tunjangan', true)->take(2)->count();
$tunjAnak = $gapok * 0.02 * $anakEligibleCount;
echo "3. Tunj Anak     : Rp " . number_format($tunjAnak, 0, ',', '.') . " (2% x $anakEligibleCount anak)\n";

// 3. TUNJANGAN JABATAN
$tunjJabatan = 0;
$tunjFungsional = 0;
$tunjUmum = 0;
            
$jenisJabatan = strtolower($pegawai->jabatan->jenis_jabatan ?? '');
$tunjanganResmi = (float) ($pegawai->jabatan->tunjangan_resmi ?? 0);
$isPenyetaraan = (float) ($pegawai->jabatan->tpp_penyetaraan ?? 0) > 0;

$gol = strtoupper($pegawai->golongan);
$fallbackUmum = 0;
if (str_starts_with($gol, 'II/')) $fallbackUmum = 180000;
elseif (str_starts_with($gol, 'III/')) $fallbackUmum = 185000;
elseif (str_starts_with($gol, 'IV/')) $fallbackUmum = 190000;

if (str_contains($jenisJabatan, 'struktural')) {
    $tunjJabatan = $tunjanganResmi;
} elseif (str_contains($jenisJabatan, 'fungsional')) {
    if ($isPenyetaraan) {
        $tunjJabatan = $tunjanganResmi;
    } else {
        $tunjFungsional = $tunjanganResmi;
        if ($tunjFungsional == 0) {
            $tunjUmum = $fallbackUmum;
        }
    }
} else {
    $tunjUmum = $tunjanganResmi;
    if ($tunjUmum == 0) {
        $tunjUmum = $fallbackUmum;
    }
}
$totalTunjJabatan = $tunjJabatan + $tunjFungsional + $tunjUmum;

echo "4. Tunj Jabatan  : Rp " . number_format($tunjJabatan, 0, ',', '.') . "\n";
echo "5. Tunj Fungsionl: Rp " . number_format($tunjFungsional, 0, ',', '.') . "\n";
echo "6. Tunj Umum     : Rp " . number_format($tunjUmum, 0, ',', '.') . "\n";
echo "   (Total Tunj. Jabatan: Rp " . number_format($totalTunjJabatan, 0, ',', '.') . ")\n";

// 4. TUNJANGAN BERAS
$jumlahKepala = 1 + ($pasanganEligible ? 1 : 0) + $anakEligibleCount;
$tunjBres = 72420 * $jumlahKepala;
echo "7. Tunj Beras    : Rp " . number_format($tunjBres, 0, ',', '.') . " (Rp 72.420 x $jumlahKepala jiwa)\n";

// 5. TUNJANGAN LAIN (BPJS, JKK, JKM)
$tunjBpjs = round(($gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan) * 0.04);
$tunjJkk = round($gapok * 0.0024);
$tunjJkm = round($gapok * 0.0072);
echo "8. Tunj BPJS (4%): Rp " . number_format($tunjBpjs, 0, ',', '.') . "\n";
echo "9. Tunj JKK      : Rp " . number_format($tunjJkk, 0, ',', '.') . "\n";
echo "10.Tunj JKM      : Rp " . number_format($tunjJkm, 0, ',', '.') . "\n";

// 6. TUNJANGAN PPh
$brutoBase = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBres + $tunjBpjs + $tunjJkk + $tunjJkm;
$ptkpStatus = $pegawai->ptkp_status ?? 'TK/0';
$terCategory = PphTerCalculator::getCategory($ptkpStatus);
$tunjPph = PphTerCalculator::calculate($terCategory, $brutoBase);

echo "11.Tunj PPh (TER): Rp " . number_format($tunjPph, 0, ',', '.') . " (Kategori: $terCategory, Bruto: Rp " . number_format($brutoBase, 0, ',', '.') . ")\n";
echo "---------------------------------\n";

// 7. KOTOR SEMENTARA
$kotorSementara = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBres + $tunjPph + $tunjBpjs + $tunjJkk + $tunjJkm;
echo ">> KOTOR SMENTARA: Rp " . number_format($kotorSementara, 0, ',', '.') . "\n";
echo "---------------------------------\n";

// 8. POTONGAN
$potIwp1 = ceil(($gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan) * 0.01);
$potIwp8 = floor(($gapok + $tunjIstri + $tunjAnak) * 0.08);

$potBpjs = $tunjBpjs;
$potJkk = $tunjJkk;
$potJkm = $tunjJkm;
$potPph = $tunjPph;

echo "1. Pot. IWP 1%   : Rp " . number_format($potIwp1, 0, ',', '.') . "\n";
echo "2. Pot. IWP 8%   : Rp " . number_format($potIwp8, 0, ',', '.') . "\n";
echo "3. Pot. BPJS     : Rp " . number_format($potBpjs, 0, ',', '.') . "\n";
echo "4. Pot. JKK      : Rp " . number_format($potJkk, 0, ',', '.') . "\n";
echo "5. Pot. JKM      : Rp " . number_format($potJkm, 0, ',', '.') . "\n";
echo "6. Pot. PPh      : Rp " . number_format($potPph, 0, ',', '.') . "\n";

$jumlahPotongan = $potIwp1 + $potIwp8 + $potBpjs + $potJkk + $potJkm + $potPph;
echo ">> JML POTONGAN  : Rp " . number_format($jumlahPotongan, 0, ',', '.') . "\n";
echo "---------------------------------\n";

// 9. BERSIH SEMENTARA
$bersihSementara = $kotorSementara - $jumlahPotongan;
echo ">> BERSIH SMNTARA: Rp " . number_format($bersihSementara, 0, ',', '.') . "\n";

// 10. PEMBULATAN & FINAL
$bersihResmi = ceil($bersihSementara / 100) * 100;
$tunjPembulatan = $bersihResmi - $bersihSementara;
$kotorResmi = $kotorSementara + $tunjPembulatan;

echo "   Tunj. Bulat   : Rp " . number_format($tunjPembulatan, 0, ',', '.') . "\n";
echo ">> KOTOR RESMI   : Rp " . number_format($kotorResmi, 0, ',', '.') . "\n";
echo "=================================\n";
echo ">> BERSIH RESMI  : Rp " . number_format($bersihResmi, 0, ',', '.') . "\n";
echo "=================================\n";
