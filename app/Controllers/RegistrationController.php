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

            $messages = [
                'email' => [
                    'is_unique'   => 'This email is already registered.',
                    'valid_email' => 'Please enter a valid email address.'
                ],
                'username' => [
                    'is_unique' => 'This username is already taken.'
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

            $userModel = new UserModel();

            $userData = [
                'firstname' => $request->getPost('firstname'),
                'middlename' => $request->getPost('middlename'),
                'lastname' => $request->getPost('lastname'),
                'address' => $request->getPost('address'),
                'contact_number' => $request->getPost('contact_number'),
                'email' => $request->getPost('email'),
                'username' => $request->getPost('username'),
                'password' => $request->getPost('password')
            ];

            if ($userModel->register($userData)) {
                return redirect()->to(base_url('login'))->with('success', 'You have successfully registered!');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Registration failed: ' . $e->getMessage());
            return redirect()->to('login')->with('error', 'Failed to register your account. Please try again later.');
        }
    }
}
