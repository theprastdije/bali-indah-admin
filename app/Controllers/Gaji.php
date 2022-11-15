<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Gaji extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Gaji',
            'gaji' => $this->gajiModel->getGajiStaf(),
            'validation' => $this->validation
        ];
        return view('payroll/gaji/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Gaji',
            'staf' => $this->gajiModel->getUser(),
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('payroll/gaji/add', $data);
    }

    public function edit($gaji_staf_id)
    {
        $user_id = $this->gajiModel->getGajiStaf($gaji_staf_id)['user_id'];

        $tgl_register = date_create($this->gajiModel->getUserRegDate($user_id)['tgl_masuk']);
        $tgl_sekarang = date_create(date('Y-m-d'));
        $diff = date_diff($tgl_register, $tgl_sekarang)->format('%a');

        if (intval($diff) < 90) {
            $check = 'n';
        } else {
            $check = 'y';
        }
        // dd($check);
        $data = [
            'title' => 'Gaji',
            'staf' => $this->gajiModel->getUser(),
            'gaji' => $this->gajiModel->getGajiStaf($gaji_staf_id),
            'akun' => $this->akunModel->getAkun(),
            'tgl_register' => $this->gajiModel->getUserRegDate($user_id),
            'check' => $check,
            'validation' => $this->validation
        ];
        return view('payroll/gaji/edit', $data);
    }

    public function detail($gaji_staf_id)
    {
        // dd($this->gajiModel->getGajiStaf($gaji_staf_id));
        $data = [
            'title' => 'Gaji',
            'gaji' => $this->gajiModel->getGajiStaf($gaji_staf_id),
            'list' => $this->gajiBayarModel->listPembayaranGaji($gaji_staf_id),
            'check' => $this->gajiBayarModel->cekPembayaranGaji($gaji_staf_id),
            'pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'validation' => $this->validation
        ];
        return view('payroll/gaji/detail', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama_staf' => [
                'rules' => 'required|is_unique[gaji_staf.user_id]',
                'errors' => [
                    'required' => 'Nama staf tidak boleh kosong',
                    'is_unique' => 'Staf sudah terdaftar'
                ]
            ],
            'kode_akun_gaji' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jumlah_gaji' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah gaji tidak boleh kosong',
                    'numeric' => 'Jumlah gaji harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/gaji/add')->withInput();
        } else {
            $data = [
                'user_id' => $this->request->getVar('nama_staf'),
                'akun_gaji_id' => $this->request->getVar('kode_akun_gaji'),
                'jumlah_gaji' => $this->request->getVar('jumlah_gaji'),
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $this->gajiModel->insert($data);
            session()->setFlashdata('gaji', 'Data gaji staf berhasil ditambahkan');
            return redirect()->to('/gaji');
        }
    }

    public function update()
    {
        $gaji_staf_id = $this->request->getVar('gaji_staf_id');
        if (!$this->validate([
            'kode_akun_gaji' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jumlah_gaji' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah gaji tidak boleh kosong',
                    'numeric' => 'Jumlah gaji harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/gaji/edit/' . $gaji_staf_id)->withInput();
        } else {
            $data = [
                'akun_gaji_id' => $this->request->getVar('kode_akun_gaji'),
                'jumlah_gaji' => $this->request->getVar('jumlah_gaji'),
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $this->gajiModel->update($gaji_staf_id, $data);
            session()->setFlashdata('gaji', 'Data gaji staf berhasil diubah');
            return redirect()->to('/gaji');
        }
    }

    public function delete()
    {
        $gaji_staf_id = $this->request->getVar('gaji_id');
        $this->gajiModel->where('id', $gaji_staf_id)->delete();
        session()->setFlashdata('gaji', 'Data gaji staf berhasil dihapus');
        return redirect()->to('/gaji');
    }
}
