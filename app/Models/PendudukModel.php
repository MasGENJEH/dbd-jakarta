<?php

namespace App\Models;

use CodeIgniter\Model;

class PendudukModel extends Model
{
    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    protected $returnType = 'object';
    protected $allowedFields = [
        'nik',
        'nomor_kk',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'status_keluarga',
        'status_verifikasi_rt',
        'status_verifikasi_rw',
        'pendidikan_terakhir',
        'pekerjaan',
        'status_perkawinan'];

    public function search($keyword)
    {
        return $this->table('penduduk')
                    ->like('nik', $keyword)
                    ->orLike('nama_lengkap', $keyword)
                    ->orLike('alamat', $keyword)
                    ->findAll();
    }
    // protected $useAutoIncrement = true;
    // protected $protectFields = true;
    // protected $useSoftDeletes = false;

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat = 'datetime';
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';
    // protected $deletedField = 'deleted_at';

    // // Validation
    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert = [];
    // protected $afterInsert = [];
    // protected $beforeUpdate = [];
    // protected $afterUpdate = [];
    // protected $beforeFind = [];
    // protected $afterFind = [];
    // protected $beforeDelete = [];
    // protected $afterDelete = [];
}
