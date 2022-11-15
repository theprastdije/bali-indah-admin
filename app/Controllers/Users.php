<?php // List user di admin

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\RoleModel;

class Users extends BaseController
{
    protected $db, $userModel, $roleModel, $builder, $userRole;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->profileModel = new ProfileModel();
        $this->roleModel = new RoleModel();
        $this->builder = $this->db->table('users');
        $this->userRole = $this->db->table('auth_groups_users');
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->profileModel->getAllUsers()
        ];
        return view('admin/user-list', $data);
    }

    public function detail($user_id)
    {
        if ($this->profileModel->checkUserData($user_id) == 0) {
            $set_data_stat = 0;
        } else {
            $set_data_stat = 1;
        }

        $data = [
            'title' => 'Detail User',
            'user' => $this->profileModel->getUserDetail($user_id),
            'detail' => $set_data_stat,
            'role' => $this->roleModel->findAll()
        ];

        if (empty($data['user'])) {
            session()->setFlashdata('userNotFound', 'User tidak ditemukan');
            return redirect()->to('/users');
        }
        return view('admin/detail', $data);
    }

    public function editrole()
    {
        $user_id = $this->request->getVar('user_id');
        $role_user = $this->request->getVar('role_user');
        // dd($user_id, $role_user);
        $this->userRole->where('user_id', $user_id)->update([
            'group_id' => $role_user
        ]);
        session()->setFlashdata('roleUpdate', 'Role berhasil diubah');
        return redirect()->to('users/' . $user_id);
    }
}
