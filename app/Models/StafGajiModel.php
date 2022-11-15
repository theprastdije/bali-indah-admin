<?php

namespace App\Models;

use CodeIgniter\Model;

class StafGajiModel extends Model
{
    protected $table = 'gaji_staf';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'akun_gaji_id', 'jumlah_gaji', 'created_at', 'updated_at'
    ];

    public function getUser()
    {
        return $this->builder('users')
            ->select('users.id, users.full_name as nama_staf, users.register_date as tgl_masuk')
            ->where('users.full_name <>', null)
            ->where('users.register_date <>', null)
            ->get()->getResultArray();
    }

    public function getUserRegDate($user_id)
    {
        return $this->builder('users')
            ->select('users.register_date as tgl_masuk')
            ->where('users.id', $user_id)
            ->get()->getRowArray();
    }

    public function getGajiStaf($gaji_staf = false)
    {
        if ($gaji_staf == false) {
            return $this->builder()
                ->select('gaji_staf.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, users.full_name as nama_staf')
                ->join('users', 'users.id = gaji_staf.user_id')
                ->join('akun', 'akun.id = gaji_staf.akun_gaji_id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('gaji_staf.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, users.full_name as nama_staf')
                ->join('users', 'users.id = gaji_staf.user_id')
                ->join('akun', 'akun.id = gaji_staf.akun_gaji_id')
                ->where('gaji_staf.id', $gaji_staf)
                ->get()->getRowArray();
        }
    }
}
