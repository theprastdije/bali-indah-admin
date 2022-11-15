<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukCatModel extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_produk_id', 'nama_kategori_produk', 'kode_kategori_produk'
    ];

    public function getKategoriProduk($kategori_produk = false)
    {
        if ($kategori_produk == false) {
            return $this->builder()
                ->select('kategori_produk.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = kategori_produk.akun_produk_id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('kategori_produk.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = kategori_produk.akun_produk_id')
                ->where('kategori_produk.id', $kategori_produk)
                ->get()->getRowArray();
        }
    }
}
