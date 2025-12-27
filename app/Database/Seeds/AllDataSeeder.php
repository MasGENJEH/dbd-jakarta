<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllDataSeeder extends Seeder
{
    public function run()
    {
        $this->call('KasusSeeder'); // Memanggil UserSeeder
        $this->call('UserSeeder'); // Memanggil PostSeeder
    }
}
