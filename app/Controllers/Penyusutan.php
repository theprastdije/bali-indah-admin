<?php

namespace App\Controllers;

class Penyusutan extends BaseController
{
    protected $validation;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Penyusutan Aset',
            'validation' => $this->validation
        ];
        return view('aset/penyusutan', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Penyusutan Aset',
            'validation' => $this->validation
        ];
        return view('aset/penyusutanadd', $data);
    }

    public function detail()
    {
        $data = [
            'title' => 'Penyusutan Aset'
        ];
        return view('aset/penyusutandet', $data);
    }
}
