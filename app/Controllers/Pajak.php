<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pajak extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pajak',
            'pajak' => $this->pajakModel->getPajak(),
            'validation' => $this->validation
        ];
        return view('pajak/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Pajak',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('pajak/add', $data);
    }

    public function edit($pajak_id)
    {
        $data = [
            'title' => 'Pajak',
            'akun' => $this->akunModel->getAkun(),
            'pajak' => $this->pajakModel->getPajak($pajak_id),
            'validation' => $this->validation
        ];
        return view('pajak/edit', $data);
    }

    public function detail($pajak_id)
    {
        $data = [
            'title' => 'Pajak',
            'pajak' => $this->pajakModel->getPajak($pajak_id),
        ];
        return view('pajak/detail', $data);
    }

    function getpajak()
    {
        $pajak = $this->pajakModel->getPajak();
        return json_encode($pajak);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama_pajak' => [
                'rules' => 'required|is_unique[pajak.jenis_pajak]',
                'errors' => [
                    'required' => 'Nama pajak tidak boleh kosong',
                    'is_unique' => 'Nama sudah digunakan, silakan pakai nama lain'
                ]
            ],
            'kode_akun_pajak' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'kategori_pajak' => [
                'rules' => 'in_list[penjualan,pembelian,penghasilan]',
                'errors' => [
                    'in_list' => 'Kategori pajak tidak boleh kosong'
                ]
            ],
            'tarif_pajak' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tarif pajak tidak boleh kosong',
                    'numeric' => 'Tarif pajak harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/pajak/add')->withInput();
        } else {
            $data = [
                'akun_pajak_id' => $this->request->getVar('kode_akun_pajak'),
                'jenis_pajak' => $this->request->getVar('nama_pajak'),
                'kategori_pajak' => $this->request->getVar('kategori_pajak'),
                'deskripsi_pajak' => $this->request->getVar('deskripsi_pajak'),
                'tarif_pajak' => $this->request->getVar('tarif_pajak')
            ];
            $this->pajakModel->insert($data);
            session()->setFlashdata('pajak', 'Jenis pajak berhasil ditambahkan');
            return redirect()->to('/pajak');
        }
    }

    public function update()
    {
        $pajak_id = $this->request->getVar('pajak_id');
        if (!$this->validate([
            'nama_pajak' => [
                'rules' => 'required|is_unique[pajak.jenis_pajak,pajak.id,' . $pajak_id . ']',
                'errors' => [
                    'required' => 'Nama pajak tidak boleh kosong',
                    'is_unique' => 'Nama sudah digunakan, silakan pakai nama lain'
                ]
            ],
            'kode_akun_pajak' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'kategori_pajak' => [
                'rules' => 'in_list[penjualan,pembelian,penghasilan]',
                'errors' => [
                    'in_list' => 'Kategori pajak tidak boleh kosong'
                ]
            ],
            'tarif_pajak' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tarif pajak tidak boleh kosong',
                    'numeric' => 'Tarif pajak harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/pajak/edit/' . $pajak_id)->withInput();
        } else {
            $data = [
                'akun_pajak_id' => $this->request->getVar('kode_akun_pajak'),
                'jenis_pajak' => $this->request->getVar('nama_pajak'),
                'kategori_pajak' => $this->request->getVar('kategori_pajak'),
                'deskripsi_pajak' => $this->request->getVar('deskripsi_pajak'),
                'tarif_pajak' => $this->request->getVar('tarif_pajak')
            ];
            $this->pajakModel->update($pajak_id, $data);
            session()->setFlashdata('pajak', 'Jenis pajak berhasil diubah');
            return redirect()->to('/pajak');
        }
    }

    public function delete()
    {
        $pajak_id = $this->request->getVar('pajak_id');
        $this->pajakModel->where('id', $pajak_id)->delete();
        session()->setFlashdata('pajak', 'Jenis pajak berhasil dihapus');
        return redirect()->to('/pajak');
    }
}
