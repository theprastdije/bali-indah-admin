<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kas',
            'kas_keluar' => $this->kasKeluarModel->getKasKeluar(),
            'kas_masuk' => $this->kasMasukModel->getKasMasuk(),
            'validation' => $this->validation
        ];
        return view('kas/index', $data);
    }

    public function add()
    {
        // dd($this->pajakModel->getPajak());
        $data = [
            'title' => 'Kas',
            'pajak' => $this->pajakModel->getPajak(),
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('kas/add', $data);
    }

    public function editkaskeluar($kas_keluar_id)
    {
        $data = [
            'title' => 'Kas',
            'pajak' => $this->pajakModel->getPajak(),
            'akun' => $this->akunModel->getAkun(),
            'kas_keluar' => $this->kasKeluarModel->getKasKeluar($kas_keluar_id),
            'validation' => $this->validation
        ];
        return view('kas/editkeluar', $data);
    }

    public function editkasmasuk($kas_masuk_id)
    {
        // dd($this->kasMasukModel->getKasMasuk($kas_masuk_id));
        $data = [
            'title' => 'Kas',
            'pajak' => $this->pajakModel->getPajak(),
            'akun' => $this->akunModel->getAkun(),
            'kas_masuk' => $this->kasMasukModel->getKasMasuk($kas_masuk_id),
            'validation' => $this->validation
        ];
        return view('kas/editmasuk', $data);
    }

    public function detailkaskeluar($kas_keluar_id)
    {
        $data = [
            'title' => 'Kas',
            'kas_keluar' => $this->kasKeluarModel->getKasKeluar($kas_keluar_id)
        ];
        return view('kas/detailkeluar', $data);
    }

    public function detailkasmasuk($kas_masuk_id)
    {
        $data = [
            'title' => 'Kas',
            'kas_masuk' => $this->kasMasukModel->getKasMasuk($kas_masuk_id)
        ];
        return view('kas/detailmasuk', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'jenis_kas' => [
                'rules' => 'required|in_list[keluar,masuk]',
                'errors' => [
                    'required' => 'Jenis kas harus dipilih',
                    'in_list' => 'Jenis kas harus dipilih'
                ]
            ],
            'kode_akun_kas' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jenis_pajak' => [
                'rules' => 'is_not_unique[pajak.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'deskripsi_kas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi kas tidak boleh kosong'
                ]
            ],
            'jumlah_kas' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah kas tidak boleh kosong',
                    'numeric' => 'Jumlah kas harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/kas/add')->withInput();
        } else {
            $jenis_kas = $this->request->getVar('jenis_kas');
            if ($jenis_kas == 'masuk') {
                // kas masuk
                $data_pendapatan = [
                    'id' => '',
                    'tgl_transaksi_pendapatan' => $this->datetimeNow,
                    'jenis_transaksi_pendapatan' => 'kas',
                    'total_transaksi_pendapatan' => $this->request->getVar('jumlah_kas'),
                    'created_at' => $this->datetimeNow,
                    'updated_at' => $this->datetimeNow,
                ];
                $pendapatan_id = $this->pendapatanModel->insert($data_pendapatan);

                $data_kas_masuk = [
                    'id' => '',
                    'pendapatan_id' => $pendapatan_id,
                    'akun_id' => $this->request->getVar('kode_akun_kas'),
                    'pajak_id' => $this->request->getVar('jenis_pajak'),
                    'deskripsi' => $this->request->getVar('deskripsi_kas'),
                    'jumlah' => $this->request->getVar('jumlah_kas')
                ];
                $this->kasMasukModel->insert($data_kas_masuk);
            } elseif ($jenis_kas == 'keluar') {
                // kas keluar
                $data_pengeluaran = [
                    'id' => '',
                    'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                    'jenis_transaksi_pengeluaran' => 'kas',
                    'total_transaksi_pengeluaran' => $this->request->getVar('jumlah_kas'),
                    'created_at' => $this->datetimeNow,
                    'updated_at' => $this->datetimeNow,
                ];
                $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

                $data_kas_keluar = [
                    'id' => '',
                    'pengeluaran_id' => $pengeluaran_id,
                    'akun_id' => $this->request->getVar('kode_akun_kas'),
                    'pajak_id' => $this->request->getVar('jenis_pajak'),
                    'deskripsi' => $this->request->getVar('deskripsi_kas'),
                    'jumlah' => $this->request->getVar('jumlah_kas')
                ];
                $this->kasKeluarModel->insert($data_kas_keluar);
            } else {
                return redirect()->to('/kas/add')->withInput();
            }
            session()->setFlashdata('kas', 'Data berhasil ditambahkan');
            return redirect()->to('/kas');
        }
    }

    public function update()
    {
        $jenis_kas = $this->request->getVar('jenis_kas');
        $kas_masuk_id = $this->request->getVar('kas_masuk_id');
        $pendapatan_id = $this->request->getVar('pendapatan_id');
        $kas_keluar_id = $this->request->getVar('kas_keluar_id');
        $pengeluaran_id = $this->request->getVar('pengeluaran_id');
        if (!$this->validate([
            'kode_akun_kas' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jenis_pajak' => [
                'rules' => 'is_not_unique[pajak.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'deskripsi_kas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi kas tidak boleh kosong'
                ]
            ],
            'jumlah_kas' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah kas tidak boleh kosong',
                    'numeric' => 'Jumlah kas harus berupa angka'
                ]
            ]
        ])) {
            if ($jenis_kas == 'masuk') {
                return redirect()->to('/kas/editkasmasuk/' . $kas_masuk_id)->withInput();
            } elseif ($jenis_kas == 'keluar') {
                return redirect()->to('/kas/editkaskeluar/' . $kas_keluar_id)->withInput();
            } else {
                return redirect()->to('/kas');
            }
        } else {
            if ($jenis_kas == 'masuk') {
                // kas masuk
                $data_pendapatan = [
                    'total_transaksi_pendapatan' => $this->request->getVar('jumlah_kas'),
                    'updated_at' => $this->datetimeNow,
                ];
                $this->pendapatanModel->update($pendapatan_id, $data_pendapatan);

                $data_kas_masuk = [
                    'akun_id' => $this->request->getVar('kode_akun_kas'),
                    'pajak_id' => $this->request->getVar('jenis_pajak'),
                    'deskripsi' => $this->request->getVar('deskripsi_kas'),
                    'jumlah' => $this->request->getVar('jumlah_kas')
                ];
                $this->kasMasukModel->update($kas_masuk_id, $data_kas_masuk);
            } elseif ($jenis_kas == 'keluar') {
                // kas keluar
                $data_pengeluaran = [
                    'total_transaksi_pengeluaran' => $this->request->getVar('jumlah_kas'),
                    'updated_at' => $this->datetimeNow,
                ];
                $this->pengeluaranModel->update($pengeluaran_id, $data_pengeluaran);

                $data_kas_keluar = [
                    'akun_id' => $this->request->getVar('kode_akun_kas'),
                    'pajak_id' => $this->request->getVar('jenis_pajak'),
                    'deskripsi' => $this->request->getVar('deskripsi_kas'),
                    'jumlah' => $this->request->getVar('jumlah_kas')
                ];
                $this->kasKeluarModel->update($kas_keluar_id, $data_kas_keluar);
            } else {
                return redirect()->to('/kas');
            }
            session()->setFlashdata('kas', 'Data berhasil diubah');
            return redirect()->to('/kas');
        }
    }

    public function delete()
    {
        $jenis_kas = $this->request->getVar('jenis_kas');
        // dd($jenis_kas);
        if ($jenis_kas == 'masuk') {
            // kas masuk
            $kas_masuk_id = $this->request->getVar('kas_masuk_id');
            $pendapatan_id = $this->request->getVar('pendapatan_id');
            $this->kasMasukModel->where('id', $kas_masuk_id)->delete();
            $this->pendapatanModel->where('id', $pendapatan_id)->delete();
        } elseif ($jenis_kas == 'keluar') {
            // kas keluar
            $kas_keluar_id = $this->request->getVar('kas_keluar_id');
            $pengeluaran_id = $this->request->getVar('pengeluaran_id');
            $this->kasKeluarModel->where('id', $kas_keluar_id)->delete();
            $this->pengeluaranModel->where('id', $pengeluaran_id)->delete();
        } else {
            return redirect()->to('/kas');
        }
        session()->setFlashdata('kas', 'Data berhasil dihapus');
        return redirect()->to('/kas');
    }
}
