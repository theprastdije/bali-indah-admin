<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Aset extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Aset',
            'aset' => $this->asetModel->getAset(),
            'aset_beli' => $this->asetBeliModel->getPembelianAset(),
            'aset_jual' => $this->asetJualModel->getPenjualanAset(),
            'validation' => $this->validation
        ];
        return view('aset/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Aset',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('aset/add', $data);
    }

    public function edit($aset_id)
    {
        // ambil data aset
        $aset = $this->asetModel->getAset($aset_id);
        // cek apakah aset dpt disusutkan
        $depresiasi = $aset['dapat_disusutkan'];

        if ($depresiasi == 'y') {
            // ambil data penyusutan aset
            $penyusutan = $this->asetPenyusutanModel->getPenyusutanAset($aset_id);
            $penyusutan_id = $penyusutan['id'];
            $data = [
                'title' => 'Aset',
                'aset' => $aset,
                'penyusutan_aset' => $this->asetPenyusutanModel->getPenyusutanAset($aset_id),
                'akum_penyusutan' => $this->akumPenyusutanModel->getAkumPenyusutan($penyusutan_id),
                'akun' => $this->akunModel->getAkun(),
                'validation' => $this->validation
            ];
        } else {
            $data = [
                'title' => 'Aset',
                'aset' => $aset,
                'penyusutan_aset' => '',
                'akum_penyusutan' => '',
                'akun' => $this->akunModel->getAkun(),
                'validation' => $this->validation
            ];
        }
        return view('aset/edit', $data);
    }

    public function detail($aset_id)
    {
        // ambil data aset
        $aset = $this->asetModel->getAset($aset_id);
        // cek apakah aset dpt disusutkan
        $depresiasi = $aset['dapat_disusutkan'];

        if ($depresiasi == 'y') {
            // ambil data penyusutan aset
            $penyusutan = $this->asetPenyusutanModel->getPenyusutanAset($aset_id);
            $penyusutan_id = $penyusutan['id'];
            $data = [
                'title' => 'Aset',
                'aset' => $aset,
                'penyusutan_aset' => $this->asetPenyusutanModel->getPenyusutanAset($aset_id),
                'akum_penyusutan' => $this->akumPenyusutanModel->getAkumPenyusutan($penyusutan_id),
                'akun' => $this->akunModel->getAkun(),
                'validation' => $this->validation
            ];
        } else {
            $data = [
                'title' => 'Aset',
                'aset' => $aset,
                'penyusutan_aset' => '',
                'akum_penyusutan' => '',
                'akun' => $this->akunModel->getAkun(),
                'validation' => $this->validation
            ];
        }
        return view('aset/detail', $data);
    }

    public function insert()
    {
        $dapat_disusutkan = $this->request->getVar('depresiasi_aset');

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
                    'required' => 'Harga perolehan tidak boleh kosong',
                    'numeric' => 'Harga perolehan harus berupa angka'
                ]
            ],
            'tgl_perolehan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal perolehan tidak boleh kosong'
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
            $data = [
                'id' => '',
                'akun_aset_id' => $this->request->getVar('kode_akun_aset'),
                'nama_aset' => $this->request->getVar('nama_aset'),
                'kode_aset' => $this->request->getVar('kode_aset'),
                'deskripsi_aset' => $this->request->getVar('deskripsi_aset'),
                'tgl_perolehan' => $this->request->getVar('tgl_perolehan'),
                'harga_perolehan' => $this->request->getVar('harga_perolehan'),
                'status_aset' => 1,
                'dapat_disusutkan' => $this->request->getVar('depresiasi_aset'),
            ];
            $aset_id = $this->asetModel->insert($data);

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
                    return redirect()->to('/aset/add')->withInput();
                }
            } else {
                // Aset tidak dapat disusutkan
                session()->setFlashdata('aset', 'Aset berhasil ditambahkan');
                return redirect()->to('/aset');
            }
            session()->setFlashdata('aset', 'Aset berhasil ditambahkan');
            return redirect()->to('/aset');
        } else {
            return redirect()->to('/aset/add')->withInput();
        }
    }

    public function update()
    {
        $aset_id = $this->request->getVar('aset_id');
        $penyusutan_aset_id = $this->request->getVar('penyusutan_aset_id');
        $akum_penyusutan_id = $this->request->getVar('akumulasi_penyusutan_id');
        $dapat_disusutkan = $this->request->getVar('depresiasi_aset');
        // dd($aset_id, $penyusutan_aset_id, $akum_penyusutan_id);

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
                    'required' => 'Harga perolehan tidak boleh kosong',
                    'numeric' => 'Harga perolehan harus berupa angka'
                ]
            ],
            'tgl_perolehan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal perolehan tidak boleh kosong'
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
            $data = [
                'id' => '',
                'akun_aset_id' => $this->request->getVar('kode_akun_aset'),
                'nama_aset' => $this->request->getVar('nama_aset'),
                'kode_aset' => $this->request->getVar('kode_aset'),
                'deskripsi_aset' => $this->request->getVar('deskripsi_aset'),
                'tgl_perolehan' => $this->request->getVar('tgl_perolehan'),
                'harga_perolehan' => $this->request->getVar('harga_perolehan'),
                'status_aset' => 1,
                'dapat_disusutkan' => $this->request->getVar('depresiasi_aset'),
            ];
            $this->asetModel->update($aset_id, $data);

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
                        'akun_penyusutan_id' => $this->request->getVar('kode_akun_penyusutan'),
                        'metode_penyusutan' => $this->request->getVar('metode_penyusutan'),
                        'masa_manfaat' => $this->request->getVar('masa_manfaat'),
                        'nilai_penyusutan' => $this->request->getVar('nilai_penyusutan')
                    ];
                    $this->asetPenyusutanModel->update($penyusutan_aset_id, $data_penyusutan);

                    // Akumulasi penyusutan aset
                    $data_akum_penyusutan = [
                        'akun_akumulasi_penyusutan_id' => $this->request->getVar('kode_akun_akumulasi_penyusutan'),
                        'nilai_akumulasi_penyusutan' => $this->request->getVar('nilai_akumulasi_penyusutan'),
                        'tahun_akumulasi_penyusutan' => $this->request->getVar('th_akumulasi_penyusutan')
                    ];
                    $this->akumPenyusutanModel->update($akum_penyusutan_id, $data_akum_penyusutan);
                } else {
                    // Tidak valid
                    return redirect()->to('/aset/edit/' . $aset_id)->withInput();
                }
            } else {
                // Aset tidak dapat disusutkan
                session()->setFlashdata('aset', 'Data aset berhasil diubah');
                return redirect()->to('/aset');
            }
            session()->setFlashdata('aset', 'Data aset berhasil diubah');
            return redirect()->to('/aset');
        } else {
            return redirect()->to('/aset/edit/' . $aset_id)->withInput();
        }
    }

    public function delete()
    {
        $aset_id = $this->request->getVar('aset_id');
        $this->asetModel->delete($aset_id);
        session()->setFlashdata('aset', 'Aset berhasil dihapus');
        return redirect()->to('/aset');
    }
}
