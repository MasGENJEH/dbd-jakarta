<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Bansos extends BaseController
{
    // --- 1. DEFINISI KRITERIA DAN BOBOT (W) ---
    private function getKriteria()
    {
        return [
            'C1' => ['nama' => 'Pendapatan', 'sifat' => 'cost', 'bobot' => 0.40],
            'C2' => ['nama' => 'Skala Rumah', 'sifat' => 'cost', 'bobot' => 0.30],
            'C3' => ['nama' => 'Jumlah Tanggungan', 'sifat' => 'benefit', 'bobot' => 0.30],
        ];
    }

    /**
     * METHOD 1: Menampilkan Tabel Ranking Lengkap (dengan Pagination).
     */
    public function index()
    {
        // Panggil fungsi inti perhitungan
        $results = $this->_processSAWData();

        if (empty($results)) {
            $data = [
                'results' => [],
                'pager' => null,
                'totalItems' => 0,
                'kriteria' => $this->getKriteria(),
                'message' => 'Tidak ada data Kartu Keluarga yang memenuhi syarat nominasi (Pendapatan <= 5 Juta) untuk dihitung.',
            ];
            return view('bansos/view_bansos1', $data);
        }

        // --- LOGIKA PAGINATION ---
        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;

        $totalItems = count($results);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedResults = array_slice($results, $offset, $perPage);

        $pager = \Config\Services::pager();
        $pager->makeLinks($currentPage, $perPage, $totalItems);

        $data = [
            'results' => $paginatedResults,
            'pager' => $pager,
            'totalItems' => $totalItems,
            'kriteria' => $this->getKriteria(),
            'message' => 'Perhitungan SAW selesai. Hasil diurutkan dari nilai V tertinggi (paling berhak).',
        ];

        return view('bansos/view_bansos1', $data);
    }

    /**
     * METHOD 2: Menampilkan Ringkasan 5 KK Teratas (Tanpa Pagination).
     * Dapat digunakan untuk kebutuhan API atau widget Dashboard.
     */
    public function summary()
    {
        $results = $this->_processSAWData();
        return [
            'top_results' => array_slice($results, 0, 5), // Ambil 5 teratas
            'total_kk' => count($this->_processSAWData()),
            'kriteria' => $this->getKriteria(),
            'message' => 'Ringkasan 5 KK dengan skor SAW tertinggi.',
        ];
    }

    // --- FUNGSI INTI UNTUK MENGHITUNG DAN MERANKING SEMUA DATA ---
    private function _processSAWData()
    {
        $kriteria = $this->getKriteria();
        $bobot = [
            'C1' => $kriteria['C1']['bobot'],
            'C2' => $kriteria['C2']['bobot'],
            'C3' => $kriteria['C3']['bobot'],
        ];

        // Ambil data KK yang lolos filter eliminasi
        $alternatif = $this->getAlternatifData();

        if (empty($alternatif)) {
            return [];
        }

        // --- 3. MENENTUKAN NILAI MAX/MIN DARI MATRIKS KEPUTUSAN (X) ---
        $matriksX = [];
        $minMax = [
            'C1' => ['min' => PHP_FLOAT_MAX, 'max' => PHP_FLOAT_MIN],
            'C2' => ['min' => PHP_FLOAT_MAX, 'max' => PHP_FLOAT_MIN],
            'C3' => ['min' => PHP_FLOAT_MAX, 'max' => PHP_FLOAT_MIN],
        ];

        foreach ($alternatif as $kk) {
            // Mengakses properti objek (sesuai Model returnType = 'object')
            $C1 = (float) $kk->pendapatan;
            $C2 = (float) $kk->skala_rumah;
            $C3 = (float) $kk->jumlah_tanggungan;

            $matriksX[$kk->nomor_kk] = [
                'nomor_kk' => $kk->nomor_kk,
                'alamat' => $kk->alamat,
                'C1' => $C1,
                'C2' => $C2,
                'C3' => $C3,
            ];

            // Update nilai Max dan Min untuk Normalisasi
            $minMax['C1']['min'] = min($minMax['C1']['min'], $C1); $minMax['C1']['max'] = max($minMax['C1']['max'], $C1);
            $minMax['C2']['min'] = min($minMax['C2']['min'], $C2); $minMax['C2']['max'] = max($minMax['C2']['max'], $C2);
            $minMax['C3']['min'] = min($minMax['C3']['min'], $C3); $minMax['C3']['max'] = max($minMax['C3']['max'], $C3);
        }

        // --- 4. NORMALISASI MATRIKS (R) & 5. PERHITUNGAN NILAI PREFERENSI (V) ---
        $results = [];
        foreach ($matriksX as $nomor_kk => $x) {
            $r = [];

            // --- Normalisasi ---
            $minC1 = $minMax['C1']['min']; $maxC3 = $minMax['C3']['max']; // Ambil nilai min/max

            // C1 (Pendapatan - COST) = Min / X
            $r['C1'] = ($minC1 > 0 && $x['C1'] > 0) ? ($minC1 / $x['C1']) : 0;
            // C2 (Skala Rumah - COST) = Min / X
            $r['C2'] = ($minMax['C2']['min'] > 0 && $x['C2'] > 0) ? ($minMax['C2']['min'] / $x['C2']) : 0;
            // C3 (Jumlah Tanggungan - BENEFIT) = X / Max
            $r['C3'] = ($maxC3 > 0) ? ($x['C3'] / $maxC3) : 0;

            // --- Perhitungan Nilai Preferensi (V) ---
            // V = SUM(R_ij * W_j)
            $nilaiV = ($r['C1'] * $bobot['C1']) +
                ($r['C2'] * $bobot['C2']) +
                ($r['C3'] * $bobot['C3']);

            $results[] = [
                'nomor_kk' => $x['nomor_kk'],
                'alamat' => $x['alamat'],
                'nilai_kriteria' => $x,
                'matriks_normalisasi' => $r,
                'nilai_v' => $nilaiV,
            ];
        }

        // --- 6. RANKING: Urutkan berdasarkan Nilai V (Descending/Terbesar ke Terkecil) ---
        usort($results, function ($a, $b) {
            return $b['nilai_v'] <=> $a['nilai_v'];
        });

        return $results;
    }

    /**
     * Mengambil data KK dengan JUMLAH TANGGUNGAN dan FILTER ELIMINASI.
     * Filter: pendapatan <= 5.000.000
     */
    private function getAlternatifData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kartu_keluarga kk');

        $alternatif = $builder
            ->select('kk.nomor_kk, kk.alamat, kk.pendapatan, kk.skala_rumah, COUNT(p.nik) as jumlah_tanggungan')
            ->join('penduduk p', 'p.nomor_kk = kk.nomor_kk', 'left')

            // --- KONDISI ELIMINASI: Pendapatan <= 5.000.000 ---
            ->where('kk.pendapatan <=', 5000000)

            ->groupBy('kk.nomor_kk, kk.alamat, kk.pendapatan, kk.skala_rumah')
            ->get()
            ->getResult();

        return $alternatif;
    }
}