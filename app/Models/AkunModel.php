<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kategori_akun_id', 'nama_akun', 'kode_akun'
    ];

    public function getAkun($akun_id = false)
    {
        if ($akun_id == false) {
            return $this->builder()
                ->select('kategori_akun.kode_kategori_akun, kategori_akun.kategori_akun, akun.*')
                ->join('kategori_akun', 'akun.kategori_akun_id = kategori_akun.id')
                ->orderBy('akun.kode_akun', 'ASC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('kategori_akun.kategori_akun, akun.*')
                ->join('kategori_akun', 'akun.kategori_akun_id = kategori_akun.id')
                ->where('akun.id', $akun_id)
                ->get()->getRowArray();
        }
    }

    // Jangan lupa pakai where setiap kategori
}
