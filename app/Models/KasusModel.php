<?php

namespace App\Models;

use CodeIgniter\Model;

class KasusModel extends Model
{
    protected $table = 'kasus_dbd';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'lokasi',
        'lat',
        'long',
        'jenis_kelamin',
        'tanggal_kasus',
        'status_'];
}
