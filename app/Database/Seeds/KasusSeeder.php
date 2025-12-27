<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KasusSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // 1. Ambil semua nomor KK yang sudah ada (Valid Foreign Keys)
        $db = \Config\Database::connect();

        $kasusDbd = [];

        // Atur agar NIK yang dihasilkan unik
        $faker->unique(true);

        // 2. Generate 100 data penduduk
        for ($i = 0; $i < 100; ++$i) {
            $gender = $faker->randomElement(['male', 'female']);
            $status = $faker->randomElement(['aktif', 'sembuh']);
            $jenis_kelamin_fk = ($gender == 'male') ? 'LAKI-LAKI' : 'PEREMPUAN';
            $status_fk = ($status == 'aktif') ? 'AKTIF' : 'SEMBUH';

            // Generate NIK unik 16 digit (dimulai 32 untuk kode provinsi Jawa Barat/Jawa Tengah)
            $id = '32'.$faker->unique()->randomNumber(6, true);

            $kasusDbd[] = [
                'id' => $id,
                'lokasi' => $faker->city(),
                'lat' => $faker->latitude($min = -6.40, $max = -6.10),
                'long' => $faker->longitude($min = 106.70, $max = 107.00),
                'jenis_kelamin' => $jenis_kelamin_fk,
                'status' => $status_fk,
                'tanggal_kasus' => $faker->dateTimeBetween('-2 years', '-1 years')->format('Y-m-d'),
            ];
        }

        // 3. Simpan semua data penduduk sekaligus ke tabel 'data_penduduk'
        // Gunakan nama tabel yang benar: 'data_penduduk'
        $this->db->table('kasus_dbd')->insertBatch($kasusDbd);
    }
}
