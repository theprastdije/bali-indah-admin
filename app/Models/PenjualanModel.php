<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_customer', 'tgl_order', 'jumlah', 'total_harga', 'status', 'created_at', 'updated_at'
    ];

    public function insertData($order)
    {
        if ($order['id'] > 0) {
            $this->builder()->where('id', $order['id'])->update($order);
            return $order['id'];
        } else {
            $this->builder()->insert($order);
            return $this->db->insertID();
        }
    }

    public function getOrderData()
    {
        // 
        return $this->builder()
            ->select('*')
            ->orderBy('tgl_order', 'DESC')
            ->get()->getResultArray();
    }

    public function getOrderDataBy($order_id)
    {
        return $this->builder()
            ->select('*')
            ->where('id', $order_id)
            ->get()->getRowArray();
    }

    public function countPenjualanBy($tahun)
    {
        $penjualanThn = $this->db->query("
            SELECT SUM(total_harga) FROM penjualan
            WHERE YEAR(tgl_order) = $tahun
        ")->getRowArray();
        return $penjualanThn;
    }
}
