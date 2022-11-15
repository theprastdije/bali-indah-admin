<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PenjualanAset extends BaseController
{
    public function add($aset_id)
    {
        // dd($aset);
        $data = [
            'title' => 'Penjualan Aset',
            'akun' => $this->akunModel->getAkun(),
            'aset' => $this->asetModel->getAset($aset_id),
            'pajak' => $this->pajakModel->getPajakPenjualan(),
            'validation' => $this->validation
        ];
        return view('aset/penjualan/add', $data);
    }

    public function detail($penjualan_aset_id)
    {
        $penjualan_aset = $this->asetJualModel->getPenjualanAset($penjualan_aset_id);
        $aset_id = $penjualan_aset['aset_id'];
        $data = [
            'title' => 'Penjualan Aset',
            'akun' => $this->akunModel->getAkun(),
            'aset' => $this->asetModel->getAset($aset_id),
            'aset_jual' => $penjualan_aset,
            'pajak' => $this->pajakModel->getPajakPenjualan(),
            'validation' => $this->validation
        ];
        return view('aset/penjualan/detail', $data);
    }

    public function insert()
    {
        $aset_id = $this->request->getVar('aset_id');

        if (!$this->validate([
            'harga_jual' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga jual tidak boleh kosong',
                    'numeric' => 'Harga jual harus berupa angka'
                ]
            ],
            'tgl_penjualan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal penjualan tidak boleh kosong'
                ]
            ],
            'kode_akun_penjualan' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun penjualan tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/penjualanaset/add/' . $aset_id)->withInput();
        } else {
            $pajak_penjualan = $this->request->getVar('pajak_penjualan');
            $harga_jual = floatval($this->request->getVar('harga_jual'));
            if ($pajak_penjualan) {
                $pajak_jual = floatval($this->request->getVar('pajak_jual'));
                $total_transaksi = ($pajak_jual * $harga_jual) + $harga_jual;
            } else {
                $total_transaksi = $harga_jual;
                // 
            }

            $data_aset = [
                'status_aset' => 2
            ];
            $this->asetModel->update($aset_id, $data_aset);

            $data_pendapatan = [
                'id' => '',
                'tgl_transaksi_pendapatan' => $this->datetimeNow,
                'jenis_transaksi_pendapatan' => 'aset',
                'total_transaksi_pendapatan' => $total_transaksi,
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $pendapatan_id = $this->pendapatanModel->insert($data_pendapatan);

            $data_penjualan_aset = [
                'id' => '',
                'pendapatan_id' => $pendapatan_id,
                'akun_id' => $this->request->getVar('kode_akun_penjualan'),
                'aset_id' => $aset_id,
                'tgl_penjualan' => $this->request->getVar('tgl_penjualan'),
                'harga_jual' => $harga_jual,
                'catatan' => $this->request->getVar('catatan')
            ];
            $penjualan_aset_id = $this->asetJualModel->insert($data_penjualan_aset);

            if ($pajak_penjualan) {
                $data_pajak_penjualan = [
                    'pajak_id' => $pajak_penjualan,
                    'penjualan_aset_id' => $penjualan_aset_id,
                    'tarif_pajak' => $pajak_jual
                ];
                $this->db->table('pajak_jual_aset')->insert($data_pajak_penjualan);
            }

            session()->setFlashdata('aset', 'Aset berhasil dijual');
            return redirect()->to('/aset');
        }
    }

    // public function update()
    // {
    //     $aset_id = $this->request->getVar('aset_id');

    //     if (!$this->validate([
    //         'harga_jual' => [
    //             'rules' => 'required|numeric',
    //             'errors' => [
    //                 'required' => 'Harga jual tidak boleh kosong',
    //                 'numeric' => 'Harga jual harus berupa angka'
    //             ]
    //         ],
    //         'tgl_penjualan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tanggal penjualan tidak boleh kosong'
    //             ]
    //         ],
    //         'kode_akun_penjualan' => [
    //             'rules' => 'is_not_unique[akun.id]',
    //             'errors' => [
    //                 'is_not_unique' => 'Kode akun penjualan tidak boleh kosong'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('/penjualanaset/edit/' . $aset_id)->withInput();
    //     } else {
    //         // 
    //     }
    // }
}
