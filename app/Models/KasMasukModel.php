<?php

namespace App\Models;

use CodeIgniter\Model;

class KasMasukModel extends Model
{
    protected $table = 'kas_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pendapatan_id', 'akun_id', 'pajak_id', 'deskripsi', 'jumlah'
    ];

    public function getKasMasuk($kas_masuk = false)
    {
        if ($kas_masuk == false) {
            return $this->builder()
                ->select('kas_masuk.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, pendapatan.tgl_transaksi_pendapatan as tgl_kas_masuk')
                ->join('akun', 'akun.id = kas_masuk.akun_id')
                ->join('pendapatan', 'pendapatan.id = kas_masuk.pendapatan_id')
                ->orderBy('tgl_kas_masuk', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('kas_masuk.*, akun.nama_akun, akun.kode_akun, akun.kategori_akun_id as kategori_akun, pajak.jenis_pajak, pendapatan.tgl_transaksi_pendapatan as tgl_kas_masuk')
                ->join('akun', 'akun.id = kas_masuk.akun_id')
                ->join('pajak', 'pajak.id = kas_masuk.pajak_id')
                ->join('pendapatan', 'pendapatan.id = kas_masuk.pendapatan_id')
                ->where('kas_masuk.id', $kas_masuk)
                ->get()->getRowArray();
        }
    }
}
