<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranGajiModel extends Model
{
    protected $table = 'pembayaran_gaji';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'gaji_staf_id', 'pengeluaran_id', 'jenis_pembayaran_id', 'periode_pembayaran_bulan', 'periode_pembayaran_tahun', 'tgl_pembayaran', 'jumlah_pembayaran'
    ];

    public function cekPembayaranGaji($gaji_staf_id)
    {
        $bulan = date('n');
        $tahun = date('Y');
        return $this->db->query('
            SELECT COUNT(pembayaran_gaji.id) as total FROM pembayaran_gaji
            WHERE pembayaran_gaji.periode_pembayaran_tahun = ' . $tahun . '
            AND pembayaran_gaji.periode_pembayaran_bulan = ' . $bulan . '
            AND pembayaran_gaji.gaji_staf_id = ' . $gaji_staf_id . '
        ')->getRowArray();
    }

    public function listPembayaranGaji($gaji_staf_id)
    {
        return $this->builder()
            ->select('pembayaran_gaji.*')
            ->where('gaji_staf_id', $gaji_staf_id)
            ->orderBy('periode_pembayaran_tahun, periode_pembayaran_bulan', 'DESC')
            ->get()->getResultArray();
    }

    public function getPembayaranGaji()
    {
        return $this->builder()
            ->select('pembayaran_gaji.*, users.full_name as nama_staf')
            ->join('gaji_staf', 'gaji_staf.id = pembayaran_gaji.gaji_staf_id')
            ->join('users', 'users.id = gaji_staf.user_id')
            ->orderBy('pembayaran_gaji.tgl_pembayaran', 'DESC')
            ->get()->getResultArray();
    }

    public function cekByDate($gaji_staf_id, $bulan, $tahun)
    {
        return $this->db->query('
            SELECT COUNT(pembayaran_gaji.id) as total FROM pembayaran_gaji
            WHERE pembayaran_gaji.periode_pembayaran_tahun = ' . $tahun . '
            AND pembayaran_gaji.periode_pembayaran_bulan = ' . $bulan . '
            AND pembayaran_gaji.gaji_staf_id = ' . $gaji_staf_id . '
        ')->getRowArray();
    }
}
