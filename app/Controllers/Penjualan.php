<?php

namespace App\Controllers;

class Penjualan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Penjualan',
            'penjualan' => $this->produkJualModel->getPenjualanLunas(),
            'order' => $this->produkJualModel->getPenjualanOrder()
        ];
        return view('penjualan/index', $data);
    }

    public function detail($penjualan_id)
    {
        $order = $this->produkJualModel->getPenjualanDetail($penjualan_id);
        $order_id = $order['id'];
        $data = [
            'title' => 'Penjualan',
            'order' => $order,
            'order_detail' => $this->produkJualDetModel->getOrderDetail($order_id)
        ];
        return view('penjualan/detailnew', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Penjualan',
            'produk' => $this->produkModel->getProduk(),
            'pajak' => $this->pajakModel->getPajakPenjualan(),
            'diskon' => $this->produkDiskonModel->getDiskonAktif(),
            'jenis_pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'total' => 0
        ];
        return view('penjualan/add', $data);
    }

    public function insert()
    {
        $tgl_transaksi = $this->request->getVar('tgl_transaksi');
        $nama_customer = $this->request->getVar('nama_customer');
        $pajak_penjualan_id = $this->request->getVar('pajak_penjualan');
        $catatan = $this->request->getVar('catatan');

        $total_harga_jual = $this->request->getVar('total_harga');

        $subtotal = $this->request->getVar('subtotal');
        $total_belanja = $this->request->getVar('total_belanja');
        $jml_bayar = $this->request->getVar('jml_bayar');
        $jenis_pembayaran_id = $this->request->getVar('jenis_pembayaran');
        // $jumlah_produk = $this->request->getVar('total_item');
        // dd($jumlah_produk, $produk_id, $harga_jual_satuan, $qty_produk, $diskon_id, $total_harga_jual);

        if (floatval($jml_bayar) < floatval($total_belanja)) {
            $status = 'order';
            $total_trx = $jml_bayar;
        } elseif (floatval($jml_bayar) >= floatval($total_belanja)) {
            $status = 'lunas';
            $total_trx = $total_belanja;
        } else {
            $status = 'order';
            $total_trx = $total_belanja;
        }

        $pendapatan = [
            'id' => '',
            'tgl_transaksi_pendapatan' => $this->datetimeNow,
            'jenis_transaksi_pendapatan' => 'produk',
            'total_transaksi_pendapatan' => $total_trx,
            'created_at' => $this->datetimeNow,
            'updated_at' => $this->datetimeNow
        ];
        $pendapatan_id = $this->pendapatanModel->insert($pendapatan);

        $penjualan = [
            'id' => '',
            'pendapatan_id' => $pendapatan_id,
            'jenis_pembayaran_id' => $jenis_pembayaran_id,
            'nama_customer' => $nama_customer,
            'tgl_transaksi' => $tgl_transaksi,
            'subtotal' => $subtotal,
            'total_belanja' => $total_belanja,
            'jumlah_pembayaran' => $jml_bayar,
            'status_pembayaran' => $status,
            'catatan' => $catatan
        ];
        $penjualan_id = $this->produkJualModel->insert($penjualan);

        $data_detail_penjualan = [];
        for ($i = 0; $i < count($total_harga_jual); $i++) {
            $penjualan_detail = [
                'id' => '',
                'penjualan_id' => $penjualan_id,
                'produk_id' => $this->request->getVar('nama_produk')[$i],
                'diskon_id' => $this->request->getVar('diskon_produk')[$i],
                'tgl_booking' => $this->request->getVar('tgl_booking')[$i],
                'harga_jual_satuan' => $this->request->getVar('harga_jual')[$i],
                'qty_produk' => $this->request->getVar('qty')[$i],
                'total_harga_jual' => $this->request->getVar('total_harga')[$i]
            ];
            $penjualan_detail_id = $this->produkJualDetModel->insert($penjualan_detail);
            $data_detail_penjualan[$i] = $penjualan_detail_id;
        }

        if ($pajak_penjualan_id > 0) {
            foreach ($data_detail_penjualan as $dtl_jual) {
                $pajak_penjualan = [
                    'pajak_id' => $pajak_penjualan_id,
                    'penjualan_detail_id' => $dtl_jual
                ];
                $this->db->table('pajak_penjualan')->insert($pajak_penjualan);
            }
        }
        session()->setFlashdata('penjualan', 'Penjualan berhasil');
        return redirect()->to('/penjualan');
    }

    public function bayarorder()
    {
        $total_belanja = $this->request->getVar('total_belanja');
        $jml_bayar = $this->request->getVar('jumlah_bayar'); // yg sudah dibayar
        $jml_pembayaran = $this->request->getVar('bayar'); // yg dibayar
        $penjualan_id = $this->request->getVar('penjualan_id');
        $pendapatan_id = $this->request->getVar('pendapatan_id');

        if (floatval($total_belanja) <= floatval($jml_bayar) + floatval($jml_pembayaran)) {
            $bayar = $total_belanja;
            $status = 'lunas';
        } else {
            $bayar = $jml_bayar + $jml_pembayaran;
            $status = 'order';
        }

        $pendapatan = [
            'total_transaksi_pendapatan' => $bayar,
        ];
        $this->pendapatanModel->update($pendapatan_id, $pendapatan);

        $penjualan = [
            'jumlah_pembayaran' => $bayar,
            'status_pembayaran' => $status
        ];
        $this->produkJualModel->update($penjualan_id, $penjualan);
        session()->setFlashdata('penjualan', 'Pembayaran berhasil');
        return redirect()->to('/penjualan');
    }

    public function laporan()
    {
        $produk_id = $this->request->getVar('produk_id');
        $periode_awal = $this->request->getVar('periode_awal');
        $periode_akhir = $this->request->getVar('periode_akhir');

        if (!$produk_id) {
            // default
            $penjualan = $this->produkJualDetModel->laporanDefault()['laporan'];
            $jenis = $this->produkJualDetModel->laporanDefault()['jenis'];
            $periode = $this->produkJualDetModel->laporanDefault()['periode'];
        } else {
            // set waktu / produk
            $penjualan = $this->produkJualDetModel->laporanByProduk($produk_id, $periode_awal, $periode_akhir)['laporan'];
            $jenis = $this->produkJualDetModel->laporanByProduk($produk_id, $periode_awal, $periode_akhir)['jenis'];
            $periode = $this->produkJualDetModel->laporanByProduk($produk_id, $periode_awal, $periode_akhir)['periode'];
        }

        $data = [
            'title' => 'Laporan Penjualan',
            'penjualan' => $penjualan,
            'jenis' => $jenis,
            'periode' => $periode,
            'produk' => $this->produkModel->getProduk(),
            'produk_dipilih' => $this->produkModel->getProduk($produk_id)
        ];
        return view('penjualan/laporan', $data);
    }

    public function delete()
    {
        $penjualan_id = $this->request->getVar('penjualan_id');
        $this->penjualanDetailModel->where('penjualan_id', $penjualan_id)->delete();
        $this->penjualanModel->where('id', $penjualan_id)->delete();
        session()->setFlashdata('penjualan', 'Data penjualan berhasil dihapus');
        return redirect()->to('/penjualan');
        // 
    }

    // public function addnew()
    // {
    //     if (!session('produk') && !session('customer')) {
    //         $data = [
    //             'title' => 'Penjualan',
    //             'produk' => $this->produkModel->getProduk(),
    //             'cart' => '',
    //             'customer' => '',
    //             'total' => 0
    //         ];
    //     } else {
    //         $data = [
    //             'title' => 'Penjualan',
    //             'produk' => $this->produkModel->getProduk(),
    //             'cart' => array_values(session('produk')),
    //             'customer' => session('customer'),
    //             'total' => $this->total()
    //         ];
    //     }
    //     return view('penjualan/addnew', $data);
    // }

    // public function datastore()
    // {
    //     if ($this->request->getVar('nama_customer') == "") {
    //         $nama_customer = "-";
    //     } else {
    //         $nama_customer = $this->request->getVar('nama_customer');
    //     }
    //     if ($this->request->getVar('tgl_transaksi') == "") {
    //         $tgl_transaksi = date('Y-m-d');
    //     } else {
    //         $tgl_transaksi = $this->request->getVar('tgl_transaksi');
    //     }
    //     $produk_id = $this->request->getVar('produk_id');
    //     $harga = $this->request->getVar('harga');
    //     $jumlah = $this->request->getVar('jumlah');
    //     $tgl_booking = $this->request->getVar('tgl_booking');

    //     $data = [
    //         'produk_id' => $produk_id,
    //         'harga' => $harga,
    //         'jumlah' => $jumlah,
    //         'tgl_booking' => $tgl_booking
    //     ];
    //     $data_customer = [
    //         'tgl_transaksi' => $tgl_transaksi,
    //         'nama_customer' => $nama_customer
    //     ];

    //     if (session()->has('produk')) {
    //         // Ada session
    //         $index = $this->check($produk_id);
    //         $produk = array_values(session('produk'));
    //         if ($index == -1) {
    //             array_push($produk, $data);
    //         } else {
    //             $produk[$index]['jumlah'] += $data['jumlah'];
    //         }
    //         session()->set('produk', $produk);
    //     } else {
    //         // Tidak ada session
    //         $produk = array($data);
    //         $customer = $data_customer;
    //         session()->set('produk', $produk);
    //         session()->set('customer', $customer);
    //     }
    //     return redirect()->to('/penjualan/add');
    // }

    // private function check($produk_id)
    // {
    //     $produk_data = array_values(session('produk'));
    //     for ($i = 0; $i < count($produk_data); $i++) {
    //         if ($produk_data[$i]['produk_id'] == $produk_id) {
    //             return $i;
    //         }
    //     }
    //     return -1;
    // }

    // private function jumlah()
    // {
    //     $qty = 0;
    //     $produk_data = array_values(session('produk'));
    //     foreach ($produk_data as $produk) {
    //         $qty += intval($produk['jumlah']);
    //     }
    //     return $qty;
    // }

    // private function total()
    // {
    //     $total = 0;
    //     $produk_data = array_values(session('produk'));
    //     foreach ($produk_data as $produk) {
    //         $total += intval($produk['harga']) * intval($produk['jumlah']);
    //     }
    //     return $total;
    // }

    // public function remove()
    // {
    //     $produk_id = $this->request->getVar('produk_id');
    //     $tgl_booking = $this->request->getVar('tgl_booking');
    //     $index = $this->check($produk_id, $tgl_booking);
    //     $produk = array_values(session('produk'));
    //     unset($produk[$index]);
    //     session()->set('produk', $produk);
    //     return redirect()->to('/penjualan/add');
    // }

    // public function removeall()
    // {
    //     session()->remove(['produk', 'customer']);
    //     return redirect()->to('/penjualan/add');
    // }

    // public function save()
    // {
    //     if (session()->has('produk')) {
    //         $data_customer = session('customer');
    //         $order = array(
    //             'id' => '',
    //             'nama_customer' => $data_customer['nama_customer'],
    //             'tgl_order' => $data_customer['tgl_transaksi'],
    //             'jumlah' => $this->jumlah(),
    //             'total_harga' => $this->total(),
    //             'status' => 'paid',
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         );
    //         $order_id = $this->penjualanModel->insertData($order);

    //         $items = session()->get('produk');
    //         foreach ($items as $item) {
    //             $order_detail = array(
    //                 'id' => '',
    //                 'penjualan_id' => $order_id,
    //                 'produk_id' => $item['produk_id'],
    //                 'tgl_booking' => $item['tgl_booking'],
    //                 'harga_jual' => intval($item['harga']),
    //                 'jumlah' => intval($item['jumlah']),
    //                 'total_harga' => intval($item['harga']) * intval($item['jumlah'])
    //             );
    //             $this->penjualanDetailModel->insertData($order_detail);
    //         }

    //         session()->remove(['produk', 'customer']);
    //         session()->setFlashdata('penjualan', 'Data penjualan berhasil ditambahkan');
    //         return redirect()->to('/penjualan');
    //     } else {
    //         return redirect()->to('/penjualan/add');
    //     }
    // }
}
