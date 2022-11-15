<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pembayaran extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Jenis Pembayaran',
            'pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'validation' => $this->validation
        ];
        return view('jenis_pembayaran/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Jenis Pembayaran',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('jenis_pembayaran/add', $data);
    }

    public function edit($jenis_pembayaran_id)
    {
        $data = [
            'title' => 'Jenis Pembayaran',
            'akun' => $this->akunModel->getAkun(),
            'pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran($jenis_pembayaran_id),
            'validation' => $this->validation
        ];
        return view('jenis_pembayaran/edit', $data);
    }

    public function detail($jenis_pembayaran_id)
    {
        $data = [
            'title' => 'Jenis Pembayaran',
            'pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran($jenis_pembayaran_id),
            'validation' => $this->validation
        ];
        return view('jenis_pembayaran/detail', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama_jenis_pembayaran' => [
                'rules' => 'required|is_unique[jenis_pembayaran.nama_jenis_pembayaran]',
                'errors' => [
                    'required' => 'Nama jenis pembayaran tidak boleh kosong',
                    'is_unique' => 'Nama sudah digunakan, silakan pakai nama lain'
                ]
            ],
            'kode_akun_pembayaran' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/add')->withInput();
        } else {
            $data = [
                'akun_jenis_pembayaran_id' => $this->request->getVar('kode_akun_pembayaran'),
                'nama_jenis_pembayaran' => $this->request->getVar('nama_jenis_pembayaran'),
                'deskripsi_jenis_pembayaran' => $this->request->getVar('deskripsi_jenis_pembayaran')
            ];
            $this->jenisPembayaranModel->insert($data);
            session()->setFlashdata('pembayaran', 'Jenis pembayaran berhasil ditambahkan');
            return redirect()->to('/pembayaran');
        }
    }

    public function update()
    {
        $jenis_pembayaran_id = $this->request->getVar('jenis_pembayaran_id');
        if (!$this->validate([
            'nama_jenis_pembayaran' => [
                'rules' => 'required|is_unique[jenis_pembayaran.nama_jenis_pembayaran,jenis_pembayaran.id,' . $jenis_pembayaran_id . ']',
                'errors' => [
                    'required' => 'Nama jenis pembayaran tidak boleh kosong',
                    'is_unique' => 'Nama sudah digunakan, silakan pakai nama lain'
                ]
            ],
            'kode_akun_pembayaran' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/edit/' . $jenis_pembayaran_id)->withInput();
        } else {
            $data = [
                'akun_jenis_pembayaran_id' => $this->request->getVar('kode_akun_pembayaran'),
                'nama_jenis_pembayaran' => $this->request->getVar('nama_jenis_pembayaran'),
                'deskripsi_jenis_pembayaran' => $this->request->getVar('deskripsi_jenis_pembayaran')
            ];
            $this->jenisPembayaranModel->update($jenis_pembayaran_id, $data);
            session()->setFlashdata('pembayaran', 'Jenis pembayaran berhasil diubah');
            return redirect()->to('/pembayaran');
        }
    }

    public function delete()
    {
        $jenis_pembayaran_id = $this->request->getVar('jenis_pembayaran_id');
        $this->jenisPembayaranModel->where('id', $jenis_pembayaran_id)->delete();
        session()->setFlashdata('pembayaran', 'Jenis pembayaran berhasil dihapus');
        return redirect()->to('/pembayaran');
    }
}
