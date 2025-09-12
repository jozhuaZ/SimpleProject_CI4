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

    public function updateUser($id = null)
    {
        try {
            if ($id === null) {
                return redirect()->back()->with('error', 'No selected user id to update.');
            }
            $rules = [
                'firstname' => 'required|max_length[255]',
                'middlename' => 'required|max_length[255]',
                'lastname' => 'required|max_length[255]',
                'address' => 'required|max_length[255]',
                'contact_number' => "required|min_length[11]|is_unique[user.contact_number,id,{$id}]",
                'email'     => "required|valid_email|is_unique[user.email,id,{$id}]",
                'username'  => "required|is_unique[user.username,id,{$id}]",
            ];

            // Only validate password if provided
            if ($this->request->getPost('password')) {
                $rules['password'] = 'min_length[8]';
            }

            $messages = [
                'email' => [
                    'is_unique'   => 'Email is already registered.',
                    'valid_email' => 'Please enter a valid email address.'
                ],
                'username' => [
                    'is_unique' => 'Username is already taken.'
                ],
                'contact_number' => [
                    'is_unique' => 'Contact number is already taken.'
                ],
                'password' => [
                    'min_length' => 'Password must be at least 8 characters long.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $newUserData = $this->request->getPost([
                'firstname',
                'middlename',
                'lastname',
                'address',
                'contact_number',
                'email',
                'username',
                'password'
            ]);

            $userModel = new UserModel();
            if ($userModel->updateUserById((int)$id, $newUserData)) {
                return redirect()->to(base_url('a/user-record'))->with('success', "User ID: $id has been successfully updated.");
            }
        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update user.');
        }
    }
}