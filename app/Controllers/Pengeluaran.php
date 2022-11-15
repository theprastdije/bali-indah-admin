<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengeluaran extends BaseController
{
    public function index()
    {
        $staf_id = user_id();
        $data = [
            'title' => 'Pengeluaran',
            'harian' => $this->pengeluaranHarianModel->getBelanja(),
            'aset' => $this->asetBeliModel->getPembelianAset(),
            'pengajuan' => $this->pengajuanModel->getPengajuanStaf($staf_id),
            'pengajuan_manajer' => $this->pengajuanModel->getPengajuanManajer(),
            'validation' => $this->validation
        ];
        return view('pengeluaran/indexnew', $data);
    }

    public function detail($pengeluaran_harian)
    {
        // dd($this->pengeluaranHarianModel->getBelanja($pengeluaran_harian));
        $data = [
            'title' => 'Pengeluaran',
            'harian' => $this->pengeluaranHarianModel->getBelanja($pengeluaran_harian),
            // 'pengeluaran' => $this->pengeluaranModel->getPengeluaran($pengeluaran_id)
        ];
        return view('pengeluaran/detail', $data);
    }

    public function laporan()
    {
        $jenis_pengeluaran = $this->request->getVar('jenis_pengeluaran');
        $periode_awal = $this->request->getVar('periode_awal');
        $periode_akhir = $this->request->getVar('periode_akhir');

        if (!$jenis_pengeluaran) {
            $pengeluaran = $this->pengeluaranModel->laporanDefault()['laporan'];
            $jenis = $this->pengeluaranModel->laporanDefault()['jenis'];
            $periode = $this->pengeluaranModel->laporanDefault()['periode'];
        } else {
            // 
            $pengeluaran = $this->pengeluaranModel->laporanByJenis($jenis_pengeluaran, $periode_awal, $periode_akhir)['laporan'];
            $jenis = $this->pengeluaranModel->laporanByJenis($jenis_pengeluaran, $periode_awal, $periode_akhir)['jenis'];
            $periode = $this->pengeluaranModel->laporanByJenis($jenis_pengeluaran, $periode_awal, $periode_akhir)['periode'];
        }

        $data = [
            'title' => 'Laporan Pengeluaran',
            'pengeluaran' => $pengeluaran,
            'jenis' => $jenis,
            'periode' => $periode
        ];
        return view('pengeluaran/laporan', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Pengeluaran',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('pengeluaran/addnew', $data);
    }

    public function edit($pengeluaran_harian)
    {
        $data = [
            'title' => 'Pengeluaran',
            'akun' => $this->akunModel->getAkun(),
            'harian' => $this->pengeluaranHarianModel->getBelanja($pengeluaran_harian),
            'validation' => $this->validation
        ];
        return view('pengeluaran/editnew', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'kode_akun_pengeluaran' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'rincian_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keperluan tidak boleh kosong'
                ]
            ],
            'tgl_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal transaksi tidak boleh kosong'
                ]
            ],
            'harga_satuan' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Harga satuan harus berupa angka'
                ]
            ],
            'jumlah' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Jumlah harus berupa angka'
                ]
            ],
            'total' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Total tidak boleh kosong',
                    'numeric' => 'Total harus berupa angka'
                ]
            ],
            'bukti_pengeluaran' => [
                'rules' => 'permit_empty|max_size[bukti_pengeluaran,10240]|ext_in[bukti_pengeluaran,pdf,jpg,jpeg,png]|mime_in[bukti_pengeluaran,image/jpg,image/jpeg,image/png,application/pdf,application/force-download,application/x-download]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Format file tidak valid/tidak diizinkan',
                    'mime_in' => 'Format file tidak valid/tidak diizinkan'
                ]
            ]
        ])) {
            return redirect()->to('/pengeluaran/add')->withInput();
        } else {
            $bukti_pengeluaran = $this->request->getFile('bukti_pengeluaran');
            if ($bukti_pengeluaran->getError() == 4) {
                // Tidak ada file diupload
                $nama_file = '';
            } else {
                // Ada file diupload
                $nama_file = $bukti_pengeluaran->getRandomName();
                $bukti_pengeluaran->move('file/bukti-pengeluaran', $nama_file);
            }
            $data_pengeluaran = [
                'id' => '',
                'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                'jenis_transaksi_pengeluaran' => 'harian',
                'total_transaksi_pengeluaran' => $this->request->getVar('total'),
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

            $data_pengeluaran_harian = [
                'pengeluaran_id' => $pengeluaran_id,
                'akun_id' => $this->request->getVar('kode_akun_pengeluaran'),
                'rincian_pengeluaran' => $this->request->getVar('rincian_pengeluaran'),
                'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
                'harga_satuan' => $this->request->getVar('harga_satuan'),
                'jumlah' => $this->request->getVar('jumlah'),
                'total_pengeluaran' => $this->request->getVar('total'),
                'catatan' => $this->request->getVar('catatan'),
                'bukti_transaksi' => $nama_file,
            ];
            $this->pengeluaranHarianModel->insert($data_pengeluaran_harian);
            session()->setFlashdata('pengeluaran', 'Data pengeluaran berhasil ditambahkan');
            return redirect()->to('/pengeluaran');
        }
    }

    public function update()
    {
        $pengeluaran_id = $this->request->getVar('pengeluaran_id');
        $pengeluaran_harian_id = $this->request->getVar('pengeluaran_harian_id');
        if (!$this->validate([
            'kode_akun_pengeluaran' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'rincian_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keperluan tidak boleh kosong'
                ]
            ],
            'tgl_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal transaksi tidak boleh kosong'
                ]
            ],
            'harga_satuan' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Harga satuan harus berupa angka'
                ]
            ],
            'jumlah' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Jumlah harus berupa angka'
                ]
            ],
            'total' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Total tidak boleh kosong',
                    'numeric' => 'Total harus berupa angka'
                ]
            ],
            'bukti_pengeluaran' => [
                'rules' => 'permit_empty|max_size[bukti_pengeluaran,10240]|ext_in[bukti_pengeluaran,pdf,jpg,jpeg,png]|mime_in[bukti_pengeluaran,image/jpg,image/jpeg,image/png,application/pdf,application/force-download,application/x-download]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Format file tidak valid/tidak diizinkan',
                    'mime_in' => 'Format file tidak valid/tidak diizinkan'
                ]
            ]
        ])) {
            return redirect()->to('/pengeluaran/edit/' . $pengeluaran_harian_id)->withInput();
        } else {
            $pengeluaran = $this->pengeluaranHarianModel->find($pengeluaran_harian_id);
            if (!$pengeluaran['bukti_transaksi']) {
                // Belum pernah upload file
                $bukti_pengeluaran = $this->request->getFile('bukti_pengeluaran');
                if ($bukti_pengeluaran->getError() == 4) {
                    // Tidak ada file diupload
                    $nama_file = '';
                } else {
                    // Ada file diupload
                    $nama_file = $bukti_pengeluaran->getRandomName();
                    $bukti_pengeluaran->move('file/bukti-pengeluaran', $nama_file);
                }
            } else {
                // Sudah pernah upload file
                $bukti_pengeluaran = $this->request->getFile('bukti_pengeluaran');
                if ($bukti_pengeluaran->getError() == 4) {
                    // Tidak ada file diupload
                    $nama_file = $this->request->getVar('file_lama');
                } else {
                    // Ada file diupload
                    if ($pengeluaran['bukti_transaksi'] != 'default.svg') {
                        unlink('file/bukti-pengeluaran/' . $pengeluaran['bukti_transaksi']);
                    }
                    $nama_file = $bukti_pengeluaran->getRandomName();
                    $bukti_pengeluaran->move('file/bukti-pengeluaran', $nama_file);
                }
            }

            $data_pengeluaran = [
                'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                'total_transaksi_pengeluaran' => $this->request->getVar('total'),
                'updated_at' => $this->datetimeNow
            ];
            $this->pengeluaranModel->update($pengeluaran_id, $data_pengeluaran);

            $data_pengeluaran_harian = [
                'akun_id' => $this->request->getVar('kode_akun_pengeluaran'),
                'rincian_pengeluaran' => $this->request->getVar('rincian_pengeluaran'),
                'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
                'harga_satuan' => $this->request->getVar('harga_satuan'),
                'jumlah' => $this->request->getVar('jumlah'),
                'total_pengeluaran' => $this->request->getVar('total'),
                'catatan' => $this->request->getVar('catatan'),
                'bukti_transaksi' => $nama_file,
            ];
            $this->pengeluaranHarianModel->update($pengeluaran_harian_id, $data_pengeluaran_harian);
            session()->setFlashdata('pengeluaran', 'Data berhasil diubah');
            return redirect()->to('/pengeluaran');
        }
    }

    public function delete()
    {
        $pengeluaran_harian_id = $this->request->getVar('pengeluaran_harian_id');
        $pengeluaran_id = $this->request->getVar('pengeluaran_id');
        $this->pengeluaranHarianModel->where('id', $pengeluaran_harian_id)->delete();
        $this->pengeluaranModel->where('id', $pengeluaran_id)->delete();
        session()->setFlashdata('pengeluaran', 'Data berhasil dihapus');
        return redirect()->to('/pengeluaran');
    }

    // public function import()
    // {
    //     $data = [
    //         'title' => 'Impor Data Pengeluaran',
    //         'validation' => $this->validation
    //     ];
    //     return view('pengeluaran/import', $data);
    // }

    // public function upload()
    // {
    //     if (!$this->validate([
    //         'file_pengeluaran' => [
    //             'rules' => 'uploaded[file_pengeluaran]|mime_in[file_pengeluaran,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[file_pengeluaran,xls,xlsx]',
    //             'errors' => [
    //                 'uploaded' => 'Tidak ada file yang diupload',
    //                 'mime_in' => 'Format file harus .xls atau .xlsx',
    //                 'ext_in' => 'Format file harus .xls atau .xlsx'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('/pengeluaran/import')->withInput();
    //     } else {
    //         $file_pengeluaran = $this->request->getFile('file_pengeluaran');
    //         $ext = $file_pengeluaran->getClientExtension();
    //         // dd($ext);
    //         if ($ext == 'xlsx') {
    //             $render = new \PhpOffice\PhpSpreadsheet\Reader\xlsx();
    //         } elseif ($ext == 'xls') {
    //             $render = new \PhpOffice\PhpSpreadsheet\Reader\xls();
    //         } else {
    //             return redirect()->to('/pengeluaran/import')->withInput();
    //         }

    //         $spreadsheet = $render->load($file_pengeluaran);
    //         $data = $spreadsheet->getActiveSheet()->toArray();
    //         foreach ($data as $x => $row) {
    //             if ($x == 0) {
    //                 continue;
    //             }

    //             $tgl_transaksi = $row[0];
    //             $keperluan = $row[1];
    //             $harga_satuan = $row[2];
    //             $jumlah = $row[3];
    //             $total_harga = $row[4];
    //             $keterangan = $row[5];

    //             $insert_data = [
    //                 'kategori_id' => 0,
    //                 'rincian_pengeluaran' => $keperluan,
    //                 'harga_satuan' => $harga_satuan,
    //                 'jumlah' => $jumlah,
    //                 'total_harga' => $total_harga,
    //                 'keterangan' => $keterangan,
    //                 'status_pengajuan' => 1,
    //                 'created_at' => $tgl_transaksi,
    //                 'updated_at' => $tgl_transaksi
    //             ];
    //             $this->pengeluaranModel->insert($insert_data);
    //         }
    //         session()->setFlashdata('pengeluaran', 'Data berhasil diimpor');
    //         return redirect()->to('/pengeluaran');
    //     }
    // }
}
