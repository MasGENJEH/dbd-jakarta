<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data untuk 3 Admin
        $adminUsers = [
            [
                'username' => 'budi',
                'role' => 'admin',
                'email' => 'budi@dbd.com',
                // Password: 'password123'
                'password' => password_hash('1234', PASSWORD_BCRYPT),
            ],
        ];

        // Data untuk 3 User
        $regularUsers = [
            [
                'username' => 'Maman',
                'role' => 'user',
                'email' => 'maman@dbd.com',
                // Password: 'user123'
                'password' => password_hash('1234', PASSWORD_BCRYPT),
            ],
        ];

        $data = array_merge($adminUsers, $regularUsers);

        // Masukkan data ke dalam tabel 'user'
        $this->db->table('user')->insertBatch($data);
    }
}
