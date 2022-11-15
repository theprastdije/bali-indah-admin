<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'auth_groups';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'description'
    ];

    public function getRole($role_id = false)
    {
        if ($role_id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $role_id])->first();
    }
}
