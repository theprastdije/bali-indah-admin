<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranTunjanganModel extends Model
{
    protected $table = 'pembayaran_tunjangan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tunjangan_staf_id', 'pengeluaran_id', 'jenis_pembayaran_id', 'tgl_pembayaran', 'jumlah_pembayaran'
    ];

    public function cekTjgSekali($tjg_staf_id)
    {
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
        ')->getRowArray();
    }

    public function cekTjgThn($tjg_staf_id, $tahun)
    {
        // $tahun = date('Y');
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
            AND YEAR(pembayaran_tunjangan.tgl_pembayaran) = ' . $tahun . '
        ')->getRowArray();
    }

    public function cekTjgThnAuto($tjg_staf_id)
    {
        $tahun = date('Y');
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
            AND YEAR(pembayaran_tunjangan.tgl_pembayaran) = ' . $tahun . '
        ')->getRowArray();
    }

    public function cekTjgBulan($tjg_staf_id, $tahun, $bulan)
    {
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
            AND YEAR(pembayaran_tunjangan.tgl_pembayaran) = ' . $tahun . '
            AND MONTH(pembayaran_tunjangan.tgl_pembayaran) = ' . $bulan . '
        ')->getRowArray();
    }

    public function cekTjgBulanAuto($tjg_staf_id)
    {
        $tahun = date('Y');
        $bulan = date('m');
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
            AND YEAR(pembayaran_tunjangan.tgl_pembayaran) = ' . $tahun . '
            AND MONTH(pembayaran_tunjangan.tgl_pembayaran) = ' . $bulan . '
        ')->getRowArray();
    }

    public function cekTjgHari($tjg_staf_id, $tgl)
    {
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
            AND pembayaran_tunjangan.tgl_pembayaran = "' . $tgl . '"
        ')->getRowArray();
    }

    public function cekTjgHariAuto($tjg_staf_id)
    {
        $tgl = date('Y-m-d');
        return $this->db->query('
            SELECT COUNT(pembayaran_tunjangan.id) AS total FROM pembayaran_tunjangan
            WHERE pembayaran_tunjangan.tunjangan_staf_id = ' . $tjg_staf_id . '
            AND pembayaran_tunjangan.tgl_pembayaran = "' . $tgl . '"
        ')->getRowArray();
    }
}
