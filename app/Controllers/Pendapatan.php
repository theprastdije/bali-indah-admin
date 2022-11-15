<?php

namespace App\Controllers;

class Pendapatan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pendapatan',
            'aset' => $this->asetModel->getAset(),
            'aset_jual' => $this->asetJualModel->getPenjualanAset()
        ];
        return view('pendapatan/indexnew', $data);
    }

    // public function indexold()
    // {
    //     $data = [
    //         'title' => 'Penjualan',
    //         'pendapatan' => $this->pendapatanModel->getPendapatan(),
    //         'validation' => $this->validation
    //     ];
    //     return view('pendapatan/index', $data);
    // }

    public function detail($pendapatan_id)
    {
        $data = [
            'title' => 'Pendapatan',
            'pendapatan' => $this->pendapatanModel->getPendapatan($pendapatan_id)
        ];
        return view('pendapatan/detail', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Pendapatan',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('pendapatan/add', $data);
    }

    public function edit($pendapatan_id)
    {
        $data = [
            'title' => 'Pendapatan',
            'akun' => $this->akunModel->getAkun(),
            'pendapatan' => $this->pendapatanModel->getPendapatan($pendapatan_id),
            'validation' => $this->validation
        ];
        return view('pendapatan/edit', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'kode_akun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jenis_pendapatan' => [
                'rules' => 'required|in_list[o,i,p]',
                'errors' => [
                    'required' => 'Jenis pendapatan tidak boleh kosong',
                    'in_list' => 'Jenis pendapatan tidak boleh kosong'
                ]
            ],
            'tgl_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal transaksi tidak boleh kosong'
                ]
            ],
            'rincian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga awal tidak boleh kosong'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga diskon tidak boleh kosong',
                    'numeric' => 'Harga diskon harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/pendapatan/add')->withInput();
        } else {
            $data = [
                'akun_id' => $this->request->getVar('kode_akun'),
                'kategori_pendapatan' => $this->request->getVar('jenis_pendapatan'),
                'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
                'rincian_pendapatan' => $this->request->getVar('rincian'),
                'jumlah' => $this->request->getVar('jumlah'),
                'keterangan' => $this->request->getVar('keterangan'),
                'created_at' => $this->dateNow,
                'updated_at' => $this->dateNow
            ];
            $this->pendapatanModel->insert($data);
            session()->setFlashdata('pendapatan', 'Data pendapatan berhasil ditambahkan');
            return redirect()->to('/pendapatan');
        }
    }

    public function update()
    {
        $pendapatan_id = $this->request->getVar('pendapatan_id');
        if (!$this->validate([
            'kode_akun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jenis_pendapatan' => [
                'rules' => 'required|in_list[o,i,p]',
                'errors' => [
                    'required' => 'Jenis pendapatan tidak boleh kosong',
                    'in_list' => 'Jenis pendapatan tidak boleh kosong'
                ]
            ],
            'tgl_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal transaksi tidak boleh kosong'
                ]
            ],
            'rincian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga awal tidak boleh kosong'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga diskon tidak boleh kosong',
                    'numeric' => 'Harga diskon harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/pendapatan/edit/' . $pendapatan_id)->withInput();
        } else {
            $data = [
                'akun_id' => $this->request->getVar('kode_akun'),
                'kategori_pendapatan' => $this->request->getVar('jenis_pendapatan'),
                'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
                'rincian_pendapatan' => $this->request->getVar('rincian'),
                'jumlah' => $this->request->getVar('jumlah'),
                'keterangan' => $this->request->getVar('keterangan'),
                'updated_at' => $this->dateNow
            ];
            $this->pendapatanModel->update($pendapatan_id, $data);
            session()->setFlashdata('pendapatan', 'Data pendapatan berhasil diubah');
            return redirect()->to('/pendapatan');
        }
    }

    public function delete()
    {
        $id = $this->request->getVar('pendapatan_id');
        $this->pendapatanModel->where('id', $id)->delete($id);
        session()->setFlashdata('pendapatan', 'Data pendapatan berhasil dihapus');
        return redirect()->to('/pendapatan');
    }
}
