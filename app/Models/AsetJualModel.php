<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetJualModel extends Model
{
    protected $table = 'penjualan_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pendapatan_id', 'akun_id', 'aset_id', 'tgl_penjualan', 'harga_jual', 'catatan'
    ];

    public function getPenjualanAset($penjualan_aset_id = false)
    {
        if ($penjualan_aset_id == false) {
            return $this->builder()
                ->select('penjualan_aset.*, pajak_jual_aset.pajak_id, aset.nama_aset')
                ->join('aset', 'aset.id = penjualan_aset.aset_id')
                ->join('pajak_jual_aset', 'pajak_jual_aset.penjualan_aset_id = penjualan_aset.id')
                ->where('aset.status_aset', 2)
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('penjualan_aset.*, pajak_jual_aset.pajak_id, pajak_jual_aset.tarif_pajak')
                ->join('pajak_jual_aset', 'pajak_jual_aset.penjualan_aset_id = penjualan_aset.id')
                ->where('penjualan_aset.id', $penjualan_aset_id)
                ->get()->getRowArray();
        }
    }
}
