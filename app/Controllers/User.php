<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $userDetail, $dateNow, $profileModel, $validation, $db;

    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->dateNow = date('Y-m-d H:i:s');
        $this->userDetail = $db->table('users_detail');
        $this->profileModel = new ProfileModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $user_id = user()->id;
        $user = $this->profileModel->getUser($user_id);
        $user_detail = $this->userDetail->where('user_id', $user_id)->get()->getRowArray();
        // dd($user, $user_detail);
        $data = [
            'title' => 'Profil',
            'user' => $user,
            'user_detail' => $user_detail,
            'validation' => $this->validation
        ];
        return view('user/index', $data);
    }

    public function edit($user_id)
    {
        $user_detail = $this->userDetail->where('user_id', $user_id)->get()->getRowArray();
        // dd($user_detail);
        $data = [
            'title' => 'Edit Profil',
            'user' => $this->profileModel->getUser($user_id),
            'user_detail' => $user_detail,
            'validation' => $this->validation
        ];
        return view('user/edit', $data);
    }

    public function update()
    {
        // dd($this->request->getVar(), $this->request->getFile('profile_img'), $this->dateNow);
        $user_id = $this->request->getVar('user_id');
        $user = $this->profileModel->find($user_id);
        $user_detail = $this->userDetail->select('id')->where('user_id', $user_id)->get()->getRowArray();
        // dd($user_detail);
        if (!$this->validate([
            'username' => [
                'rules' => 'required|alpha_numeric|min_length[8]|max_length[20]|is_unique[users.username,users.username,' . $user['username'] . ']',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
                    'min_length' => 'Username minimal 8 karakter',
                    'max_length' => 'Username maksimal 20 karakter',
                    'is_unique' => 'Username sudah digunakan, silakan pakai yang lain'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email,users.email,' . $user['email'] . ']',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah digunakan, silakan pakai yang lain'
                ]
            ],
            'telepon' => [
                'rules' => 'numeric|permit_empty',
                'errors' => [
                    'numeric' => 'No. telepon hanya boleh berisi angka'
                ]
            ],
            'profile_img' => [
                'rules' => 'permit_empty|max_size[profile_img,5120]|mime_in[profile_img,image/jpg,image/jpeg,image/png,image/svg,image/gif]|is_image[profile_img]',
                'errors' => [
                    'max_size' => 'Ukuran gambar melebihi 5 MB',
                    'mime_in' => 'Format file gambar tidak valid',
                    'is_image' => 'Tidak dapat menemukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/user/edit/' . $user_id)->withInput();
        } else {
            $profile_img = $this->request->getFile('profile_img');
            if ($profile_img->getError() == 4) {
                // Tidak ada file diupload
                $nama_file = $this->request->getVar('old_img');
            } else {
                // Ada file diupload
                if ($user['profile_img'] != 'default.svg') {
                    unlink('img/profile-img/' . $user['profile_img']);
                }
                $nama_file = $profile_img->getRandomName();
                $profile_img->move('img/profile-img', $nama_file);
            }
            // dd($profile_img);
            $this->profileModel->update($user_id, [
                'username' => $this->request->getVar('username'),
                'full_name' => $this->request->getVar('fullname'),
                'email' => $this->request->getVar('email'),
                'updated_at' => $this->dateNow,
                'profile_img' => $nama_file,
                'register_date' => $this->request->getVar('tgl_masuk')
            ]);
            if (!$user_detail) {
                // Data user belum dilengkapi
                $this->userDetail->insert([
                    'user_id' => $user_id,
                    'tel' => $this->request->getVar('telepon'),
                    'alamat' => $this->request->getVar('alamat'),
                    'gender' => $this->request->getVar('gender'),
                    'tempat_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir')
                ]);
            } else {
                // Data user sudah lengkap
                $this->userDetail->where('user_id', $user_id)->update([
                    'tel' => $this->request->getVar('telepon'),
                    'alamat' => $this->request->getVar('alamat'),
                    'gender' => $this->request->getVar('gender'),
                    'tempat_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir')
                ]);
            }
            session()->setFlashdata('user', 'Data berhasil diubah');
            return redirect()->to('/user');
        }
    }
}
