<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_aset_id', 'nama_aset', 'kode_aset', 'deskripsi_aset', 'tgl_perolehan', 'harga_perolehan', 'status_aset', 'dapat_disusutkan'
    ];

    public function getAset($aset = false)
    {
        if ($aset == false) {
            return $this->builder()
                ->select('aset.*, akun.kategori_akun_id, akun.nama_akun, akun.kode_akun')
                ->join('akun', 'akun.id = aset.akun_aset_id')
                ->where('aset.status_aset', 1)
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('aset.*,')
                ->where('aset.id', $aset)
                ->get()->getRowArray();
        }
    }

    public function getAsetDibeli($pembelian_aset = false)
    {
        if ($pembelian_aset == false) {
            return $this->builder()
                ->select('aset.*, akun.kategori_akun_id, akun.nama_akun, akun.kode_akun')
                ->join('akun', 'akun.id = aset.akun_aset_id')
                ->where('aset.status_aset', 0)
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('aset.*, akun.kategori_akun_id, akun.nama_akun, akun.kode_akun')
                ->join('akun', 'akun.id = aset.akun_aset_id')
                ->where('aset.id', $pembelian_aset)
                ->get()->getRowArray();
        }
    }
}
