<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $data['user'] = $this->user->orderBy('created_at', 'DESC')->paginate(10);
        $data['pager'] = $this->user->pager;

        return view('user/user_view', $data);
    }

    public function new()
    {
        return view('user/form_tambah');
    }

    public function create()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $this->user->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(base_url('pengguna'))->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->user->getWhere(['id' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['user'] = $query->getRow();

                return view('user/form_edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        unset($data['_method']);

        $this->user->update($id, $data);

        return redirect()->to(base_url('pengguna'))->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $this->user->where(['id' => $id])->delete();

        return redirect()->to(base_url('pengguna'))->with('success', 'Data Berhasil Dihapus');
    }
}