<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PembayaranGaji extends BaseController
{
    function insert()
    {
        $gaji_staf_id = $this->request->getVar('gaji_staf_id');
        if (!$this->validate([
            'bulan_pembayaran' => [
                'rules' => 'required|in_list[1,2,3,4,5,6,7,8,9,10,11,12]',
                'errors' => [
                    'required' => 'Bulan pembayaran tidak boleh kosong',
                    'in_list' => 'Bulan pembayaran tidak boleh kosong'
                ]
            ],
            'tahun_pembayaran' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tahun pembayaran tidak boleh kosong',
                    'numeric' => 'Tahun pembayaran harus berupa angka'
                ]
            ],
            'jenis_pembayaran' => [
                'rules' => 'is_not_unique[jenis_pembayaran.id]',
                'errors' => [
                    'is_not_unique' => 'Cara pembayaran tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->to('/gaji/detail/' . $gaji_staf_id)->withInput();
        } else {
            $bulan_ini = intval(date('n'));
            $tahun_ini = intval(date('Y'));
            $bulan_bayar = intval($this->request->getVar('bulan_pembayaran'));
            $tahun_bayar = intval($this->request->getVar('tahun_pembayaran'));
            $jenis_pembayaran = $this->request->getVar('jenis_pembayaran');
            // dd($tahun_bayar);

            $check = $this->gajiBayarModel->cekByDate($gaji_staf_id, $bulan_bayar, $tahun_bayar);
            $gaji = $this->gajiModel->getGajiStaf($gaji_staf_id);
            // dd($bulan_ini, $tahun_ini);

            if ($check['total'] == '1') {
                // Ada ID gaji staf tsb - gaji sudah dibayar
                session()->setFlashdata('error_gaji', 'Gaji staf bulan ' . $bulan_bayar . '/' . $tahun_bayar . ' sudah dibayar');
                return redirect()->to('/gaji/detail/' . $gaji_staf_id);
            } else {
                // Tidak ada ID gaji staf tsb
                if ($tahun_bayar > $tahun_ini) {
                    // Gaji belum boleh dibayar
                    session()->setFlashdata('error_gaji', 'Gaji staf bulan ' . $bulan_bayar . '/' . $tahun_bayar . ' belum boleh dibayar');
                    return redirect()->to('/gaji/detail/' . $gaji_staf_id);
                } elseif ($tahun_bayar = $tahun_ini) {
                    if ($bulan_bayar > $bulan_ini) {
                        // Gaji belum boleh dibayar
                        session()->setFlashdata('error_gaji', 'Gaji staf bulan ' . $bulan_bayar . '/' . $tahun_bayar . ' belum boleh dibayar');
                        return redirect()->to('/gaji/detail/' . $gaji_staf_id);
                    }
                } else {
                    // 
                    $data_pengeluaran = [
                        'id' => '',
                        'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                        'jenis_transaksi_pengeluaran' => 'gaji',
                        'total_transaksi_pengeluaran' => $gaji['jumlah_gaji'],
                        'created_at' => $this->datetimeNow,
                        'updated_at' => $this->datetimeNow
                    ];
                    $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

                    $pembayaran_gaji = [
                        'id' => '',
                        'gaji_staf_id' => $gaji_staf_id,
                        'pengeluaran_id' => $pengeluaran_id,
                        'jenis_pembayaran_id' => $jenis_pembayaran,
                        'periode_pembayaran_bulan' => $bulan_bayar,
                        'periode_pembayaran_tahun' => $tahun_bayar,
                        'tgl_pembayaran' => $this->dateNow,
                        'jumlah_pembayaran' => $gaji['jumlah_gaji']
                    ];
                    $this->gajiBayarModel->insert($pembayaran_gaji);
                    session()->setFlashdata('gaji', 'Berhasil membayar gaji staf');
                    return redirect()->to('/gaji/detail/' . $gaji_staf_id);
                }
            }
        }
    }

    function delete()
    {
        $gaji_staf_id = $this->request->getVar('gaji_staf_id');
        $pembayaran_gaji_id = $this->request->getVar('pembayaran_gaji_id');
        $pengeluaran_id = $this->request->getVar('pengeluaran_id');
        // dd($pembayaran_gaji_id, $pengeluaran_id);

        if (!in_groups(['Super admin'])) {
            return redirect()->back();
        }

        $this->gajiBayarModel->where('id', $pembayaran_gaji_id)->delete();
        $this->pengeluaranModel->where('id', $pengeluaran_id)->delete();
        session()->setFlashdata('gaji', 'Berhasil menghapus data gaji staf');
        return redirect()->to('/gaji/detail/' . $gaji_staf_id);
    }
}
