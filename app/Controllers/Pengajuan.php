<?php

namespace App\Controllers;

use App\Controllers\BaseController;

/**
 * Keterangan pengajuan :
 * 
 * 0 = Pending
 * 1 = Disetujui
 * 2 = Ditolak
 * 
 */

class Pengajuan extends BaseController
{

    public function add()
    {
        $data = [
            'title' => 'Pengajuan Pengeluaran',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('pengajuan/add', $data);
    }

    public function edit($pengajuan_id)
    {
        $data = [
            'title' => 'Pengajuan Pengeluaran',
            'akun' => $this->akunModel->getAkun(),
            'pengajuan' => $this->pengajuanModel->getPengajuan($pengajuan_id),
            'validation' => $this->validation
        ];
        return view('pengajuan/edit', $data);
    }

    public function detail($pengajuan_id)
    {
        $data = [
            'title' => 'Pengajuan Pengeluaran',
            'pengajuan' => $this->pengajuanModel->getPengajuan($pengajuan_id)
        ];
        return view('pengajuan/detail', $data);
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
            return redirect()->to('/pengajuan/add')->withInput();
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

            $data_pengajuan = [
                'user_id' => $this->request->getVar('user_id'),
                'akun_id' => $this->request->getVar('kode_akun_pengeluaran'),
                'rincian_pengeluaran' => $this->request->getVar('rincian_pengeluaran'),
                'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
                'harga_satuan' => $this->request->getVar('harga_satuan'),
                'jumlah' => $this->request->getVar('jumlah'),
                'total_pengeluaran' => $this->request->getVar('total'),
                'catatan' => $this->request->getVar('catatan'),
                'bukti_pengeluaran' => $nama_file,
                'status_pengajuan' => 0,
            ];
            $this->pengajuanModel->insert($data_pengajuan);

            session()->setFlashdata('pengeluaran', 'Pengajuan pengeluaran berhasil ditambahkan');
            return redirect()->to('/pengeluaran');
        }
    }

    public function update()
    {
        $pengajuan_id = $this->request->getVar('pengajuan_id');
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
            return redirect()->to('/pengajuan/edit/' . $pengajuan_id)->withInput();
        } else {
            $pengeluaran = $this->pengajuanModel->find($pengajuan_id);
            if (!$pengeluaran['bukti_pengeluaran']) {
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
                    if ($pengeluaran['bukti_pengeluaran'] != 'default.svg') {
                        unlink('file/bukti-pengeluaran/' . $pengeluaran['bukti_pengeluaran']);
                    }
                    $nama_file = $bukti_pengeluaran->getRandomName();
                    $bukti_pengeluaran->move('file/bukti-pengeluaran', $nama_file);
                }
            }

            $data_pengajuan = [
                'akun_id' => $this->request->getVar('kode_akun_pengeluaran'),
                'rincian_pengeluaran' => $this->request->getVar('rincian_pengeluaran'),
                'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
                'harga_satuan' => $this->request->getVar('harga_satuan'),
                'jumlah' => $this->request->getVar('jumlah'),
                'total_pengeluaran' => $this->request->getVar('total'),
                'catatan' => $this->request->getVar('catatan'),
                'bukti_pengeluaran' => $nama_file,
                'status_pengajuan' => 0
            ];
            $this->pengajuanModel->update($pengajuan_id, $data_pengajuan);
            session()->setFlashdata('pengeluaran', 'Pengajuan pengeluaran berhasil diubah');
            return redirect()->to('/pengeluaran');
        }
    }

    public function delete()
    {
        $pengajuan_id = $this->request->getVar('pengajuan_id');
        $this->pengajuanModel->where('id', $pengajuan_id)->delete();
        session()->setFlashdata('pengeluaran', 'Pengajuan berhasil dihapus');
        return redirect()->to('/pengeluaran');
    }

    public function submit()
    {
        $pengajuan_id = $this->request->getVar('pengajuan_id');
        $catatan = $this->request->getVar('catatan');
        $status = $this->request->getVar('status_pengajuan');

        // dd($pengajuan_id);

        if ($status == 1) {
            // diterima
            $this->pengajuanModel->update($pengajuan_id, [
                'status_pengajuan' => $status
            ]);
            $pengajuan = $this->pengajuanModel->getPengajuan($pengajuan_id);
            // dd($pengajuan);

            $data_pengeluaran = [
                'id' => '',
                'tgl_transaksi_pengeluaran' => $pengajuan['tgl_transaksi'],
                'jenis_transaksi_pengeluaran' => 'harian',
                'total_transaksi_pengeluaran' => $pengajuan['total_pengeluaran'],
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

            $data_pengeluaran_harian = [
                'pengeluaran_id' => $pengeluaran_id,
                'akun_id' => $pengajuan['akun_id'],
                'rincian_pengeluaran' => $pengajuan['rincian_pengeluaran'],
                'tgl_transaksi' => $pengajuan['tgl_transaksi'],
                'harga_satuan' => $pengajuan['harga_satuan'],
                'jumlah' => $pengajuan['jumlah'],
                'total_pengeluaran' => $pengajuan['total_pengeluaran'],
                'catatan' => $pengajuan['catatan'],
                'bukti_transaksi' => $pengajuan['bukti_pengeluaran'],
            ];
            $this->pengeluaranHarianModel->insert($data_pengeluaran_harian);

            session()->setFlashdata('pengeluaran', 'Berhasil menerima pengajuan');
            return redirect()->to('/pengeluaran');
        } elseif ($status == 2) {
            // ditolak
            $this->pengajuanModel->update($pengajuan_id, [
                'catatan' => $catatan,
                'status_pengajuan' => $status
            ]);
            session()->setFlashdata('pengeluaran', 'Berhasil menolak pengajuan');
            return redirect()->to('/pengeluaran');
        } else {
            session()->setFlashdata('pengeluaran_error', 'Gagal mengubah status pengajuan');
            return redirect()->to('/pengeluaran');
        }
    }
}
