<?php

namespace App\Controllers;

use App\Models\PendudukModel;

class Penduduk extends BaseController
{
    public function __construct()
    {
        $this->penduduk = new PendudukModel();
    }

    // READ (Tampilkan Daftar Data)
    public function index()
    {
        // 1. Ambil keyword dari URL (input name="keyword")
        $keyword = $this->request->getGet('keyword');

        if (!empty($keyword)) {
            // 2. Jika ada keyword, lakukan pencarian pada kolom nik atau nama_lengkap
            // Gunakan groupStart/groupEnd agar operator OR tidak merusak ORDER BY
            $this->penduduk->groupStart()
                           ->like('nik', $keyword)
                           ->orLike('nama_lengkap', $keyword)
                           ->orLike('nomor_kk', $keyword)
                           ->orLike('status_keluarga', $keyword)
                           ->orLike('pendidikan_terakhir', $keyword)
                           ->orLike('pekerjaan', $keyword)
                           ->orLike('status_perkawinan', $keyword)
                           ->groupEnd();
        }

        // 3. Ambil data dengan pagination (Tetap gunakan paginate agar pager bekerja)
        $data = [
            'penduduk' => $this->penduduk->orderBy('created_at', 'DESC')->paginate(10, 'default'),
            'pager' => $this->penduduk->pager,
            'keyword' => $keyword, // Kirim keyword ke view untuk menampilkan kembali di input
        ];

        return view('penduduk/view_penduduk', $data);
    }

    // CREATE (Tampilkan Form Tambah Data)
    public function new()
    {
        return view('penduduk/form_tambah');
    }

    // CREATE (Proses Simpan Data Baru)
    public function create()
    {
        // Validasi input
        // $data = $this->request->getPost();
        $data = [
            'nik' => $this->request->getVar('nik'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nomor_kk' => $this->request->getVar('nomor_kk'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'status_keluarga' => $this->request->getVar('status_keluarga'),
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'status_perkawinan' => $this->request->getVar('status_perkawinan'),
        ];
        $this->penduduk->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(base_url('penduduk'))->with('success', 'Data Berhasil Disimpan');
        }
    }

    // UPDATE (Tampilkan Form Edit Data)
    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->penduduk->getWhere(['nik' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['penduduk'] = $query->getRow();

                return view('penduduk/form_edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // UPDATE (Proses Perbarui Data)
    public function update($id)
    {
        // $data = $this->request->getPost();
        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'status_keluarga' => $this->request->getVar('status_keluarga'),
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'status_perkawinan' => $this->request->getVar('status_perkawinan'),
        ];
        unset($data['_method']);

        $this->penduduk->update($id, $data);

        return redirect()->to(base_url('penduduk'))->with('success', 'Data Berhasil Diupdate');
    }

    public function verifikasiRt($id)
    {
        $dataPenduduk = $this->penduduk->find($id);
        // if (session()->get('role') !== 'Supervisor') { ... throw access denied ... }
        // Data yang akan diupdate
        $data = [
            'status_verifikasi_rt' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'), // Opsional: catat waktu update
        ];
        unset($data['_method']);

        // Lakukan update pada data penduduk berdasarkan NIK
        $this->penduduk->update($id, [
            'status_verifikasi_rt' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('penduduk'))->with('success', 'Verifikasi Penduduk dengan NIK '.$id.' berhasil diubah menjadi DISETUJUI.');
    }

    public function verifikasiRw($id)
    {
        $dataPenduduk = $this->penduduk->find($id);
        // if (session()->get('role') !== 'Supervisor') { ... throw access denied ... }
        // Data yang akan diupdate
        $data = [
            'status_verifikasi_rt' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'), // Opsional: catat waktu update
        ];
        unset($data['_method']);

        // Lakukan update pada data penduduk berdasarkan NIK
        $this->penduduk->update($id, [
            'status_verifikasi_rw' => 'DISETUJUI',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('penduduk'))->with('success', 'Verifikasi Penduduk dengan NIK '.$id.' berhasil diubah menjadi DISETUJUI.');
    }

    // DELETE (Proses Hapus Data)
    public function delete($id)
    {
        $this->penduduk->where(['nik' => $id])->delete();

        return redirect()->to(base_url('penduduk'))->with('success', 'Data Berhasil Dihapus');
    }
}
