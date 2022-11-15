<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'akun_id', 'rincian_pengeluaran', 'tgl_transaksi', 'harga_satuan', 'jumlah', 'total_pengeluaran', 'catatan', 'bukti_pengeluaran', 'status_pengajuan'
    ];

    public function getPengajuan($pengajuan_id = false)
    {
        if ($pengajuan_id == false) {
            return $this->builder()
                ->select('pengajuan.*')
                ->orderBy('tgl_transaksi', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('pengajuan.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, users.username, users.full_name as nama_staf')
                ->join('users', 'users.id = pengajuan.user_id')
                ->join('akun', 'akun.id = pengajuan.akun_id')
                ->where('pengajuan.id', $pengajuan_id)
                ->get()->getRowArray();
        }
    }

    public function getPengajuanStaf($staf_id)
    {
        return $this->builder()
            ->select('pengajuan.*')
            ->orderBy('tgl_transaksi', 'DESC')
            ->where('user_id', $staf_id)
            ->get()->getResultArray();
    }

    public function getPengajuanManajer()
    {
        return $this->builder()
            ->select('pengajuan.*')
            ->orderBy('tgl_transaksi', 'DESC')
            ->where('status_pengajuan', 0)
            ->get()->getResultArray();
    }
}
