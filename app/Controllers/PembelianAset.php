<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PembelianAset extends BaseController
{
    public function add()
    {
        // dd($this->jenisPembayaranModel->getJenisPembayaran());
        $data = [
            'title' => 'Pembelian Aset',
            'akun' => $this->akunModel->getAkun(),
            'pajak' => $this->pajakModel->getPajakPembelian(),
            'jenis_pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'validation' => $this->validation
        ];
        return view('aset/pembelian/add', $data);
    }

    public function edit($beli_aset_id)
    {
        $aset = $this->asetBeliModel->getPembelianAset($beli_aset_id);
        $aset_id = $aset['aset_id'];
        $penyusutan = $this->asetPenyusutanModel->getPenyusutanAset($aset_id);
        $penyusutan_id = $penyusutan['id'];
        $akum_penyusutan = $this->akumPenyusutanModel->getAkumPenyusutan($penyusutan_id);
        // dd($aset, $aset_id, $akum_penyusutan);
        $data = [
            'title' => 'Pembelian Aset',
            'aset' => $this->asetBeliModel->getPembelianAset($beli_aset_id),
            'pajak_aset' => $this->asetBeliModel->getPajakBeli($beli_aset_id),
            'penyusutan' => $penyusutan,
            'akumulasi' => $akum_penyusutan,
            'akun' => $this->akunModel->getAkun(),
            'pajak' => $this->pajakModel->getPajakPembelian(),
            'jenis_pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'validation' => $this->validation
        ];
        return view('aset/pembelian/edit', $data);
    }

    public function detail($beli_aset_id)
    {
        $aset = $this->asetBeliModel->getPembelianAset($beli_aset_id);
        $aset_id = $aset['aset_id'];
        $penyusutan = $this->asetPenyusutanModel->getPenyusutanAset($aset_id);
        $penyusutan_id = $penyusutan['id'];
        $akum_penyusutan = $this->akumPenyusutanModel->getAkumPenyusutan($penyusutan_id);
        $data = [
            'title' => 'Pembelian Aset',
            'aset' => $this->asetBeliModel->getPembelianAset($beli_aset_id),
            'pajak_aset' => $this->asetBeliModel->getPajakBeli($beli_aset_id),
            'penyusutan' => $penyusutan,
            'akumulasi' => $akum_penyusutan,
            'akun' => $this->akunModel->getAkun(),
            'pajak' => $this->pajakModel->getPajakPembelian(),
            'jenis_pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'validation' => $this->validation
        ];
        return view('aset/pembelian/detail', $data);
    }

    public function insert()
    {
        if ($this->validate([
            // aset
            'nama_aset' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama aset tidak boleh kosong'
                ]
            ],
            'kode_aset' => [
                'rules' => 'alpha_numeric',
                'errors' => [
                    'alpha_numeric' => 'Kode aset hanya boleh berisi huruf dan angka'
                ]
            ],
            'kode_akun_aset' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun aset tidak boleh kosong'
                ]
            ],
            'harga_perolehan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga pembelian tidak boleh kosong',
                    'numeric' => 'Harga pembelian harus berupa angka'
                ]
            ],
            'tgl_perolehan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal pembelian tidak boleh kosong'
                ]
            ],
            // 'pajak_pembelian' => [
            //     'rules' => 'is_not_unique[pajak.id]',
            //     'errors' => [
            //         'is_not_unique' => 'Pajak pembelian tidak boleh kosong'
            //     ]
            // ],
            'metode_pembayaran' => [
                'rules' => 'is_not_unique[jenis_pembayaran.id]',
                'errors' => [
                    'is_not_unique' => 'Metode pembayaran tidak boleh kosong'
                ]
            ],
            'kode_akun_pembelian_aset' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun pembelian aset tidak boleh kosong'
                ]
            ],
            'depresiasi_aset' => [
                'rules' => 'required|in_list[y,n]',
                'errors' => [
                    'required' => 'Penyusutan aset wajib dipilih',
                    'in_list' => 'Penyusutan aset wajib dipilih'
                ]
            ],
        ])) {
            $dapat_disusutkan = $this->request->getVar('depresiasi_aset');

            $harga_perolehan = floatval($this->request->getVar('harga_perolehan'));
            $tarif_pajak = floatval($this->request->getVar('tarif_pajak'));
            if (!$tarif_pajak) {
                $pajak = 0;
            } else {
                $pajak = $tarif_pajak;
            }
            $total_harga = $harga_perolehan + $pajak;

            $data_pengeluaran = [
                'id' => '',
                'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                'jenis_transaksi_pengeluaran' => 'aset',
                'total_transaksi_pengeluaran' => $total_harga,
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

            /**
             * Status transaksi
             * 
             * 0 = lunas, barang blm datang | 1 = lunas, barang sudah datang
             */

            $data_pembelian_aset = [
                'id' => '',
                'pengeluaran_id' => $pengeluaran_id,
                'akun_pembelian_id' => $this->request->getVar('kode_akun_pembelian_aset'),
                'jenis_pembayaran_id' => $this->request->getVar('metode_pembayaran'),
                'status_transaksi' => 0
            ];
            $pembelian_aset_id = $this->asetBeliModel->insert($data_pembelian_aset);

            $pajak_pembelian =  $this->request->getVar('pajak_pembelian');
            if ($pajak_pembelian) {
                $pajak_pembelian_aset = [
                    'pajak_id' => $pajak_pembelian,
                    'pembelian_aset_id' => $pembelian_aset_id,
                    'tarif_pajak' => $pajak
                ];
                $this->db->table('pajak_pembelian')->insert($pajak_pembelian_aset);
            }

            $data_aset = [
                'id' => '',
                'akun_aset_id' => $this->request->getVar('kode_akun_aset'),
                'nama_aset' => $this->request->getVar('nama_aset'),
                'kode_aset' => $this->request->getVar('kode_aset'),
                'deskripsi_aset' => $this->request->getVar('deskripsi_aset'),
                'tgl_perolehan' => $this->request->getVar('tgl_perolehan'),
                'harga_perolehan' => $total_harga,
                'status_aset' => 0,
                'dapat_disusutkan' => $this->request->getVar('depresiasi_aset'),
            ];
            $aset_id = $this->asetModel->insert($data_aset);

            $data_aset_dibeli = [
                'pembelian_aset_id' => $pembelian_aset_id,
                'aset_id' => $aset_id
            ];
            $this->db->table('aset_dibeli')->insert($data_aset_dibeli);

            if ($dapat_disusutkan == 'y') {
                // Aset dapat disusutkan
                if ($this->validate([
                    // penyusutan aset
                    'metode_penyusutan' => [
                        'rules' => 'required|in_list[gl,sm]',
                        'errors' => [
                            'required' => 'Metode penyusutan tidak boleh kosong',
                            'in_list' => 'Metode penyusutan tidak boleh kosong'
                        ]
                    ],
                    'masa_manfaat' => [
                        'rules' => 'required|numeric|max_length[2]',
                        'errors' => [
                            'required' => 'Masa manfaat tidak boleh kosong',
                            'numeric' => 'Masa manfaat harus berupa angka',
                            'max_length' => 'Masa manfaat maksimal 2 digit'
                        ]
                    ],
                    'nilai_penyusutan' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Nilai penyusutan tidak boleh kosong',
                            'numeric' => 'Nilai penyusutan harus berupa angka'
                        ]
                    ],
                    'kode_akun_penyusutan' => [
                        'rules' => 'is_not_unique[akun.id]',
                        'errors' => [
                            'is_not_unique' => 'Kode akun penyusutan tidak boleh kosong'
                        ]
                    ],
                    // akumulasi penyusutan aset
                    'kode_akun_akumulasi_penyusutan' => [
                        'rules' => 'is_not_unique[akun.id]',
                        'errors' => [
                            'is_not_unique' => 'Kode akun akum. penyusutan tidak boleh kosong'
                        ]
                    ],
                    'nilai_akumulasi_penyusutan' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Nilai akumulasi penyusutan tidak boleh kosong',
                            'numeric' => 'Nilai akumulasi penyusutan harus berupa angka'
                        ]
                    ],
                    'th_akumulasi_penyusutan' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Nilai akumulasi penyusutan tidak boleh kosong',
                            'numeric' => 'Nilai akumulasi penyusutan harus berupa angka'
                        ]
                    ],
                ])) {
                    // Valid
                    // Penyusutan aset
                    $data_penyusutan = [
                        'id' => '',
                        'aset_id' => $aset_id,
                        'akun_penyusutan_id' => $this->request->getVar('kode_akun_penyusutan'),
                        'metode_penyusutan' => $this->request->getVar('metode_penyusutan'),
                        'masa_manfaat' => $this->request->getVar('masa_manfaat'),
                        'nilai_penyusutan' => $this->request->getVar('nilai_penyusutan')
                    ];
                    $penyusutan_aset_id = $this->asetPenyusutanModel->insert($data_penyusutan);

                    // Akumulasi penyusutan aset
                    $data_akum_penyusutan = [
                        'id' => '',
                        'akun_akumulasi_penyusutan_id' => $this->request->getVar('kode_akun_akumulasi_penyusutan'),
                        'penyusutan_aset_id' => $penyusutan_aset_id,
                        'nilai_akumulasi_penyusutan' => $this->request->getVar('nilai_akumulasi_penyusutan'),
                        'tahun_akumulasi_penyusutan' => $this->request->getVar('th_akumulasi_penyusutan')
                    ];
                    $this->akumPenyusutanModel->insert($data_akum_penyusutan);
                } else {
                    // Tidak valid
                    return redirect()->to('/pembelianaset/add')->withInput();
                }
            } else {
                // Aset tidak dapat disusutkan
                session()->setFlashdata('aset', 'Aset berhasil ditambahkan');
                return redirect()->to('/aset');
            }
            session()->setFlashdata('aset', 'Aset berhasil ditambahkan');
            return redirect()->to('/aset');
        } else {
            return redirect()->to('/pembelianaset/add')->withInput();
        }
    }

    public function update()
    {
        $pembelian_aset_id = $this->request->getVar('pembelian_aset_id');
        $pengeluaran_id = $this->request->getVar('pengeluaran_id');
        $aset_id = $this->request->getVar('aset_id');

        if ($this->validate([
            // aset
            'nama_aset' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama aset tidak boleh kosong'
                ]
            ],
            'kode_aset' => [
                'rules' => 'alpha_numeric',
                'errors' => [
                    'alpha_numeric' => 'Kode aset hanya boleh berisi huruf dan angka'
                ]
            ],
            'kode_akun_aset' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun aset tidak boleh kosong'
                ]
            ],
            'harga_perolehan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga pembelian tidak boleh kosong',
                    'numeric' => 'Harga pembelian harus berupa angka'
                ]
            ],
            'tgl_perolehan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal pembelian tidak boleh kosong'
                ]
            ],
            'metode_pembayaran' => [
                'rules' => 'is_not_unique[jenis_pembayaran.id]',
                'errors' => [
                    'is_not_unique' => 'Metode pembayaran tidak boleh kosong'
                ]
            ],
            'kode_akun_pembelian_aset' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun pembelian aset tidak boleh kosong'
                ]
            ],
        ])) {
            $harga_perolehan = floatval($this->request->getVar('harga_perolehan'));
            $tarif_pajak = floatval($this->request->getVar('tarif_pajak'));
            if (!$tarif_pajak) {
                $pajak = 0;
            } else {
                $pajak = $tarif_pajak;
            }
            $total_harga = $harga_perolehan + $pajak;

            $data_pengeluaran = [
                'total_transaksi_pengeluaran' => $total_harga,
                'updated_at' => $this->datetimeNow
            ];
            $this->pengeluaranModel->update($pengeluaran_id, $data_pengeluaran);

            $data_pembelian_aset = [
                'akun_pembelian_id' => $this->request->getVar('kode_akun_pembelian_aset'),
                'jenis_pembayaran_id' => $this->request->getVar('metode_pembayaran')
            ];
            $this->asetBeliModel->update($pembelian_aset_id, $data_pembelian_aset);

            $data_aset = [
                'akun_aset_id' => $this->request->getVar('kode_akun_aset'),
                'nama_aset' => $this->request->getVar('nama_aset'),
                'kode_aset' => $this->request->getVar('kode_aset'),
                'deskripsi_aset' => $this->request->getVar('deskripsi_aset'),
                'tgl_perolehan' => $this->request->getVar('tgl_perolehan'),
                'harga_perolehan' => $total_harga,
                'dapat_disusutkan' => $this->request->getVar('depresiasi_aset'),
            ];
            $this->asetModel->update($aset_id, $data_aset);

            $cek_pajak = $this->request->getVar('cek_pajak');
            $pajak_pembelian =  $this->request->getVar('pajak_pembelian');
            // dd($cek_pajak, $pajak_pembelian);
            if ($cek_pajak == '0') {
                // belum ada data pajak sebelumnya
                if ($pajak_pembelian != '0') {
                    $pajak_pembelian_aset = [
                        'pajak_id' => $pajak_pembelian,
                        'pembelian_aset_id' => $pembelian_aset_id,
                        'tarif_pajak' => $pajak
                    ];
                    $this->db->table('pajak_pembelian')->insert($pajak_pembelian_aset);
                }
            } else {
                // ada data pajak
                if ($cek_pajak != $pajak_pembelian && $pajak_pembelian != '0') {
                    // jenis pajak diubah
                    $pajak_pembelian_aset = [
                        'pajak_id' => $pajak_pembelian,
                        'tarif_pajak' => $pajak
                    ];
                    $this->db->table('pajak_pembelian')->where('pembelian_aset_id', $pembelian_aset_id)->update($pajak_pembelian_aset);
                } elseif ($cek_pajak != $pajak_pembelian && $pajak_pembelian == '0') {
                    // jenis pajak dihapus
                    $this->db->table('pajak_pembelian')->where('pembelian_aset_id', $pembelian_aset_id)->delete();
                } else {
                    $pajak_pembelian_aset = [
                        'tarif_pajak' => $pajak
                    ];
                    $this->db->table('pajak_pembelian')->where('pembelian_aset_id', $pembelian_aset_id)->update($pajak_pembelian_aset);
                }
            }
            session()->setFlashdata('aset', 'Data aset berhasil diubah');
            return redirect()->to('/pengeluaran');
        } else {
            return redirect()->to('/pembelianaset/edit/' . $pembelian_aset_id)->withInput();
        }
    }

    public function accept()
    {
        $pembelian_aset_id = $this->request->getVar('pembelian_aset_id');
        $aset_id = $this->request->getVar('aset_id');

        $data_pembelian_aset = [
            'status_transaksi' => 1
        ];
        $this->asetBeliModel->update($pembelian_aset_id, $data_pembelian_aset);

        $data_aset = [
            'status_aset' => 1
        ];
        $this->asetModel->update($aset_id, $data_aset);

        session()->setFlashdata('aset', 'Aset berhasil diterima');
        return redirect()->to('/aset');
    }

    public function delete()
    {
        $pembelian_aset_id = $this->request->getVar('pembelian_aset_id');
        $aset_id = $this->request->getVar('aset_id');
        $pengeluaran_id = $this->request->getVar('pengeluaran_id');

        $aset = $this->asetModel->getAset($aset_id);
        $dapat_disusutkan = $aset['dapat_disusutkan'];

        // dd($pembelian_aset_id, $pengeluaran_id);

        // Jika aset dapat disusutkan
        if ($dapat_disusutkan == 'y') {
            // Ambil ID penyusutan
            $penyusutan = $this->asetPenyusutanModel->getPenyusutanAset($aset_id);
            $penyusutan_id = $penyusutan['id'];
            // Ambil ID akum penyusutan
            $akum_penyusutan = $this->akumPenyusutanModel->getAkumPenyusutan($penyusutan_id);
            $akum_penyusutan_id = $akum_penyusutan['id'];

            // Delete akum penyusutan
            $this->akumPenyusutanModel->where('id', $akum_penyusutan_id)->delete();
            // Delete penyusutan
            $this->asetPenyusutanModel->where('id', $penyusutan_id)->delete();
        }

        // Delete data di tabel aset_dibeli
        $this->db->table('aset_dibeli')->where('pembelian_aset_id', $pembelian_aset_id)->delete();

        // Delete pajak pembelian aset jika ada
        $cek_pajak = $this->db->table('pajak_pembelian')
            ->select('pembelian_aset_id')
            ->where('pembelian_aset_id', $pembelian_aset_id)
            ->get()->getRowArray();
        if ($cek_pajak) {
            $this->db->table('pajak_pembelian')->where('pembelian_aset_id', $pembelian_aset_id)->delete();
        }

        // Delete aset
        $this->asetModel->where('id', $aset_id)->delete();

        // Delete pembelian aset
        $this->asetBeliModel->where('id', $pembelian_aset_id)->delete();

        // Delete pengeluaran
        $this->pengeluaranModel->where('id', $pengeluaran_id)->delete();

        session()->setFlashdata('aset', 'Berhasil membatalkan pembelian aset');
        return redirect()->to('/aset');
    }
}
