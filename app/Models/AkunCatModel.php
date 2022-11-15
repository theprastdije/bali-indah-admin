<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunCatModel extends Model
{
    protected $table = 'kategori_akun';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kategori_akun', 'kode_kategori_akun'
    ];

    public function getKategoriAkun($kategori_akun_id = false)
    {
        if ($kategori_akun_id == false) {
            return $this->builder()
                ->select('*')
                ->orderBy('kategori_akun.kode_kategori_akun', 'ASC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('*')
                ->where('kategori_akun.id', $kategori_akun_id)
                ->get()->getResultArray();
        }
    }
}
