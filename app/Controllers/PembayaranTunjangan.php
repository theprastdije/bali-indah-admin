<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PembayaranTunjangan extends BaseController
{
    function insert()
    {
        $tjg_staf_id = $this->request->getVar('tunjangan_staf_id');
        $tjg_id = $this->request->getVar('tunjangan_id');
        $jml_tjg = $this->request->getVar('jumlah_tunjangan');
        $periode_tjg = $this->request->getVar('periode_tunjangan');
        $jenis_pembayaran = $this->request->getVar('jenis_pembayaran');
        $tgl_pembayaran = $this->request->getVar('tgl_pembayaran');

        $hari_ini = strtotime($this->dateNow);
        $bulan_ini = date('m');
        $tahun_ini = date('Y');
        $tgl = strtotime($tgl_pembayaran);
        $bulan = date('m', $tgl);
        $tahun = date('Y', $tgl);

        // dd($tjg_staf_id, $tjg_id, $jml_tjg, $periode_tjg, $jenis_pembayaran);
        // dd($tgl_pembayaran);

        if (!$this->validate([
            'tgl_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tgl. pembayaran tidak boleh kosong'
                ]
            ],
            'jenis_pembayaran' => [
                'rules' => 'is_not_unique[jenis_pembayaran.id]',
                'errors' => [
                    'is_not_unique' => 'Cara pembayaran tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->to('/tunjangan/detail/' . $tjg_id)->withInput();
        } else {
            if ($periode_tjg == "harian") {
                // jika pembayarannya harian
                $check = $this->tunjanganBayarModel->cekTjgHari($tjg_staf_id, $tgl_pembayaran);
                if ($check['total'] == '1') {
                    // sudah dibayar
                    session()->setFlashdata('error_tjg', 'Tunjangan ini sudah dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                if ($tgl > $hari_ini) {
                    // belum boleh dibayar
                    session()->setFlashdata('error_tjg', 'Tunjangan belum boleh dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                // boleh dibayar
                $data_pengeluaran = [
                    'id' => '',
                    'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                    'jenis_transaksi_pengeluaran' => 'gaji',
                    'total_transaksi_pengeluaran' => $jml_tjg,
                    'created_at' => $this->datetimeNow,
                    'updated_at' => $this->datetimeNow
                ];
                $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

                $data_tjg = [
                    'id' => '',
                    'tunjangan_staf_id' => $tjg_staf_id,
                    'pengeluaran_id' => $pengeluaran_id,
                    'jenis_pembayaran_id' => $jenis_pembayaran,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'jumlah_pembayaran' => $jml_tjg
                ];
                $this->tunjanganBayarModel->insert($data_tjg);
                session()->setFlashdata('tunjangan', 'Berhasil membayar tunjangan staf');
                return redirect()->to('/tunjangan/detail/' . $tjg_id);
            } elseif ($periode_tjg == "bulanan") {
                // jika pembayarannya bulanan
                $check = $this->tunjanganBayarModel->cekTjgBulan($tjg_staf_id, $tahun, $bulan);
                if ($check['total'] == '1') {
                    // sudah dibayar
                    session()->setFlashdata('error_tjg', 'Tunjangan ini sudah dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                if (intval($tahun) > intval($tahun_ini)) {
                    // belum boleh dibayar - tahun berikutnya
                    session()->setFlashdata('error_tjg', 'Tunjangan belum boleh dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                if (intval($tahun) <= intval($tahun_ini)) {
                    if (intval($bulan) > intval($bulan_ini)) {
                        // belum boleh dibayar - tahun sama bulan berikutnya
                        session()->setFlashdata('error_tjg', 'Tunjangan belum boleh dibayar');
                        return redirect()->to('/tunjangan/detail/' . $tjg_id);
                    } else {
                        // boleh dibayar
                        $data_pengeluaran = [
                            'id' => '',
                            'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                            'jenis_transaksi_pengeluaran' => 'gaji',
                            'total_transaksi_pengeluaran' => $jml_tjg,
                            'created_at' => $this->datetimeNow,
                            'updated_at' => $this->datetimeNow
                        ];
                        $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

                        $data_tjg = [
                            'id' => '',
                            'tunjangan_staf_id' => $tjg_staf_id,
                            'pengeluaran_id' => $pengeluaran_id,
                            'jenis_pembayaran_id' => $jenis_pembayaran,
                            'tgl_pembayaran' => $tgl_pembayaran,
                            'jumlah_pembayaran' => $jml_tjg
                        ];
                        $this->tunjanganBayarModel->insert($data_tjg);
                        session()->setFlashdata('tunjangan', 'Berhasil membayar tunjangan staf');
                        return redirect()->to('/tunjangan/detail/' . $tjg_id);
                    }
                }
            } elseif ($periode_tjg == "tahunan") {
                // jika pembayarannya tahunan
                $check = $this->tunjanganBayarModel->cekTjgThn($tjg_staf_id, $tahun);
                if ($check['total'] == '1') {
                    // sudah dibayar
                    session()->setFlashdata('error_tjg', 'Tunjangan ini sudah dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                if (intval($tahun) > intval($tahun_ini)) {
                    // belum boleh dibayar
                    session()->setFlashdata('error_tjg', 'Tunjangan belum boleh dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                // boleh dibayar
                $data_pengeluaran = [
                    'id' => '',
                    'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                    'jenis_transaksi_pengeluaran' => 'gaji',
                    'total_transaksi_pengeluaran' => $jml_tjg,
                    'created_at' => $this->datetimeNow,
                    'updated_at' => $this->datetimeNow
                ];
                $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

                $data_tjg = [
                    'id' => '',
                    'tunjangan_staf_id' => $tjg_staf_id,
                    'pengeluaran_id' => $pengeluaran_id,
                    'jenis_pembayaran_id' => $jenis_pembayaran,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'jumlah_pembayaran' => $jml_tjg
                ];
                $this->tunjanganBayarModel->insert($data_tjg);
                session()->setFlashdata('tunjangan', 'Berhasil membayar tunjangan staf');
                return redirect()->to('/tunjangan/detail/' . $tjg_id);
            } elseif ($periode_tjg == "sekali") {
                // jika pembayarannya hanya sekali
                $check = $this->tunjanganBayarModel->cekTjgSekali($tjg_staf_id);
                if ($check['total'] == '1') {
                    // sudah dibayar
                    session()->setFlashdata('error_tjg', 'Tunjangan ini sudah dibayar');
                    return redirect()->to('/tunjangan/detail/' . $tjg_id);
                }
                // boleh dibayar
                $data_pengeluaran = [
                    'id' => '',
                    'tgl_transaksi_pengeluaran' => $this->datetimeNow,
                    'jenis_transaksi_pengeluaran' => 'gaji',
                    'total_transaksi_pengeluaran' => $jml_tjg,
                    'created_at' => $this->datetimeNow,
                    'updated_at' => $this->datetimeNow
                ];
                $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

                $data_tjg = [
                    'id' => '',
                    'tunjangan_staf_id' => $tjg_staf_id,
                    'pengeluaran_id' => $pengeluaran_id,
                    'jenis_pembayaran_id' => $jenis_pembayaran,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'jumlah_pembayaran' => $jml_tjg
                ];
                $this->tunjanganBayarModel->insert($data_tjg);
                session()->setFlashdata('tunjangan', 'Berhasil membayar tunjangan staf');
                return redirect()->to('/tunjangan/detail/' . $tjg_id);
            } else {
                // tidak valid
                session()->setFlashdata('error_tjg', 'Ada kesalahan');
                return redirect()->to('/tunjangan/detail/' . $tjg_id);
            }

            // $data_pengeluaran = [
            //     'id' => '',
            //     'tgl_transaksi_pengeluaran' => $this->datetimeNow,
            //     'jenis_transaksi_pengeluaran' => 'gaji',
            //     'total_transaksi_pengeluaran' => $jml_tjg,
            //     'created_at' => $this->datetimeNow,
            //     'updated_at' => $this->datetimeNow
            // ];
            // $pengeluaran_id = $this->pengeluaranModel->insert($data_pengeluaran);

            // $data_tjg = [
            //     'id' => '',
            //     'tunjangan_staf_id' => $tjg_staf_id,
            //     'pengeluaran_id' => $pengeluaran_id,
            //     'jenis_pembayaran_id' => $jenis_pembayaran,
            //     'tgl_pembayaran' => $tgl_pembayaran,
            //     'jumlah_pembayaran' => $jml_tjg
            // ];
            // $this->tunjanganBayarModel->insert($data_tjg);

            // session()->setFlashdata('tunjangan', 'Berhasil membayar tunjangan staf');
            // return redirect()->to('/tunjangan/detail/' . $tjg_id);
        }
    }
}
