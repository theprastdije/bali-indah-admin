<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetCatModel extends Model
{
    protected $table = 'kategori_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_id', 'nama_kategori_aset', 'jenis_aset', 'metode_penyusutan_fiskal', 'metode_penyusutan_komersial', 'persen_penyusutan_fiskal', 'persen_penyusutan_komersial', 'masa_manfaat_fiskal', 'masa_manfaat_komersial'
    ];

    public function getAsetCat($aset_cat_id = false)
    {
        if ($aset_cat_id == false) {
            return $this->builder()
                ->select('kategori_aset.*, akun.kode_akun, akun.nama_akun')
                ->join('akun', 'kategori_aset.akun_id = akun.id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('kategori_aset.*, akun.kode_akun, akun.nama_akun')
                ->join('akun', 'kategori_aset.akun_id = akun.id')
                ->where('kategori_aset.id', $aset_cat_id)
                ->get()->getRowArray();
        }
    }
}
