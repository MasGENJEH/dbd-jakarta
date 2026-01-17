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
            $this->kasus->groupStart()
                        ->like('lokasi', $keyword)
                        ->orLike('lat', $keyword)
                        ->orLike('long', $keyword)
                        ->orLike('status', $keyword)
                        ->orLike('jenis_kelamin', $keyword)
                        ->groupEnd();
        }

        $data = [
            'kasus' => $this->kasus->orderBy('created_at', 'DESC')->paginate(10, 'default'),
            'pager' => $this->kasus->pager,
            'keyword' => $keyword, // Kirim keyword ke view untuk menampilkan kembali di input
        ];

        return view('kasus/view_kasus', $data);
    }

    public function new()
    {
        return view('kasus/form_tambah');
    }

    public function create()
    {
        // Validasi input
        // $data = $this->request->getPost();
        $data = [
            'lokasi' => $this->request->getVar('lokasi'),
            'lat' => $this->request->getVar('lat'),
            'long' => $this->request->getVar('long'),
            'jenis_kelamin' => $this->request->getVar('status_keluarga'),
            'status' => $this->request->getVar('status'),
            'tanggal_kasus' => $this->request->getVar('tanggal_kasus'),
        ];
        $this->penduduk->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(base_url('penduduk'))->with('success', 'Data Berhasil Disimpan');
        }
    }
}
