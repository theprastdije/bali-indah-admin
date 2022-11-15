<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Payroll extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Payroll',
            'gaji' => $this->gajiBayarModel->getPembayaranGaji()
        ];
        return view('payroll/index', $data);
    }
}
