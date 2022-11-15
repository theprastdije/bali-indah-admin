<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $check = $this->profileModel->checkUserData(user()->id);
        $data = [
            'title' => 'Dashboard',
            'check' => $check,
            'pengeluaran_bulanan' => $this->pengeluaranModel->totalPengeluaranBulanan()['total_pengeluaran'],
            'pengeluaran_harian' => $this->pengeluaranModel->totalPengeluaranHarian()['total_pengeluaran'],
            'pendapatan_bulanan' => $this->pendapatanModel->totalPendapatanBulanan()['total_pendapatan'],
            'pendapatan_harian' => $this->pendapatanModel->totalPendapatanHarian()['total_pendapatan'],
        ];
        return view('dashboard/index', $data);
    }
}
