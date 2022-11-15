<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsetModel;
use App\Models\PengeluaranModel;
use App\Models\PenjualanDetModel;
use App\Models\PenjualanModel;

class Laporan extends BaseController
{
    protected $db, $asetModel, $penjualanModel, $penjualanDetModel, $pengeluaranModel, $dateNow;

    public function __construct()
    {
        $this->penjualanDetModel = new PenjualanDetModel();
        $this->penjualanModel = new PenjualanModel();
        $this->pengeluaranModel = new PengeluaranModel();
        $this->asetModel = new AsetModel();
        $this->db = db_connect();
        $this->dateNow = date('Y-m-d');
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan'
        ];
        return view('laporan/index', $data);
    }

    public function generate()
    {
        $kategori = $this->request->getVar('jenis_laporan');
        if ($kategori == "penjualan") {
            $tgl_awal = $this->request->getVar('tanggal_awal');
            $tgl_akhir = $this->request->getVar('tanggal_akhir');
            // dd($kategori, $tgl_awal, $tgl_akhir);
        } elseif ($kategori == "labarugi") {
            $tahun = $this->request->getVar('tahun');
            // dd($tahun);
        } elseif ($kategori == "aruskas") {
            $tahun = $this->request->getVar('tahun');
            // dd($tahun);
        } elseif ($kategori == "neraca") {
            $tahun = $this->request->getVar('tahun');
            // dd($tahun);
        } elseif ($kategori == "penyusutan") {
            $tahun = $this->request->getVar('tahun');
            // dd($tahun);
        } elseif ($kategori == "pajak") {
            $tahun = $this->request->getVar('tahun');
            // dd($tahun);
        } else {
            return redirect()->back();
        }
        // dd($kategori);
    }

    public function labarugi()
    {
        // $tahun = $this->request->getVar('tahun');
        // if (!$this->request->getRequest('post')) {
        //     // 
        // } else {
        $tahun = 2021;
        $penjualan = $this->penjualanModel->countPenjualanBy($tahun);
        $total_penjualan = number_format(floatval($penjualan['SUM(total_harga)']), 2, ',', '.');
        $pengeluaran = $this->pengeluaranModel->sumTotalPengeluaranGroupBy($tahun);
        $total_pengeluaran = $this->pengeluaranModel->sumTotalPengeluaran($tahun);

        $data = [
            'title' => 'Laporan Laba Rugi',
            'penjualan' => $total_penjualan,
            'pengeluaran' => $pengeluaran,
            'total_pengeluaran' => $total_pengeluaran['total']
        ];
        return view('laporan/laba-rugi', $data);
        // }
    }

    public function penyusutan()
    {
        if ($this->request->getVar('tahun')) {
            $tahun = $this->request->getVar('tahun');
        } else {
            $tahun = date('Y');
        }
        if ($this->asetModel->penyusutanAsetnb1()) {
            $aset_nb1 = $this->asetModel->penyusutanAsetnb1();
        } else {
            $aset_nb1 = null;
        }
        if ($this->asetModel->penyusutanAsetnb2()) {
            $aset_nb2 = $this->asetModel->penyusutanAsetnb2();
        } else {
            $aset_nb2 = null;
        }
        if ($this->asetModel->penyusutanAsetnb3()) {
            $aset_nb3 = $this->asetModel->penyusutanAsetnb3();
        } else {
            $aset_nb3 = null;
        }
        if ($this->asetModel->penyusutanAsetnb4()) {
            $aset_nb4 = $this->asetModel->penyusutanAsetnb4();
        } else {
            $aset_nb4 = null;
        }
        if ($this->asetModel->penyusutanAsetbp()) {
            $aset_bp = $this->asetModel->penyusutanAsetbp();
        } else {
            $aset_bp = null;
        }
        if ($this->asetModel->penyusutanAsetbtp()) {
            $aset_btp = $this->asetModel->penyusutanAsetbtp();
        } else {
            $aset_btp = null;
        }

        // dd($aset_bp, $aset_btp, $aset_nb1, $aset_nb2, $aset_nb3, $aset_nb4, $tahun);

        $data = [
            'title' => 'Laporan Penyusutan',
            'tahun' => $tahun,
            'aset_nb1' => $aset_nb1,
            'aset_nb2' => $aset_nb2,
            'aset_nb3' => $aset_nb3,
            'aset_nb4' => $aset_nb4,
            'aset_bp' => $aset_bp,
            'aset_btp' => $aset_btp,
        ];
        return view('laporan/penyusutan', $data);
    }

    public function aruskas()
    {
        $data = [
            'title' => 'Laporan Arus Kas'
        ];
        return view('laporan/aruskas', $data);
    }

    public function penjualan()
    {
        // dd($this->getpenjualan());
        $data = [
            'penjualan' => $this->getpenjualan(),
            'title' => 'Laporan Penjualan'
        ];
        return view('laporan/penjualan', $data);
    }

    public function neraca()
    {
        $data = [
            'title' => 'Neraca'
        ];
        return view('laporan/neraca', $data);
    }

    public function getpenjualan()
    {
        $periode = $this->request->getVar('periode_penjualan');

        if ($periode == "d") {
            $tgl = $this->request->getVar('tanggal');
            $data = $this->penjualanDetModel->getPenjualanData($periode, $tgl);
            // dd($data);
            return array('periode' => $periode, 'tgl' => $tgl, 'data' => $data);
        } elseif ($periode == "m") {
            $bulan = $this->request->getVar('bulan');
            $tahun = $this->request->getVar('tahun');
            $data = $this->penjualanDetModel->getPenjualanData($periode, false, false, false, $bulan, $tahun);
            // dd($data);
            return array('periode' => $periode, 'bulan' => $bulan, 'tahun' => $tahun, 'data' => $data);
        } elseif ($periode == "y") {
            $tahun = $this->request->getVar('tahun');
            $data = $this->penjualanDetModel->getPenjualanData($periode, false, false, false, false, $tahun);
            // dd($data);
            return array('periode' => $periode, 'tahun' => $tahun, 'data' => $data);
        } elseif ($periode == "p") {
            $tgl_awal = $this->request->getVar('tanggal_awal');
            $tgl_akhir = $this->request->getVar('tanggal_akhir');
            $data = $this->penjualanDetModel->getPenjualanData($periode, false, $tgl_awal, $tgl_akhir);
            // dd($data);
            return array('periode' => $periode, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir, 'data' => $data);
        } else {
            $tgl = $this->dateNow;
            $data = $this->penjualanDetModel->getPenjualanData(false, $tgl);
            // dd($data);
            return array('tgl' => $tgl, 'data' => $data, 'periode' => null);
        }
    }
}
