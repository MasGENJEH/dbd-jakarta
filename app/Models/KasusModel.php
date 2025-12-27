<?php

namespace App\Models;

use CodeIgniter\Model;

class KasusModel extends Model
{
    protected $table = 'kasus_dbd';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'nik',
        'lokasi',
        'koordinat',
        'jenis_kelamin',
        'tanggal_lahir',
        'status_keluarga',
        'status_verifikasi_rt',
        'status_verifikasi_rw',
        'pendidikan_terakhir',
        'pekerjaan',
        'status_perkawinan'];
}
