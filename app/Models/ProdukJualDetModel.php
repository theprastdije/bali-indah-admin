<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukJualDetModel extends Model
{
    protected $table = 'penjualan_produk_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'penjualan_id', 'produk_id', 'diskon_id', 'tgl_booking', 'harga_jual_satuan', 'qty_produk', 'total_harga_jual'
    ];

    public function getOrderDetail($penjualan_id)
    {
        return $this->builder()
            ->select('penjualan_produk_detail.*, produk.nama_produk, produk.harga_produk')
            ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
            ->where('penjualan_produk_detail.penjualan_id', $penjualan_id)
            ->get()->getResultArray();
    }

    // Untuk laporan
    public function laporanDefault()
    {
        $bln_skrg = date('m');
        $thn_skrg = date('Y');
        $laporan =  $this->builder()
            ->select('produk.nama_produk, SUM(penjualan_produk_detail.qty_produk) AS jml_produk, SUM(penjualan_produk_detail.total_harga_jual) AS total_penjualan')
            ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
            ->where('YEAR(penjualan_produk_detail.tgl_booking)', $thn_skrg)
            ->where('MONTH(penjualan_produk_detail.tgl_booking)', $bln_skrg)
            ->groupBy('produk.nama_produk')
            ->orderBy('produk.nama_produk', 'ASC')
            ->get()->getResultArray();
        $jenis = 'default';
        $periode = month_indo(date('Y-m-d'));
        return ['laporan' => $laporan, 'jenis' => $jenis, 'periode' => $periode];
    }

    public function laporanByProduk($produk_id = false, $tgl_awal = false, $tgl_akhir = false)
    {
        // dd($produk_id);
        $bln_skrg = date('m');
        $thn_skrg = date('Y');
        $esc_tgl_awal = $this->builder()->db()->escape($tgl_awal);
        $esc_tgl_akhir = $this->builder()->db()->escape($tgl_akhir);
        $where = "penjualan_produk_detail.tgl_booking BETWEEN {$esc_tgl_awal} AND {$esc_tgl_akhir}";

        if ($produk_id == 'd') {
            // Tampilkan semua produk - default per bulan
            $jenis = 'periode';
            if ($tgl_awal == false) {
                $laporan = $this->builder()
                    ->select('penjualan_produk_detail.tgl_booking, SUM(penjualan_produk_detail.qty_produk) AS jml_produk, SUM(penjualan_produk_detail.total_harga_jual) AS total_penjualan, produk.nama_produk')
                    ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
                    ->where('YEAR(penjualan_produk_detail.tgl_booking)', $thn_skrg)
                    ->where('MONTH(penjualan_produk_detail.tgl_booking)', $bln_skrg)
                    ->groupBy('penjualan_produk_detail.produk_id')
                    ->orderBy('produk.nama_produk', 'ASC')
                    ->get()->getResultArray();
                $periode = month_indo(date('Y-m-d'));
            } else {
                if ($tgl_akhir == false) {
                    // Tampilkan penjualan semua produk hari yg dipilih
                    $laporan = $this->builder()
                        ->select('penjualan_produk_detail.tgl_booking, SUM(penjualan_produk_detail.qty_produk) AS jml_produk, SUM(penjualan_produk_detail.total_harga_jual) AS total_penjualan, produk.nama_produk')
                        ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
                        ->where('penjualan_produk_detail.tgl_booking', $tgl_awal)
                        ->groupBy('penjualan_produk_detail.produk_id')
                        ->orderBy('produk.nama_produk', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal);
                } else {
                    // Tampilkan penjualan semua produk rentang waktu tertentu
                    $laporan = $this->builder()
                        ->select('penjualan_produk_detail.tgl_booking, SUM(penjualan_produk_detail.qty_produk) AS jml_produk, SUM(penjualan_produk_detail.total_harga_jual) AS total_penjualan, produk.nama_produk')
                        ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
                        ->where($where)
                        ->groupBy('penjualan_produk_detail.produk_id')
                        ->orderBy('produk.nama_produk', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal) . ' - ' . date_indo($tgl_akhir);
                }
            }
        } else {
            // Tampilkan penjualan produk dipilih - default per bulan
            $jenis = 'produk';
            if ($tgl_awal == false) {
                $laporan = $this->builder()
                    ->select('penjualan_produk_detail.tgl_booking, penjualan_produk_detail.qty_produk AS jml_produk, penjualan_produk_detail.total_harga_jual AS total_penjualan, produk.nama_produk')
                    ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
                    ->where('penjualan_produk_detail.produk_id', $produk_id)
                    ->where('YEAR(penjualan_produk_detail.tgl_booking)', $thn_skrg)
                    ->where('MONTH(penjualan_produk_detail.tgl_booking)', $bln_skrg)
                    ->groupBy('penjualan_produk_detail.produk_id')
                    ->orderBy('penjualan_produk_detail.tgl_booking', 'ASC')
                    ->get()->getResultArray();
                $periode = month_indo(date('Y-m-d'));
            } else {
                if ($tgl_akhir == false) {
                    // Tampilkan penjualan produk dipilih hari yg dipilih
                    $laporan = $this->builder()
                        ->select('penjualan_produk_detail.tgl_booking, penjualan_produk_detail.qty_produk AS jml_produk, penjualan_produk_detail.total_harga_jual AS total_penjualan, produk.nama_produk')
                        ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
                        ->where('penjualan_produk_detail.produk_id', $produk_id)
                        ->where('penjualan_produk_detail.tgl_booking', $tgl_awal)
                        ->groupBy('penjualan_produk_detail.produk_id')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal);
                } else {
                    // Tampilkan penjualan produk dipilih rentang waktu tertentu
                    $laporan = $this->builder()
                        ->select('penjualan_produk_detail.tgl_booking, penjualan_produk_detail.qty_produk AS jml_produk, penjualan_produk_detail.total_harga_jual AS total_penjualan, produk.nama_produk')
                        ->join('produk', 'produk.id = penjualan_produk_detail.produk_id')
                        ->where('penjualan_produk_detail.produk_id', $produk_id)
                        ->where($where)
                        ->groupBy('penjualan_produk_detail.produk_id')
                        ->orderBy('penjualan_produk_detail.tgl_booking', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal) . ' - ' . date_indo($tgl_akhir);
                }
            }
        }

        return ['laporan' => $laporan, 'jenis' => $jenis, 'periode' => $periode];
    }
}
