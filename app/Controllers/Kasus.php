<?php

namespace App\Controllers;

use App\Models\KasusModel;

class Kasus extends BaseController
{
    public function __construct()
    {
        $this->kasus = new KasusModel;
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if (! empty($keyword)) {
            $this->kasus->groupStart()
                ->like('lokasi', $keyword)
                ->orLike('lat', $keyword)
                ->orLike('long', $keyword)
                ->orLike('status', $keyword)
                ->orLike('jenis_kelamin', $keyword)
                ->orLike('kota', $keyword)
                ->groupEnd();
        }

        $data = [
            'kasus' => $this->kasus->orderBy('created_at', 'DESC')->paginate(10, 'default'),
            'pager' => $this->kasus->pager,
            'keyword' => $keyword,
        ];

        return view('kasus/view_kasus', $data);
    }

    public function detail($id)
    {
        $data = [
            'kasus' => $this->kasus->find($id),
        ];

        return view('kasus/detail_kasus', $data);
    }

    public function new()
    {
        return view('kasus/form_tambah');
    }

    public function create()
    {
        $faker = \Faker\Factory::create('id_ID');
        $faker->unique(true);
        $id = '32'.$faker->unique()->randomNumber(6, true);

        $data = [
            'id' => $id,
            'lokasi' => $this->request->getVar('lokasi'),
            'kota' => $this->request->getVar('kota'),
            'lat' => $this->request->getVar('lat'),
            'long' => $this->request->getVar('long'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'status' => $this->request->getVar('status'),
            'tanggal_kasus' => $this->request->getVar('tanggal_kasus'),
        ];
        $this->kasus->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(base_url('kasus'))->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function edit($id)
    {
        $data = [
            'kasus' => $this->kasus->find($id),
        ];
        return view('kasus/form_ubah', $data);
    }

    public function update($id)
    {
        $data = [
            'lokasi' => $this->request->getVar('lokasi'),
            'kota' => $this->request->getVar('kota'),
            'lat' => $this->request->getVar('lat'),
            'long' => $this->request->getVar('long'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'status' => $this->request->getVar('status'),
            'tanggal_kasus' => $this->request->getVar('tanggal_kasus'),
        ];

        $this->kasus->update($id, $data);

        return redirect()->to(base_url('kasus'))->with('success', 'Data Berhasil Diupdate');
    }
}
