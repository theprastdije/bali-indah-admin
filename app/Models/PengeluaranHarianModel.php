<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranHarianModel extends Model
{
    protected $table = 'pengeluaran_harian';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_id', 'pengeluaran_id', 'rincian_pengeluaran', 'tgl_transaksi', 'harga_satuan', 'jumlah', 'total_pengeluaran', 'catatan', 'bukti_transaksi'
    ];

    public function getBelanja($pengeluaran_harian = false)
    {
        // return $pengeluaran_harian;
        if ($pengeluaran_harian == false) {
            return $this->builder()
                ->select('pengeluaran_harian.*')
                ->orderBy('tgl_transaksi', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('pengeluaran_harian.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, pengeluaran.tgl_transaksi_pengeluaran as tgl_belanja')
                // ->join('users', 'users.id = pengeluaran_harian.user_id')
                ->join('akun', 'akun.id = pengeluaran_harian.akun_id')
                ->join('pengeluaran', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                ->where('pengeluaran_harian.id', $pengeluaran_harian)
                ->get()->getRowArray();
        }
    }
}
