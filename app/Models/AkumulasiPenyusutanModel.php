<?php

namespace App\Models;

use CodeIgniter\Model;

class AkumulasiPenyusutanModel extends Model
{
    protected $table = 'akumulasi_penyusutan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_akumulasi_penyusutan_id', 'penyusutan_aset_id', 'nilai_akumulasi_penyusutan', 'tahun_akumulasi_penyusutan'
    ];

    public function getAkumPenyusutan($penyusutan_id = false)
    {
        return $this->builder()
            ->select('akumulasi_penyusutan.*')
            ->where('penyusutan_aset_id', $penyusutan_id)
            ->get()->getRowArray();
    }
}
