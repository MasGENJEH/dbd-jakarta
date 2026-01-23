<?php

namespace App\Controllers;

use App\Models\KasusModel;
use App\Models\UserModel;

class Home extends BaseController
{
    private Bansos $bansos;

    public function __construct()
    {
        $this->kasus = new KasusModel;
        $this->pengguna = new UserModel;
    }

    public function index(): string
    {
        if (! session('id')) {
            return redirect()->to(base_url('auth/login'));
        }

        $data['kasus_dbd'] = $this->kasus
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data['jumlah_kasus_dbd'] = $this->kasus
            ->orderBy('created_at', 'DESC')
            ->countAllResults();

        $data['jumlah_hari_ini'] = $this->kasus
            ->where('DATE(tanggal_kasus)', date('Y-m-d'))
            ->countAllResults();

        $data['jumlah_kasus_aktif'] = $this->kasus
            ->where('status', 'aktif')
            ->countAllResults();

        $data['jumlah_sembuh'] = $this->kasus
            ->where('status', 'sembuh')
            ->countAllResults();

        $data['jumlah_meninggal'] = $this->kasus
            ->where('status', 'meninggal')
            ->countAllResults();

        // Data Statistik Grafik (Kasus per Bulan di Tahun Ini)
        $tahun_ini = date('Y');
        $statistik = [];
        for ($i = 1; $i <= 12; $i++) {
            $statistik[] = $this->kasus
                ->where('YEAR(tanggal_kasus)', $tahun_ini)
                ->where('MONTH(tanggal_kasus)', $i)
                ->countAllResults();
        }
        $data['statistik'] = $statistik;

        // Data Ranking Kota (Zona Merah)
        $data['ranking'] = $this->kasus
            ->select('kota, count(*) as jumlah')
            ->whereIn('kota', ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'])
            ->groupBy('kota')
            ->orderBy('jumlah', 'DESC')
            ->get()
            ->getResult();

        return view('home', $data);
    }
}
