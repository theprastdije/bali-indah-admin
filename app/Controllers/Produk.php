<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produk extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Produk',
            'produk' => $this->produkModel->getProduk(),
            'kategori' => $this->produkCatModel->getKategoriProduk(),
            'validation' => $this->validation
        ];
        return view('produk/index', $data);
    }

    public function add()
    {
        // dd($this->produkCatModel->getKategoriProduk());
        $data = [
            'title' => 'Produk',
            'kategori' => $this->produkCatModel->getKategoriProduk(),
            'tgl' => $this->datetimeNow,
            'validation' => $this->validation
        ];
        return view('produk/add', $data);
    }

    public function edit($produk_id)
    {
        // dd($this->datetimeNow);
        $data = [
            'title' => 'Produk',
            'produk' => $this->produkModel->getProduk($produk_id),
            'kategori' => $this->produkCatModel->getKategoriProduk(),
            'tgl' => $this->datetimeNow,
            'validation' => $this->validation
        ];
        return view('produk/edit', $data);
    }

    public function detail($produk_id)
    {
        $data = [
            'title' => 'Produk',
            'produk' => $this->produkModel->getProduk($produk_id),
        ];
        return view('produk/detail', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama_produk' => [
                'rules' => 'required|is_unique[produk.nama_produk]',
                'errors' => [
                    'required' => 'Nama produk tidak boleh kosong',
                    'is_unique' => 'Nama produk sudah ada, silakan pakai nama lain'
                ]
            ],
            'kategori_produk' => [
                'rules' => 'is_not_unique[kategori_produk.id]',
                'errors' => [
                    'is_not_unique' => 'Kategori produk tidak boleh kosong'
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga awal tidak boleh kosong',
                    'numeric' => 'Harga awal harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/produk/add')->withInput();
        } else {
            $data = [
                'kategori_produk_id' => $this->request->getVar('kategori_produk'),
                'nama_produk' => $this->request->getVar('nama_produk'),
                'harga_produk' => $this->request->getVar('harga_produk'),
                'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
                'created_at' => $this->request->getVar('tgl_buat'),
                'updated_at' => $this->request->getVar('tgl_ubah')
            ];
            $this->produkModel->insert($data);
            session()->setFlashdata('produk', 'Produk baru berhasil ditambahkan');
            return redirect()->to('/produk');
        }
    }

    public function update()
    {
        $produk_id = $this->request->getVar('produk_id');
        if (!$this->validate([
            'nama_produk' => [
                'rules' => 'required|is_unique[produk.nama_produk,produk.id,' . $produk_id . ']',
                'errors' => [
                    'required' => 'Nama produk tidak boleh kosong',
                    'is_unique' => 'Nama produk sudah ada, silakan pakai nama lain'
                ]
            ],
            'kategori_produk' => [
                'rules' => 'is_not_unique[kategori_produk.id]',
                'errors' => [
                    'is_not_unique' => 'Kategori produk tidak boleh kosong'
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga awal tidak boleh kosong',
                    'numeric' => 'Harga awal harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/produk/edit/' . $produk_id)->withInput();
        } else {
            $data = [
                'kategori_produk_id' => $this->request->getVar('kategori_produk'),
                'nama_produk' => $this->request->getVar('nama_produk'),
                'harga_produk' => $this->request->getVar('harga_produk'),
                'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
                'updated_at' => $this->datetimeNow
            ];
            $this->produkModel->update($produk_id, $data);
            session()->setFlashdata('produk', 'Produk berhasil diupdate');
            return redirect()->to('/produk');
        }
    }

    public function delete()
    {
        $produk_id = $this->request->getVar('produk_id');
        $this->produkModel->where('id', $produk_id)->delete();
        session()->setFlashdata('produk', 'Produk berhasil dihapus');
        return redirect()->to('/produk');
    }

    public function category()
    {
        $data = [
            'title' => 'Kategori Produk',
            'kategori' => $this->produkCatModel->getKategoriProduk(),
            'validation' => $this->validation
        ];
        return view('produk/kategori/index', $data);
    }

    public function addcategory()
    {
        $data = [
            'title' => 'Kategori Produk',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('produk/kategori/add', $data);
    }

    public function editcategory($kategori_produk_id)
    {
        $data = [
            'title' => 'Kategori Produk',
            'akun' => $this->akunModel->getAkun(),
            'kategori' => $this->produkCatModel->getKategoriProduk($kategori_produk_id),
            'validation' => $this->validation
        ];
        return view('produk/kategori/edit', $data);
    }

    public function insertcategory()
    {
        if (!$this->validate([
            'nama_kategori_produk' => [
                'rules' => 'required|is_unique[kategori_produk.nama_kategori_produk]',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong',
                    'is_unique' => 'Nama kategori sudah ada, silakan pakai nama lain'
                ]
            ],
            'kode_kategori_produk' => [
                'rules' => 'required|is_unique[kategori_produk.kode_kategori_produk]',
                'errors' => [
                    'required' => 'Kode kategori tidak boleh kosong',
                    'is_unique' => 'Kode kategori sudah ada, silakan pakai yang lain'
                ]
            ],
            'kode_akun_produk' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/produk/addcategory')->withInput();
        }
        $data = [
            'nama_kategori_produk' => $this->request->getVar('nama_kategori_produk'),
            'kode_kategori_produk' => $this->request->getVar('kode_kategori_produk'),
            'akun_produk_id' => $this->request->getVar('kode_akun_produk')
        ];
        $this->produkCatModel->insert($data);
        session()->setFlashdata('incategory', 'Kategori baru berhasil ditambahkan');
        return redirect()->to('/produk/category');
    }

    public function updatecategory()
    {
        $kategori_produk_id = $this->request->getVar('kategori_produk_id');
        if (!$this->validate([
            'nama_kategori_produk' => [
                'rules' => 'required|is_unique[kategori_produk.nama_kategori_produk,kategori_produk.id,' . $kategori_produk_id . ']',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong',
                    'is_unique' => 'Nama kategori sudah ada, silakan pakai nama lain'
                ]
            ],
            'kode_kategori_produk' => [
                'rules' => 'required|is_unique[kategori_produk.nama_kategori_produk,kategori_produk.id,' . $kategori_produk_id . ']',
                'errors' => [
                    'required' => 'Kode kategori tidak boleh kosong',
                    'is_unique' => 'Kode kategori sudah ada, silakan pakai yang lain'
                ]
            ],
            'kode_akun_produk' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/produk/editcategory/' . $kategori_produk_id)->withInput();
        }
        $data = [
            'nama_kategori_produk' => $this->request->getVar('nama_kategori_produk'),
            'kode_kategori_produk' => $this->request->getVar('kode_kategori_produk'),
            'akun_produk_id' => $this->request->getVar('kode_akun_produk')
        ];
        $this->produkCatModel->update($kategori_produk_id, $data);
        session()->setFlashdata('incategory', 'Kategori berhasil diubah');
        return redirect()->to('/produk/category');
    }

    public function deletecategory()
    {
        $kategori_produk_id = $this->request->getVar('kategori_produk_id');
        $this->produkCatModel->delete($kategori_produk_id);
        session()->setFlashdata('incategory', 'Kategori berhasil dihapus');
        return redirect()->to('/produk/category');
    }
}
