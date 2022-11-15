<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;

class Role extends BaseController
{
    protected $roleModel, $validation;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Role',
            'role' => $this->roleModel->getRole(),
            'validation' => $this->validation
        ];
        echo view('role/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'role' => [
                'rules' => 'required|is_unique[auth_groups.name]',
                'errors' => [
                    'required' => 'Nama role tidak boleh kosong',
                    'is_unique' => 'Nama role sudah ada, silakan pakai nama lain'
                ]
            ],
            'role_desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon isi deskripsi role'
                ]
            ]
        ])) {
            return redirect()->to('/role')->withInput();
        }
        $this->roleModel->save([
            'name' => $this->request->getVar('role'),
            'description' => $this->request->getVar('role_desc')
        ]);
        session()->setFlashdata('role', 'Role baru berhasil ditambahkan');
        return redirect()->to('/role');
    }

    public function edit($role_id)
    {
        $data = [
            'title' => 'Kelola Role',
            'role' => $this->roleModel->getRole($role_id),
            'validation' => $this->validation
        ];
        echo view('role/edit', $data);
    }

    public function update($role_id)
    {
        if (!$this->validate([
            'role' => [
                'rules' => 'required|is_unique[auth_groups.name]',
                'errors' => [
                    'required' => 'Nama role tidak boleh kosong',
                    'is_unique' => 'Nama role sudah ada, silakan pakai nama lain'
                ]
            ],
            'role_desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon isi deskripsi role'
                ]
            ]
        ])) {
            return redirect()->to('/role/edit/' . $this->request->getVar('id'))->withInput();
        }
        $this->roleModel->update($role_id, [
            'name' => $this->request->getVar('role'),
            'description' => $this->request->getVar('role_desc')
        ]);
        session()->setFlashdata('role', 'Role berhasil diubah');
        return redirect()->to('/role');
    }

    public function delete($role_id)
    {
        $this->roleModel->delete($role_id);
        session()->setFlashdata('role', 'Role berhasil dihapus');
        return redirect()->to('/role');
    }
}
