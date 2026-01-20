<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKotaToKasus extends Migration
{
    public function up()
    {
        $fields = [
            'kota' => [
                'type' => 'ENUM',
                'constraint' => ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'],
                'null' => true,
                'after' => 'lokasi',
            ],
        ];
        $this->forge->addColumn('kasus_dbd', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('kasus_dbd', 'kota');
    }
}
