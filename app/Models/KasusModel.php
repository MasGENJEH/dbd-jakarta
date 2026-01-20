<?php

namespace App\Models;

use CodeIgniter\Model;

class KasusModel extends Model
{
    protected $table = 'kasus_dbd';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';

    protected $allowedFields = [
        'id',
        'lokasi',
        'kota',
        'lat',
        'long',
        'jenis_kelamin',
        'tanggal_kasus',
        'status'];
}
