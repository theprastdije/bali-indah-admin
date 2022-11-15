<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetPenyusutanModel extends Model
{
    protected $table = 'penyusutan_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_penyusutan_id', 'aset_id', 'metode_penyusutan', 'masa_manfaat', 'nilai_penyusutan'
    ];

    public function getPenyusutanAset($aset_id = false)
    {
        return $this->builder()
            ->select('penyusutan_aset.*, akun.kategori_akun_id, akun.nama_akun, akun.kode_akun')
            ->join('akun', 'akun.id = penyusutan_aset.akun_penyusutan_id')
            ->where('aset_id', $aset_id)
            ->get()->getRowArray();
    }
}
