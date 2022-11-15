<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tgl_transaksi_pengeluaran', 'jenis_transaksi_pengeluaran', 'total_transaksi_pengeluaran', 'created_at', 'updated_at'
    ];

    public function laporanDefault()
    {
        $bln_skrg = date('m');
        $thn_skrg = date('Y');
        $jenis = 'default';
        $periode = month_indo(date('Y-m-d'));
        $harian = $this->builder()
            ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
            ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
            ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
            ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
            ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
            ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
            ->get()->getResultArray();
        $aset = $this->builder()
            ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
            ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
            ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
            ->join('aset', 'aset.id = aset_dibeli.aset_id')
            ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
            ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
            ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
            ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
            ->get()->getResultArray();
        $kas = $this->builder()
            ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
            ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
            ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
            ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
            ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
            ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
            ->get()->getResultArray();
        return ['laporan' => ['harian' => $harian, 'aset' => $aset, 'kas' => $kas], 'jenis' => $jenis, 'periode' => $periode];
    }

    public function laporanByJenis($jenis = false, $tgl_awal = false, $tgl_akhir = false)
    {
        $bln_skrg = date('m');
        $thn_skrg = date('Y');
        $esc_tgl_awal = $this->builder()->db()->escape($tgl_awal);
        $esc_tgl_akhir = $this->builder()->db()->escape($tgl_akhir);
        $where = "pengeluaran.tgl_transaksi_pengeluaran BETWEEN {$esc_tgl_awal} AND {$esc_tgl_akhir}";

        if ($jenis == 'harian') {
            $jenis = 'harian';
            // pengeluaran harian
            if ($tgl_awal == false) {
                // pengeluaran bulan ini
                $laporan = $this->builder()
                    ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                    ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                    ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
                    ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
                    ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
                    ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                    ->get()->getResultArray();
                $periode = month_indo(date('Y-m-d'));
            } else {
                if ($tgl_akhir == false) {
                    // pengeluaran hari yg dipilih
                    $laporan = $this->builder()
                        ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
                        ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_awal)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal);
                } else {
                    // pengeluaran rentang waktu tertentu
                    $laporan = $this->builder()
                        ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
                        ->where($where)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal) . ' - ' . date_indo($tgl_akhir);
                }
            }
        } elseif ($jenis == 'aset') {
            // aset
            $jenis = 'aset';
            if ($tgl_awal == false) {
                // pembelian aset per bulan
                $laporan = $this->builder()
                    ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                    ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
                    ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
                    ->join('aset', 'aset.id = aset_dibeli.aset_id')
                    ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
                    ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
                    ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
                    ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                    ->get()->getResultArray();
                $periode = month_indo(date('Y-m-d'));
            } else {
                if ($tgl_akhir == false) {
                    // pembelian aset hari yg dipilih
                    $laporan = $this->builder()
                        ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
                        ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
                        ->join('aset', 'aset.id = aset_dibeli.aset_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
                        ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_awal)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal);
                } else {
                    // pembelian aset rentang waktu tertentu
                    $laporan = $this->builder()
                        ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
                        ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
                        ->join('aset', 'aset.id = aset_dibeli.aset_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
                        ->where($where)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal) . ' - ' . date_indo($tgl_akhir);
                }
            }
        } elseif ($jenis == 'kas') {
            // kas
            $jenis = 'kas';
            if ($tgl_awal == false) {
                // pengeluaran kas per bulan
                $laporan = $this->builder()
                    ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                    ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                    ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
                    ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
                    ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
                    ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                    ->get()->getResultArray();
                $periode = month_indo(date('Y-m-d'));
            } else {
                if ($tgl_akhir == false) {
                    // pengeluaran kas hari yg dipilih
                    $laporan = $this->builder()
                        ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
                        ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_awal)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal);
                } else {
                    // pengeluaran kas rentang waktu tertentu
                    $laporan = $this->builder()
                        ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
                        ->where($where)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal) . ' - ' . date_indo($tgl_akhir);
                }
            }
        } else {
            // semua
            $jenis = 'semua';
            if ($tgl_awal == false) {
                // semua pengeluaran bulan ini
                $harian = $this->builder()
                    ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                    ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                    ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
                    ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
                    ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
                    ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                    ->get()->getResultArray();
                $aset = $this->builder()
                    ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                    ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
                    ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
                    ->join('aset', 'aset.id = aset_dibeli.aset_id')
                    ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
                    ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
                    ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
                    ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                    ->get()->getResultArray();
                $kas = $this->builder()
                    ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                    ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                    ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
                    ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
                    ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
                    ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                    ->get()->getResultArray();
                $periode = month_indo(date('Y-m-d'));
            } else {
                if ($tgl_akhir == false) {
                    // semua pengeluaran hari yg dipilih
                    $harian = $this->builder()
                        ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
                        ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_awal)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $aset = $this->builder()
                        ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
                        ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
                        ->join('aset', 'aset.id = aset_dibeli.aset_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
                        ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_awal)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $kas = $this->builder()
                        ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
                        ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_awal)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal);
                } else {
                    // semua pengeluaran rentang waktu tertentu
                    $harian = $this->builder()
                        ->select('pengeluaran_harian.rincian_pengeluaran, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pengeluaran_harian', 'pengeluaran.id = pengeluaran_harian.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'harian')
                        ->where($where)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $aset = $this->builder()
                        ->select('aset.nama_aset, aset.kode_aset, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('pembelian_aset', 'pengeluaran.id = pembelian_aset.pengeluaran_id')
                        ->join('aset_dibeli', 'pembelian_aset.id = aset_dibeli.pembelian_aset_id')
                        ->join('aset', 'aset.id = aset_dibeli.aset_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'aset')
                        ->where($where)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $kas = $this->builder()
                        ->select('kas_keluar.deskripsi, pengeluaran.total_transaksi_pengeluaran AS total_pengeluaran, pengeluaran.tgl_transaksi_pengeluaran AS tgl_transaksi')
                        ->join('kas_keluar', 'pengeluaran.id = kas_keluar.pengeluaran_id')
                        ->where('pengeluaran.jenis_transaksi_pengeluaran', 'kas')
                        ->where($where)
                        ->orderBy('pengeluaran.tgl_transaksi_pengeluaran', 'ASC')
                        ->get()->getResultArray();
                    $periode = date_indo($tgl_awal) . ' - ' . date_indo($tgl_akhir);
                }
            }
            $laporan = ['harian' => $harian, 'aset' => $aset, 'kas' => $kas];
        }
        return ['laporan' => $laporan, 'jenis' => $jenis, 'periode' => $periode];
    }

    public function totalPengeluaranBulanan()
    {
        $bln_skrg = date('m');
        $thn_skrg = date('Y');
        $bulanan = $this->builder()
            ->select('SUM(pengeluaran.total_transaksi_pengeluaran) as total_pengeluaran')
            ->where('YEAR(pengeluaran.tgl_transaksi_pengeluaran)', $thn_skrg)
            ->where('MONTH(pengeluaran.tgl_transaksi_pengeluaran)', $bln_skrg)
            ->get()->getRowArray();
        return $bulanan;
    }

    public function totalPengeluaranHarian()
    {
        $tgl_skrg = date('Y-m-d');
        $harian = $this->builder()
            ->select('SUM(pengeluaran.total_transaksi_pengeluaran) as total_pengeluaran')
            ->where('pengeluaran.tgl_transaksi_pengeluaran', $tgl_skrg)
            ->get()->getRowArray();
        return $harian;
    }
}
