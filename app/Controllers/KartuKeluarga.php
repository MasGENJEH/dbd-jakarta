<?php

namespace App\Controllers;

class KartuKeluarga extends BaseController
{
    public function index()
    {
        // 1. Ambil keyword dari URL (input name="keyword")
        $keyword = $this->request->getGet('keyword');

        if (!empty($keyword)) {
            // 2. Jika ada keyword, lakukan pencarian pada kolom nik atau nama_lengkap
            // Gunakan groupStart/groupEnd agar operator OR tidak merusak ORDER BY
            $this->kartu_keluarga->groupStart()
                                    ->like('nomor_kk', $keyword)
                                    ->orLike('dusun', $keyword)
                                    ->orLike('status_verifikasi_rt', $keyword)
                                    ->orLike('status_verifikasi_rw', $keyword)
                                    ->orLike('skala_rumah', $keyword)
                                    ->orLike('desa', $keyword)
                                    ->orLike('pendapatan', $keyword)
                                    ->groupEnd();
        }

        $data = [
            'kartu_keluarga' => $this->kartu_keluarga->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->kartu_keluarga->pager,
            'keyword' => $keyword,
        ];

        return view('kartu_keluarga/view_kk', $data);
    }

    public function new()
    {
        return view('kartu_keluarga/form_tambah');
    }

    public function create()
    {
        $data = $this->request->getPost();
        $this->kartu_keluarga->insert($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(base_url('kartu-keluarga'))->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->kartu_keluarga->getWhere(['nomor_kk' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['kartu_keluarga'] = $query->getRow();

                return view('kartu_keluarga/form_edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        // $data = $this->request->getPost();

        $data = [
            'alamat' => $this->request->getVar('alamat'),
            'nomor_kk' => $this->request->getVar('nomor_kk'),
            'rt' => $this->request->getVar('rt'),
            'rw' => $this->request->getVar('rw'),
            'dusun' => $this->request->getVar('dusun'),
            'desa' => $this->request->getVar('desa'),
            'pendapatan' => $this->request->getVar('pendapatan'),
            'skala_rumah' => $this->request->getVar('skala_rumah'),
        ];
        unset($data['_method']);

        $this->kartu_keluarga->update($id, $data);

        return redirect()->to(base_url('kartu-keluarga'))->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $this->kartu_keluarga->where(['nomor_kk' => $id])->delete();

        return redirect()->to(base_url('kartu-keluarga'))->with('success', 'Data Berhasil Dihapus');
    }

    public function verifikasiRt($id)
    {
        $dataPenduduk = $this->kartu_keluarga->find($id);
        // if (session()->get('role') !== 'Supervisor') { ... throw access denied ... }
        // Data yang akan diupdate
        $data = [
            'status_verifikasi_rt' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'), // Opsional: catat waktu update
        ];
        unset($data['_method']);

        // Lakukan update pada data kartu_keluarga berdasarkan NIK
        $this->kartu_keluarga->update($id, [
            'status_verifikasi_rt' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('kartu-keluarga'))->with('success', 'Verifikasi kartu_keluarga dengan Nomor KK '.$id.' berhasil diubah menjadi DISETUJUI.');
    }

    public function verifikasiRw($id)
    {
        $dataPenduduk = $this->kartu_keluarga->find($id);
        // if (session()->get('role') !== 'Supervisor') { ... throw access denied ... }
        // Data yang akan diupdate
        $data = [
            'status_verifikasi_rt' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'), // Opsional: catat waktu update
        ];
        unset($data['_method']);

        // Lakukan update pada data kartu_keluarga berdasarkan NIK
        $this->kartu_keluarga->update($id, [
            'status_verifikasi_rw' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('kartu-keluarga'))->with('success', 'Verifikasi kartu_keluarga dengan Nomor KK '.$id.' berhasil diubah menjadi DISETUJUI.');
    }
}
