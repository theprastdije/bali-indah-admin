<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email', 'username', 'full_name', 'profile_img', 'updated_at', 'register_date'
    ];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function getAllUsers()
    {
        return $this->builder()
            ->select('users.id, users.email, users.username, users.full_name, auth_groups.name as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->get()->getResultArray();
    }

    public function checkUserData($user_id)
    {
        $checkUserDet = $this->builder()
            ->select('users_detail.*')->from('users_detail')
            ->where('user_id', $user_id)->get()->getRowArray();
        if (!$checkUserDet) {
            return 0;
        } else {
            return 1;
        }
    }

    public function getUserDetail($user_id)
    {
        $checkUserDet = $this->builder()
            ->select('users_detail.*')->from('users_detail')
            ->where('user_id', $user_id)->get()->getRowArray();
        if (!$checkUserDet) {
            return $this->builder()
                ->select('users.id, users.email, users.username, users.full_name, users.profile_img, auth_groups.id as roleid, auth_groups.name as role')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('users.id', $user_id)
                ->get()->getRowArray();
            // return 'tidak ada data';
        } else {
            return $this->builder()
                ->select('users.id, users.email, users.username, users.full_name, users.profile_img, auth_groups.id as roleid, auth_groups.name as role,
                          users_detail.gender, users_detail.alamat, users_detail.tempat_lahir, users_detail.tgl_lahir, users_detail.tel')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->join('users_detail', 'users_detail.user_id = users.id')
                ->where('users.id', $user_id)
                ->get()->getRowArray();
            // return 'ada data';
        }
    }
}
