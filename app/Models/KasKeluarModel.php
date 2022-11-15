<?php

namespace App\Models;

use CodeIgniter\Model;

class KasKeluarModel extends Model
{
    protected $table = 'kas_keluar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pengeluaran_id', 'akun_id', 'pajak_id', 'deskripsi', 'jumlah'
    ];

    public function getKasKeluar($kas_keluar = false)
    {
        if ($kas_keluar == false) {
            return $this->builder()
                ->select('kas_keluar.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, pengeluaran.tgl_transaksi_pengeluaran as tgl_kas_keluar')
                ->join('akun', 'akun.id = kas_keluar.akun_id')
                ->join('pengeluaran', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                ->orderBy('tgl_kas_keluar', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('kas_keluar.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, pajak.jenis_pajak, pengeluaran.tgl_transaksi_pengeluaran as tgl_kas_keluar')
                ->join('akun', 'akun.id = kas_keluar.akun_id')
                ->join('pajak', 'pajak.id = kas_keluar.pajak_id')
                ->join('pengeluaran', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                ->where('kas_keluar.id', $kas_keluar)
                ->get()->getRowArray();
        }
    }
}
