<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Akun extends BaseController
{
    protected $db, $akunModel, $akunCat, $validation;

    public function __construct()
    {
        $db = db_connect();
        $this->akunCat = $db->table('kategori_akun');
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Akun',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('akun/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Kelola Akun',
            'kategori' => $this->akunCatModel->getKategoriAkun(),
            'validation' => $this->validation
        ];
        return view('akun/add', $data);
    }

    public function edit($akun_id)
    {
        $data = [
            'title' => 'Kelola Akun',
            'akun' => $this->akunModel->getAkun($akun_id),
            'kategori' => $this->akunCatModel->getKategoriAkun(),
            'validation' => $this->validation
        ];
        return view('akun/edit', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama_akun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama akun tidak boleh kosong',
                ]
            ],
            'kategori_akun' => [
                'rules' => 'is_not_unique[kategori_akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kategori akun tidak boleh kosong'
                ]
            ],
            'kode_akun' => [
                'rules' => 'required|numeric|is_unique[akun.kode_akun]',
                'errors' => [
                    'required' => 'Kode akun tidak boleh kosong',
                    'numeric' => 'Kode akun harus berupa angka',
                    'is_unique' => 'Kode akun sudah digunakan, silakan pakai yang lain'
                ]
            ]
        ])) {
            return redirect()->to('/akun/add')->withInput();
        } else {
            $data = [
                'kategori_akun_id' => $this->request->getVar('kategori_akun'),
                'nama_akun' => $this->request->getVar('nama_akun'),
                'kode_akun' => $this->request->getVar('kode_akun')
            ];
            $this->akunModel->insert($data);
            session()->setFlashdata('akun', 'Akun baru berhasil ditambahkan');
            return redirect()->to('/akun');
        }
    }

    public function update()
    {
        $akun_id = $this->request->getVar('akun_id');
        if (!$this->validate([
            'nama_akun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama akun tidak boleh kosong',
                ]
            ],
            'kategori_akun' => [
                'rules' => 'is_not_unique[kategori_akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kategori akun tidak boleh kosong'
                ]
            ],
            'kode_akun' => [
                'rules' => 'required|numeric|is_unique[akun.kode_akun,akun.id,' . $akun_id . ']',
                'errors' => [
                    'required' => 'Kode akun tidak boleh kosong',
                    'numeric' => 'Kode akun harus berupa angka',
                    'is_unique' => 'Kode akun sudah digunakan, silakan pakai yang lain'
                ]
            ]
        ])) {
            return redirect()->to('/akun/edit/' . $akun_id)->withInput();
        } else {
            $data = [
                'kategori_akun_id' => $this->request->getVar('kategori_akun'),
                'nama_akun' => $this->request->getVar('nama_akun'),
                'kode_akun' => $this->request->getVar('kode_akun')
            ];
            $this->akunModel->update($akun_id, $data);
            session()->setFlashdata('akun', 'Akun berhasil diupdate');
            return redirect()->to('/akun');
        }
    }

    public function delete()
    {
        $akun_id = $this->request->getVar('akun_id');
        $this->akunModel->where('id', $akun_id)->delete();
        session()->setFlashdata('akun', 'Akun berhasil dihapus');
        return redirect()->to('/akun');
    }

    public function category()
    {
        $data = [
            'title' => 'Kelola Akun',
            'kategori' => $this->akunCatModel->getKategoriAkun(),
            'validation' => $this->validation
        ];
        return view('akun/category', $data);
    }

    public function addcategory()
    {
        if (!$this->validate([
            'nama_kategori_akun' => [
                'rules' => 'required|is_unique[kategori_akun.kategori_akun]',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong',
                    'is_unique' => 'Nama kategori sudah ada, silakan pakai nama lain'
                ]
            ],
            'kode_kategori_akun' => [
                'rules' => 'required|is_unique[kategori_akun.kode_kategori_akun]',
                'errors' => [
                    'required' => 'Kode kategori tidak boleh kosong',
                    'is_unique' => 'Kode kategori sudah ada, silakan pakai yang lain'
                ]
            ]
        ])) {
            return redirect()->to('/akun/category')->withInput();
        }
        $this->akunCatModel->insert([
            'kategori_akun' => $this->request->getVar('nama_kategori_akun'),
            'kode_kategori_akun' => $this->request->getVar('kode_kategori_akun')
        ]);
        session()->setFlashdata('akuncat', 'Kategori akun baru berhasil ditambahkan');
        return redirect()->to('/akun/category');
    }

    public function editcategory()
    {
        $kategori_akun_id = $this->request->getVar('kategori_akun_id');
        if (!$this->validate([
            'nama_kategori_akun' => [
                'rules' => 'required|is_unique[kategori_akun.kategori_akun,kategori_akun.id,' . $kategori_akun_id . ']',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong',
                    'is_unique' => 'Nama kategori sudah ada, silakan pakai nama lain'
                ]
            ],
            'kode_kategori_akun' => [
                'rules' => 'required|is_unique[kategori_akun.kode_kategori_akun,kategori_akun.id,' . $kategori_akun_id . ']',
                'errors' => [
                    'required' => 'Kode kategori tidak boleh kosong',
                    'is_unique' => 'Kode kategori sudah ada, silakan pakai yang lain'
                ]
            ]
        ])) {
            return redirect()->to('/akun/category')->withInput();
        }
        // $this->akunCatModel->where('id', $id)->update([
        //     'kategori_akun' => $this->request->getVar('nama_kategori_akun'),
        //     'kode_kategori_akun' => $this->request->getVar('kode_kategori_akun')
        // ]);
        $data = [
            'kategori_akun' => $this->request->getVar('nama_kategori_akun'),
            'kode_kategori_akun' => $this->request->getVar('kode_kategori_akun')
        ];
        $this->akunCatModel->update($kategori_akun_id, $data);
        session()->setFlashdata('akuncat', 'Kategori akun berhasil diubah');
        return redirect()->to('/akun/category');
    }

    public function deletecategory()
    {
        $kategori_akun_id = $this->request->getVar('kategori_akun_id');
        $this->akunCatModel->where('id', $kategori_akun_id)->delete();
        session()->setFlashdata('akuncat', 'Kategori Akun berhasil dihapus');
        return redirect()->to('/akun/category');
    }
}
