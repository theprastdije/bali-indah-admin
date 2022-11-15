<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanDetModel extends Model
{
    protected $table = 'penjualan_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'penjualan_id', 'produk_id', 'tgl_booking', 'harga_jual', 'jumlah', 'total_harga'
    ];

    public function insertData($order_detail)
    {
        if ($order_detail['id'] > 0) {
            $this->builder()->where('id', $order_detail['id'])->update($order_detail);
            return $order_detail['id'];
        } else {
            $this->builder()->insert($order_detail);
            return $this->db->insertID();
        }
    }

    public function getOrderDetail($order_id = false)
    {
        if ($order_id != false) {
            $order_detail = $this->builder()
                ->select('penjualan_detail.*, nama_produk')
                ->join('produk', 'produk.id = penjualan_detail.produk_id')
                ->where('penjualan_id', $order_id)
                ->get()->getResultArray();
            return $order_detail;
        } else {
            return 0;
        }
    }

    public function getPenjualanData($periode = false, $tgl = false, $tgl_awal = false, $tgl_akhir = false, $bulan = false, $tahun = false)
    {
        // dd($periode, $tgl, $tgl_awal, $tgl_akhir, $bulan, $tahun);
        if ($periode == false) {
            // tidak ditentukan
            $penjualan_data = $this->db->query("
                SELECT produk.id, produk.nama_produk, SUM(penjualan_detail.jumlah) AS jumlah, SUM(penjualan_detail.total_harga) AS total_harga 
                FROM penjualan_detail
                JOIN penjualan ON penjualan_detail.penjualan_id = penjualan.id
                JOIN produk ON penjualan_detail.produk_id = produk.id
                WHERE (penjualan.status = 'paid' OR penjualan.status = 'done')
                AND penjualan.tgl_order = $tgl
                GROUP BY produk.nama_produk
            ")->getResultArray();
        } else {
            if ($periode == 'd') {
                // harian
                $penjualan_data = $this->db->query("
                    SELECT produk.id, produk.nama_produk, SUM(penjualan_detail.jumlah) AS jumlah, SUM(penjualan_detail.total_harga) AS total_harga 
                    FROM penjualan_detail
                    JOIN penjualan ON penjualan_detail.penjualan_id = penjualan.id
                    JOIN produk ON penjualan_detail.produk_id = produk.id
                    WHERE (penjualan.status = 'paid' OR penjualan.status = 'done')
                    AND penjualan.tgl_order = '$tgl'
                    GROUP BY produk.nama_produk
                ")->getResultArray();
                return $penjualan_data;
            } elseif ($periode == 'm') {
                // bulanan
                $penjualan_data = $this->db->query("
                    SELECT produk.id, produk.nama_produk, SUM(penjualan_detail.jumlah) AS jumlah, SUM(penjualan_detail.total_harga) AS total_harga 
                    FROM penjualan_detail
                    JOIN penjualan ON penjualan_detail.penjualan_id = penjualan.id
                    JOIN produk ON penjualan_detail.produk_id = produk.id
                    WHERE (penjualan.status = 'paid' OR penjualan.status = 'done')
                    AND YEAR(penjualan.tgl_order) = $tahun
                    AND MONTH(penjualan.tgl_order) = $bulan
                    GROUP BY produk.nama_produk
                ")->getResultArray();
                return $penjualan_data;
            } elseif ($periode == 'y') {
                // tahunan
                $penjualan_data = $this->db->query("
                    SELECT produk.id, produk.nama_produk, SUM(penjualan_detail.jumlah) AS jumlah, SUM(penjualan_detail.total_harga) AS total_harga 
                    FROM penjualan_detail
                    JOIN penjualan ON penjualan_detail.penjualan_id = penjualan.id
                    JOIN produk ON penjualan_detail.produk_id = produk.id
                    WHERE (penjualan.status = 'paid' OR penjualan.status = 'done')
                    AND YEAR(penjualan.tgl_order) = $tahun
                    GROUP BY produk.nama_produk
                ")->getResultArray();
                return $penjualan_data;
            } else {
                // periode tertentu
                $penjualan_data = $this->db->query("
                    SELECT produk.id, produk.nama_produk, SUM(penjualan_detail.jumlah) AS jumlah, SUM(penjualan_detail.total_harga) AS total_harga 
                    FROM penjualan_detail
                    JOIN penjualan ON penjualan_detail.penjualan_id = penjualan.id
                    JOIN produk ON penjualan_detail.produk_id = produk.id
                    WHERE (penjualan.status = 'paid' OR penjualan.status = 'done')
                    AND penjualan.tgl_order BETWEEN '$tgl_awal' AND  '$tgl_akhir'
                    GROUP BY produk.nama_produk
                ")->getResultArray();
                return $penjualan_data;
            }
        }
        return $penjualan_data;
    }
}
