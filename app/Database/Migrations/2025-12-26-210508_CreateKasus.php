<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKasus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'lat' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'long' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['LAKI-LAKI', 'PEREMPUAN'],
                'null' => false,
            ],
            'tanggal_kasus' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => [
                    'AKTIF',
                    'SEMBUH',
                ],
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        // Menetapkan nik sebagai Primary Key
        $this->forge->addKey('id', true);

        // Membuat tabel
        $this->forge->createTable('kasus_dbd', true);
    }

    public function down()
    {
        $this->forge->dropTable('kasus_dbd', true);
    }
}
