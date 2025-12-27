<?php

namespace App\Models;

use CodeIgniter\Model;

class KartuKeluargaModel extends Model
{
    protected $table = 'kartu_keluarga';
    protected $primaryKey = 'nomor_kk';
    protected $returnType = 'object';
    protected $allowedFields = [
        'nomor_kk',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'status_verifikasi_rt',
        'status_verifikasi_rw',
        'pendapatan',
        'skala_rumah'];

    public function getTopRtByKK()
    {
        return $this->select('rt, COUNT(nomor_kk) as total_kk')
                    ->groupBy('rt')
                    ->orderBy('total_kk', 'DESC')
                    ->findAll(); // Mengambil semua hasil ranking RT
    }

    public function search($keyword)
    {
        return $this->table('kartu_keluarga')
                    ->like('nomor_kk', $keyword)
                    ->orLike('rt', $keyword)
                    ->orLike('rw', $keyword)
                    ->orLike('dusun', $keyword)
                    ->orLike('status_verifikasi_rt', $keyword)
                    ->orLike('status_verifikasi_rw', $keyword)
                    ->orLike('skala_rumah', $keyword)
                    ->orLike('pendapatan', $keyword)
                    ->findAll();
    }
}
