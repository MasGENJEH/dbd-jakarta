<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->auth = new AuthModel();
    }

    public function index()
    {
    }

    public function login()
    {
        // return 'login';
        if (session('id')) {
            return redirect()->to(base_url('home'));
        }

        return view('auth/login_page');
    }

    public function loginProcess()
    {
        $data = $this->request->getPost();
        $query = $this->auth->getWhere(['email' => $data['email']]);
        $user = $query->getRow();
        unset($data['_method']);

        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $params = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                ];
                session()->set($params);

                return redirect()->to(base_url('home'));
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->remove('id');

        return redirect()->to(base_url('auth/login'));
    }

    public function register()
    {
        if (session('id')) {
            return redirect()->to(base_url('home'));
        }

        return view('auth/register');
    }

    public function registerProcess()
    {
        $validate = $this->validate([
            'username' => [
                'rules' => 'required|min_length[3]|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'min_length' => 'Username minimal 3 karakter',
                ],
            ],
            // 'email' => [
            //     'rules' => 'required|valid_email|is_unique[user.email]',
            //     'errors' => [
            //         'is_unique' => 'Email ini sudah terdaftar.',
            //     ],
            // ],
            // 'password' => [
            //     'rules' => 'required|min_length[6]',
            //     'errors' => [
            //         'min_length' => 'Password minimal harus 6 karakter.',
            //     ],
            // ],
            // 'password-confirm' => [
            //     'rules' => 'required|matches[password]',
            //     'errors' => [
            //         'matches' => 'Konfirmasi password tidak cocok dengan password.',
            //     ],
            // ],
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'user',
        ];
        unset($data['_method']);

        $this->auth->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(base_url('auth/login'))->with('success', 'Data Berhasil Disimpan');
        }
    }
}
