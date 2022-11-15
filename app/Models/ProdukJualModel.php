<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukJualModel extends Model
{
    protected $table = 'penjualan_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pendapatan_id', 'jenis_pembayaran_id', 'nama_customer', 'tgl_transaksi', 'subtotal', 'total_belanja', 'jumlah_pembayaran', 'status_pembayaran', 'catatan'
    ];

    public function getPenjualanLunas()
    {
        return $this->builder()
            ->select('penjualan_produk.*')
            ->where('penjualan_produk.status_pembayaran <>', 'order')
            ->orderBy('penjualan_produk.tgl_transaksi', 'DESC')
            ->get()->getResultArray();
    }

    public function getPenjualanOrder()
    {
        return $this->builder()
            ->select('penjualan_produk.*')
            ->where('penjualan_produk.status_pembayaran', 'order')
            ->orderBy('penjualan_produk.tgl_transaksi', 'DESC')
            ->get()->getResultArray();
    }

    public function getPenjualanDetail($penjualan_id)
    {
        return $this->builder()
            ->select('penjualan_produk.*')
            ->where('penjualan_produk.id', $penjualan_id)
            ->get()->getRowArray();
    }
}
