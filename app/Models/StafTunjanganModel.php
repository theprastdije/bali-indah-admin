<?php

namespace App\Models;

use CodeIgniter\Model;

class StafTunjanganModel extends Model
{
    protected $table = 'tunjangan_staf';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'jenis_tunjangan_id', 'created_at', 'updated_at'
    ];

    public function getUser()
    {
        return $this->builder('users')
            ->select('users.id, users.full_name as nama_staf')
            ->where('users.full_name <>', null)
            ->get()->getResultArray();
    }

    public function getTunjangan($tunjangan_staf = false)
    {
        if ($tunjangan_staf == false) {
            return $this->builder()
                ->select('tunjangan_staf.*, users.full_name as nama_staf, jenis_tunjangan.jenis_tunjangan, jenis_tunjangan.jumlah_tunjangan, jenis_tunjangan.periode_tunjangan')
                ->join('users', 'users.id = tunjangan_staf.user_id')
                ->join('jenis_tunjangan', 'jenis_tunjangan.id = tunjangan_staf.jenis_tunjangan_id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('tunjangan_staf.*, users.full_name as nama_staf, jenis_tunjangan.jenis_tunjangan, jenis_tunjangan.jumlah_tunjangan, jenis_tunjangan.periode_tunjangan')
                ->join('users', 'users.id = tunjangan_staf.user_id')
                ->join('jenis_tunjangan', 'jenis_tunjangan.id = tunjangan_staf.jenis_tunjangan_id')
                ->where('tunjangan_staf.id', $tunjangan_staf)
                ->get()->getRowArray();
        }
    }

    public function getTunjanganStaf($jenis_tunjangan_id)
    {
        return $this->builder()
            ->select('tunjangan_staf.*, users.full_name as nama_staf')
            ->join('users', 'users.id = tunjangan_staf.user_id')
            ->join('jenis_tunjangan', 'jenis_tunjangan.id = tunjangan_staf.jenis_tunjangan_id')
            ->where('jenis_tunjangan_id', $jenis_tunjangan_id)
            ->get()->getResultArray();
    }
}
