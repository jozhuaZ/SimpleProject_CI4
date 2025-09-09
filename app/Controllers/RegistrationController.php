<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class RegistrationController extends BaseController
{
    public function index()
    {
        return view('Registration/index');
    }
    public function registerUser()
    {
        try {
            $request = service('request');
            // $session = session();

            // check if request is empty
            // Validation via CI4's built-in validation service
            $rules = [
                'firstname' => 'required|max_length[255]',
                'middlename' => 'required|max_length[255]',
                'lastname' => 'required|max_length[255]',
                'address' => 'required|max_length[255]',
                'contact_number' => 'required|min_length[11]',
                'email'     => 'required|valid_email|is_unique[user.email]',
                'username'  => 'required|is_unique[user.username]',
                'password'  => 'required|min_length[8]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
            }

            $userModel = new UserModel();

            $data = [
                'firstname' => $request->getPost('firstname'),
                'middlename' => $request->getPost('middlename'),
                'lastname' => $request->getPost('lastname'),
                'address' => $request->getPost('address'),
                'contact_number' => $request->getPost('contact_number'),
                'email' => $request->getPost('email'),
                'username' => $request->getPost('username'),
                'password' => $request->getPost('password')
            ];

            $userModel->insert($data);

            return redirect()->to('/')->with('success', 'User created successfully!');
        } catch (\Throwable $e) {
            log_message('error', 'Registration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed. Please try again later.');
        }
    }
}
