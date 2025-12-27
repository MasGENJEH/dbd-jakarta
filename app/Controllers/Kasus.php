<?php

namespace App\Controllers;

use App\Models\KasusModel;

class Kasus extends BaseController
{
    public function __construct()
    {
        $this->kasus = new KasusModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if (!empty($keyword)) {
            // 2. Jika ada keyword, lakukan pencarian pada kolom nik atau nama_lengkap
            // Gunakan groupStart/groupEnd agar operator OR tidak merusak ORDER BY
            $this->kasus->groupStart()
                           ->like('lokasi', $keyword)
                           ->orLike('lat', $keyword)
                           ->orLike('long', $keyword)
                           ->orLike('status', $keyword)
                           ->orLike('jenis_kelamin', $keyword)
                           ->groupEnd();
        }

        // 3. Ambil data dengan pagination (Tetap gunakan paginate agar pager bekerja)
        $data = [
            'kasus' => $this->kasus->orderBy('created_at', 'DESC')->paginate(10, 'default'),
            'pager' => $this->kasus->pager,
            'keyword' => $keyword, // Kirim keyword ke view untuk menampilkan kembali di input
        ];

        return view('kasus/view_kasus', $data);
    }
}
