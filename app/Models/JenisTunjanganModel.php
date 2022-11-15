<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisTunjanganModel extends Model
{
    protected $table = 'jenis_tunjangan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_tunjangan_id', 'jenis_tunjangan', 'jumlah_tunjangan', 'periode_tunjangan', 'status_tunjangan', 'created_at', 'updated_at'
    ];

    public function getJenisTjg($jenis_tunjangan = false)
    {
        if ($jenis_tunjangan == false) {
            return $this->builder()
                ->select('jenis_tunjangan.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = jenis_tunjangan.akun_tunjangan_id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('jenis_tunjangan.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun')
                ->join('akun', 'akun.id = jenis_tunjangan.akun_tunjangan_id')
                ->where('jenis_tunjangan.id', $jenis_tunjangan)
                ->get()->getRowArray();
        }
    }
}
