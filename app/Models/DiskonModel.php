<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    protected $table = 'diskon_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_diskon_id', 'nama_diskon', 'deskripsi_diskon', 'kode_diskon', 'jumlah_diskon', 'satuan_diskon', 'periode_awal_diskon', 'periode_akhir_diskon'
    ];

    public function getDiskon($diskon_id = false)
    {
        if ($diskon_id == false) {
            return $this->builder()
                ->select('*')
                ->orderBy('diskon_produk.periode_akhir_diskon', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('diskon_produk.*, akun.kategori_akun_id, akun.nama_akun, akun.kode_akun')
                ->join('akun', 'diskon_produk.akun_diskon_id = akun.id')
                ->where('diskon_produk.id', $diskon_id)
                ->get()->getRowArray();
        }
    }

    public function getDiskonAktif()
    {
        $datetime = date('Y-m-d H:i:s');
        return $this->db->query("
            SELECT * FROM diskon_produk
            WHERE '" . $datetime . "' BETWEEN diskon_produk.periode_awal_diskon AND diskon_produk.periode_akhir_diskon
        ")->getResultArray();
    }
}
