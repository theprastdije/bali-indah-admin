<?php

namespace App\Models;

use CodeIgniter\Model;

class PajakModel extends Model
{
    protected $table = 'pajak';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_pajak_id', 'jenis_pajak', 'kategori_pajak', 'deskripsi_pajak', 'tarif_pajak'
    ];

    public function getPajak($pajak = false)
    {
        if ($pajak == false) {
            return $this->builder()
                ->select('pajak.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = pajak.akun_pajak_id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('pajak.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = pajak.akun_pajak_id')
                ->where('pajak.id', $pajak)
                ->get()->getRowArray();
        }
    }

    public function getPajakPenjualan()
    {
        return $this->builder()
            ->select('pajak.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
            ->join('akun', 'akun.id = pajak.akun_pajak_id')
            ->where('pajak.kategori_pajak', 'penjualan')
            ->get()->getResultArray();
    }

    public function getPajakPembelian()
    {
        return $this->builder()
            ->select('pajak.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
            ->join('akun', 'akun.id = pajak.akun_pajak_id')
            ->where('pajak.kategori_pajak', 'pembelian')
            ->get()->getResultArray();
    }
}
