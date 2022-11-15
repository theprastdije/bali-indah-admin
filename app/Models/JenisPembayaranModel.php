<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPembayaranModel extends Model
{
    protected $table = 'jenis_pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_jenis_pembayaran_id', 'nama_jenis_pembayaran', 'deskripsi_jenis_pembayaran'
    ];

    public function getJenisPembayaran($jenis_pembayaran = false)
    {
        if ($jenis_pembayaran == false) {
            return $this->builder()
                ->select('jenis_pembayaran.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = jenis_pembayaran.akun_jenis_pembayaran_id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('jenis_pembayaran.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = jenis_pembayaran.akun_jenis_pembayaran_id')
                ->where('jenis_pembayaran.id', $jenis_pembayaran)
                ->get()->getRowArray();
        }
    }
}
