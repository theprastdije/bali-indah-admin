<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Diskon extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Diskon Produk',
            'diskon' => $this->produkDiskonModel->getDiskon(),
            'diskon_aktif' => $this->produkDiskonModel->getDiskonAktif(),
            'validation' => $this->validation
        ];
        return view('diskon/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Diskon Produk',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('diskon/add', $data);
    }

    public function edit($diskon_id)
    {
        $data = [
            'title' => 'Diskon Produk',
            'akun' => $this->akunModel->getAkun(),
            'diskon' => $this->produkDiskonModel->getDiskon($diskon_id),
            'validation' => $this->validation
        ];
        return view('diskon/edit', $data);
    }

    public function detail($diskon_id)
    {
        $data = [
            'title' => 'Diskon Produk',
            'akun' => $this->akunModel->getAkun(),
            'diskon' => $this->produkDiskonModel->getDiskon($diskon_id),
            'validation' => $this->validation
        ];
        return view('diskon/detail', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama_diskon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama diskon tidak boleh kosong'
                ]
            ],
            'kode_akun_diskon' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'kode_diskon' => [
                'rules' => 'required|is_unique[diskon_produk.kode_diskon]|alpha_numeric',
                'errors' => [
                    'required' => 'Kode diskon tidak boleh kosong',
                    'is_unique' => 'Kode diskon sudah ada, silakan gunakan yang lain',
                    'alpha_numeric' => 'Kode diskon hanya boleh berisi huruf dan angka'
                ]
            ],
            'jumlah_diskon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah diskon tidak boleh kosong',
                    'numeric' => 'Jumlah diskon harus berupa angka'
                ]
            ],
            'satuan_diskon' => [
                'rules' => 'required|in_list[persen,jumlah]',
                'errors' => [
                    'required' => 'Satuan diskon tidak boleh kosong',
                    'in_list' => 'Satuan diskon tidak boleh kosong'
                ]
            ],
            'periode_awal_diskon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Periode mulai diskon tidak boleh kosong'
                ]
            ],
            'periode_akhir_diskon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Periode selesai diskon tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/diskon/add')->withInput();
        } else {
            $data = [
                'akun_diskon_id' => $this->request->getVar('kode_akun_diskon'),
                'nama_diskon' => $this->request->getVar('nama_diskon'),
                'deskripsi_diskon' => $this->request->getVar('deskripsi_diskon'),
                'kode_diskon' => $this->request->getVar('kode_diskon'),
                'jumlah_diskon' => $this->request->getVar('jumlah_diskon'),
                'satuan_diskon' => $this->request->getVar('satuan_diskon'),
                'periode_awal_diskon' => $this->request->getVar('periode_awal_diskon'),
                'periode_akhir_diskon' => $this->request->getVar('periode_akhir_diskon')
            ];
            $this->produkDiskonModel->insert($data);
            session()->setFlashdata('diskon', 'Data baru berhasil ditambahkan');
            return redirect()->to('/diskon');
        }
    }

    public function update()
    {
        $diskon_id = $this->request->getVar('diskon_id');
        if (!$this->validate([
            'nama_diskon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama diskon tidak boleh kosong'
                ]
            ],
            'kode_akun_diskon' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'kode_diskon' => [
                'rules' => 'required|is_unique[diskon_produk.kode_diskon,diskon_produk.id,' . $diskon_id . ']|alpha_numeric',
                'errors' => [
                    'required' => 'Kode diskon tidak boleh kosong',
                    'is_unique' => 'Kode diskon sudah ada, silakan gunakan yang lain',
                    'alpha_numeric' => 'Kode diskon hanya boleh berisi huruf dan angka'
                ]
            ],
            'jumlah_diskon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah diskon tidak boleh kosong',
                    'numeric' => 'Jumlah diskon harus berupa angka'
                ]
            ],
            'satuan_diskon' => [
                'rules' => 'required|in_list[persen,jumlah]',
                'errors' => [
                    'required' => 'Satuan diskon tidak boleh kosong',
                    'in_list' => 'Satuan diskon tidak boleh kosong'
                ]
            ],
            'periode_awal_diskon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Periode mulai diskon tidak boleh kosong'
                ]
            ],
            'periode_akhir_diskon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Periode selesai diskon tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/diskon/edit/' . $diskon_id)->withInput();
        } else {
            $data = [
                'akun_diskon_id' => $this->request->getVar('kode_akun_diskon'),
                'nama_diskon' => $this->request->getVar('nama_diskon'),
                'deskripsi_diskon' => $this->request->getVar('deskripsi_diskon'),
                'kode_diskon' => $this->request->getVar('kode_diskon'),
                'jumlah_diskon' => $this->request->getVar('jumlah_diskon'),
                'satuan_diskon' => $this->request->getVar('satuan_diskon'),
                'periode_awal_diskon' => $this->request->getVar('periode_awal_diskon'),
                'periode_akhir_diskon' => $this->request->getVar('periode_akhir_diskon')
            ];
            $this->produkDiskonModel->update($diskon_id, $data);
            session()->setFlashdata('diskon', 'Data berhasil diubah');
            return redirect()->to('/diskon');
        }
    }

    public function delete()
    {
        $diskon_id = $this->request->getVar('diskon_id');
        $this->produkDiskonModel->where('id', $diskon_id)->delete();
        session()->setFlashdata('diskon', 'Diskon berhasil dihapus');
        return redirect()->to('/diskon');
    }
}
