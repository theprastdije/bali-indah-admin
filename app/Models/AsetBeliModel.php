<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetBeliModel extends Model
{
    protected $table = 'pembelian_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pengeluaran_id', 'akun_pembelian_id', 'jenis_pembayaran_id', 'status_transaksi'
    ];

    public function getPembelianAset($beli_aset_id = false)
    {
        if ($beli_aset_id == false) {
            return $this->builder()
                ->select('pembelian_aset.*, aset.id as aset_id, aset.nama_aset, aset.tgl_perolehan, aset.harga_perolehan')
                ->join('aset_dibeli', 'aset_dibeli.pembelian_aset_id = pembelian_aset.id')
                ->join('aset', 'aset_dibeli.aset_id = aset.id')
                ->get()->getResultArray();
        } else {
            return $this->builder()
                ->select('pembelian_aset.*, aset.id as aset_id, aset.akun_aset_id, aset.nama_aset, aset.kode_aset, aset.deskripsi_aset, aset.tgl_perolehan, aset.harga_perolehan, aset.status_aset, aset.dapat_disusutkan')
                ->join('aset_dibeli', 'aset_dibeli.pembelian_aset_id = pembelian_aset.id')
                ->join('aset', 'aset_dibeli.aset_id = aset.id')
                ->where('pembelian_aset.id', $beli_aset_id)
                ->get()->getRowArray();
        }
    }

    public function getPajakBeli($beli_aset_id = false)
    {
        $pajak_beli = $this->db->table('pajak_pembelian')
            ->select('pajak_pembelian.pajak_id, pajak_pembelian.tarif_pajak')
            ->where('pajak_pembelian.pembelian_aset_id', $beli_aset_id)
            ->get()->getRowArray();

        if (!$pajak_beli) {
            $pajak_aset = '0';
        } else {
            $pajak_aset = $pajak_beli;
        }
        return $pajak_aset;
    }
}
