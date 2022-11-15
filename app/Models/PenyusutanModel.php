<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyusutanModel extends Model
{
    protected $table = 'penyusutan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'akun_id', 'aset_id', 'metode_penyusutan_fiskal', 'metode_penyusutan_komersial', 'persen_penyusutan_fiskal', 'persen_penyusutan_komersial', 'kelompok_aset', 'masa_manfaat'
    ];
}
