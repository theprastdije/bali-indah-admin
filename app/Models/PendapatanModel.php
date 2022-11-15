<?php

namespace App\Models;

use CodeIgniter\Model;

class PendapatanModel extends Model
{
    protected $table = 'pendapatan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tgl_transaksi_pendapatan', 'jenis_transaksi_pendapatan', 'total_transaksi_pendapatan', 'created_at', 'updated_at'
    ];

    public function totalPendapatanBulanan()
    {
        $bln_skrg = date('m');
        $thn_skrg = date('Y');
        $bulanan = $this->builder()
            ->select('SUM(pendapatan.total_transaksi_pendapatan) as total_pendapatan')
            ->where('YEAR(pendapatan.tgl_transaksi_pendapatan)', $thn_skrg)
            ->where('MONTH(pendapatan.tgl_transaksi_pendapatan)', $bln_skrg)
            ->get()->getRowArray();
        return $bulanan;
    }

    public function totalPendapatanHarian()
    {
        $tgl_skrg = date('Y-m-d');
        $harian = $this->builder()
            ->select('SUM(pendapatan.total_transaksi_pendapatan) as total_pendapatan')
            ->where('pendapatan.tgl_transaksi_pendapatan', $tgl_skrg)
            ->get()->getRowArray();
        return $harian;
    }
}
