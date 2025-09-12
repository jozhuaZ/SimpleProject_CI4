<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        // return view('Admin/Dashboard/index');
    }

    public function userRecord()
    {
        try {
            $userModel = new UserModel();
            $users = $userModel->fetchUsers();

            $data['users'] = $users;
        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());
            $data['users'] = [];
        }

        return view('Admin/User/userRecord', $data);
    }

    public function deleteUser($id = null)
    {
        try {
            if ($id === null) {
                return redirect()->back()->with('error', 'No selected user id to delete.');
            }

            $userModel = new UserModel();
            if ($userModel->deleteUserById((int)$id)) {
                return redirect()->back()->with('success', "User ID: $id is successfully deleted.");
            }
        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}