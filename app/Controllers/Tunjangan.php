<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tunjangan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tunjangan',
            'tunjangan' => $this->jenisTunjanganModel->getJenisTjg(),
            'staf' => $this->tunjanganModel->getUser(),
            'validation' => $this->validation
        ];
        return view('payroll/tunjangan/index', $data);
    }

    // public function add()
    // {
    //     $data = [
    //         'title' => 'Tunjangan',
    //         'staf' => $this->tunjanganModel->getUser(),
    //         'validation' => $this->validation
    //     ];
    //     return view('payroll/tunjangan/add', $data);
    // }

    // public function edit()
    // {
    //     $data = [
    //         'title' => 'Tunjangan',
    //         'validation' => $this->validation
    //     ];
    //     return view('payroll/tunjangan/edit', $data);
    // }

    public function detail($jenis_tunjangan_id)
    {
        $tjg = $this->jenisTunjanganModel->getJenisTjg($jenis_tunjangan_id);
        $nama_tunjangan = $tjg['jenis_tunjangan'];

        $data = [
            'title' => 'Tunjangan ' . $nama_tunjangan,
            'tunjangan' => $tjg,
            'tunjangan_staf' => $this->tunjanganModel->getTunjanganStaf($jenis_tunjangan_id),
            'staf' => $this->tunjanganModel->getUser(),
            'pembayaran' => $this->jenisPembayaranModel->getJenisPembayaran(),
            'validation' => $this->validation
        ];
        return view('payroll/tunjangan/detail', $data);
    }

    public function insert()
    {
        $user_id = $this->request->getVar('nama_staf');
        $jenis_tunjangan_id = $this->request->getVar('tunjangan_id');
        $data = [
            'user_id' => $user_id,
            'jenis_tunjangan_id' => $jenis_tunjangan_id,
            'created_at' => $this->datetimeNow,
            'updated_at' => $this->datetimeNow
        ];
        // dd($data);

        $cek_tjg = $this->tunjanganModel
            ->select('tunjangan_staf.user_id')
            ->where('tunjangan_staf.user_id', $user_id)
            ->where('tunjangan_staf.jenis_tunjangan_id', $jenis_tunjangan_id)
            ->get()->getRowArray();
        // dd($user_id, $jenis_tunjangan_id, $cek_tjg);

        if (!$cek_tjg) {
            $this->tunjanganModel->insert($data);
            session()->setFlashdata('tunjangan', 'Berhasil menambahkan penerima tunjangan');
            return redirect()->to('/tunjangan/detail/' . $jenis_tunjangan_id);
        } else {
            session()->setFlashdata('error_tjg', 'Penerima tunjangan sudah terdaftar');
            return redirect()->to('/tunjangan/detail/' . $jenis_tunjangan_id);
        }
    }

    public function delete()
    {
        $id = $this->request->getVar('tunjangan_staf_id');
        $tunjangan_id = $this->request->getVar('tunjangan_id');
        // dd($id, $tunjangan_id);
        $this->tunjanganModel->where('id', $id)->delete();
        session()->setFlashdata('tunjangan', 'Berhasil menghapus penerima tunjangan');
        return redirect()->to('/tunjangan/detail/' . $tunjangan_id);
    }

    /** 
     * 
     * Jenis Tunjangan
     * 
     */

    public function jenis()
    {
        $data = [
            'title' => 'Jenis Tunjangan',
            'jenis_tunjangan' => $this->jenisTunjanganModel->getJenisTjg(),
            'validation' => $this->validation
        ];
        return view('payroll/jenis_tunjangan/index', $data);
    }

    public function addjenis()
    {
        $data = [
            'title' => 'Jenis Tunjangan',
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('payroll/jenis_tunjangan/add', $data);
    }

    public function editjenis($jenis_tunjangan_id)
    {
        $data = [
            'title' => 'Jenis Tunjangan',
            'jenis_tunjangan' => $this->jenisTunjanganModel->getJenisTjg($jenis_tunjangan_id),
            'akun' => $this->akunModel->getAkun(),
            'validation' => $this->validation
        ];
        return view('payroll/jenis_tunjangan/edit', $data);
    }

    public function detailjenis($jenis_tunjangan_id)
    {
        $data = [
            'title' => 'Jenis Tunjangan',
            'jenis_tunjangan' => $this->jenisTunjanganModel->getJenisTjg($jenis_tunjangan_id)
        ];
        return view('payroll/jenis_tunjangan/detail', $data);
    }

    function deactivate()
    {
        $jenis_tunjangan_id = $this->request->getVar('jenis_tunjangan_id');
        $data = [
            'status_tunjangan' => 0,
            'updated_at' => $this->datetimeNow
        ];
        $this->jenisTunjanganModel->update($jenis_tunjangan_id, $data);
        session()->setFlashdata('jenis_tunjangan', 'Jenis tunjangan berhasil dinonaktifkan');
        return redirect()->to('/tunjangan/jenis');
    }

    function activate()
    {
        $jenis_tunjangan_id = $this->request->getVar('jenis_tunjangan_id');
        $data = [
            'status_tunjangan' => 1,
            'updated_at' => $this->datetimeNow
        ];
        $this->jenisTunjanganModel->update($jenis_tunjangan_id, $data);
        session()->setFlashdata('jenis_tunjangan', 'Jenis tunjangan berhasil diaktifkan');
        return redirect()->to('/tunjangan/jenis');
    }

    public function insertjenis()
    {
        if (!$this->validate([
            'jenis_tunjangan' => [
                'rules' => 'required|is_unique[jenis_tunjangan.jenis_tunjangan]',
                'errors' => [
                    'required' => 'Jenis tunjangan tidak boleh kosong',
                    'is_unique' => 'Jenis tunjangan sudah digunakan, silakan pakai nama lain'
                ]
            ],
            'kode_akun_tunjangan' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jumlah_tunjangan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah tunjangan tidak boleh kosong',
                    'numeric' => 'Jumlah tunjangan harus berupa angka'
                ]
            ],
            'periode_tunjangan' => [
                'rules' => 'required|in_list[sekali,harian,bulanan,tahunan]',
                'errors' => [
                    'required' => 'Periode pembayaran tunjangan tidak boleh kosong',
                    'in_list' => 'Periode pembayaran tunjangan tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/tunjangan/addjenis')->withInput();
        } else {
            $data = [
                'jenis_tunjangan' => $this->request->getVar('jenis_tunjangan'),
                'akun_tunjangan_id' => $this->request->getVar('kode_akun_tunjangan'),
                'jumlah_tunjangan' => $this->request->getVar('jumlah_tunjangan'),
                'periode_tunjangan' => $this->request->getVar('periode_tunjangan'),
                'status_tunjangan' => 1,
                'created_at' => $this->datetimeNow,
                'updated_at' => $this->datetimeNow
            ];
            $this->jenisTunjanganModel->insert($data);
            session()->setFlashdata('jenis_tunjangan', 'Jenis tunjangan berhasil ditambahkan');
            return redirect()->to('/tunjangan/jenis');
        }
    }

    public function updatejenis()
    {
        $jenis_tunjangan_id = $this->request->getVar('jenis_tunjangan_id');
        if (!$this->validate([
            'jenis_tunjangan' => [
                'rules' => 'required|is_unique[jenis_tunjangan.jenis_tunjangan,jenis_tunjangan.id,' . $jenis_tunjangan_id . ']',
                'errors' => [
                    'required' => 'Jenis tunjangan tidak boleh kosong',
                    'is_unique' => 'Jenis tunjangan sudah digunakan, silakan pakai nama lain'
                ]
            ],
            'kode_akun_tunjangan' => [
                'rules' => 'is_not_unique[akun.id]',
                'errors' => [
                    'is_not_unique' => 'Kode akun tidak boleh kosong'
                ]
            ],
            'jumlah_tunjangan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah tunjangan tidak boleh kosong',
                    'numeric' => 'Jumlah tunjangan harus berupa angka'
                ]
            ],
            'periode_tunjangan' => [
                'rules' => 'required|in_list[sekali,harian,bulanan,tahunan]',
                'errors' => [
                    'required' => 'Periode pembayaran tunjangan tidak boleh kosong',
                    'in_list' => 'Periode pembayaran tunjangan tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('/tunjangan/editjenis/' . $jenis_tunjangan_id)->withInput();
        } else {
            $data = [
                'jenis_tunjangan' => $this->request->getVar('jenis_tunjangan'),
                'akun_tunjangan_id' => $this->request->getVar('kode_akun_tunjangan'),
                'jumlah_tunjangan' => $this->request->getVar('jumlah_tunjangan'),
                'periode_tunjangan' => $this->request->getVar('periode_tunjangan'),
                'updated_at' => $this->datetimeNow
            ];
            $this->jenisTunjanganModel->update($jenis_tunjangan_id, $data);
            session()->setFlashdata('jenis_tunjangan', 'Jenis tunjangan berhasil diubah');
            return redirect()->to('/tunjangan/jenis');
        }
    }

    public function deletejenis()
    {
        $jenis_tunjangan_id = $this->request->getVar('jenis_tunjangan_id');
        $this->jenisTunjanganModel->where('id', $jenis_tunjangan_id)->delete();
        session()->setFlashdata('jenis_tunjangan', 'Jenis tunjangan berhasil dihapus');
        return redirect()->to('/tunjangan/jenis');
    }
}
