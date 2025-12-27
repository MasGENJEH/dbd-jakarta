<?php

namespace App\Controllers;

use App\Models\KasusModel;
use App\Models\UserModel;

class Home extends BaseController
{
    private Bansos $bansos;

    public function __construct()
    {
        $this->kasus = new KasusModel();
        $this->pengguna = new UserModel();
    }

    public function index(): string
    {
        if (!session('id')) {
            return redirect()->to(base_url('auth/login'));
        }

         $data['kasus_dbd'] = $this->kasus
        ->orderBy('created_at', 'DESC')
        ->findAll();

        return view('home', $data);
    }
}
