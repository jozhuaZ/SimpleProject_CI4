<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('Login/index');
    }
    public function loginUser()
    {
        try {
            $request = request();
            $session = session();

            if (empty($request->getPost('email'))) {
                return redirect()->back()->withInput()->with('error', 'Please fill in the email field.');
            } else if (empty($request->getPost('password'))) {
                return redirect()->back()->withInput()->with('error', 'Please fill in the password field.');
            }

            $userModel = new UserModel();
            $user = $userModel->verifyUser($request->getPost('email'), $request->getPost('password'));

            if ($user) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'middlename' => $user['middlename'],
                    'lastname' => $user['lastname'],
                    'address' => $user['address'],
                    'contact_number' => $user['contact_number'],
                    'email' => $user['email'],
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);
                // $session->set([
                //     'user' => [
                //         'user_id' => $user['id'],
                //         'firstname' => $user['firstname'],
                //         'middlename' => $user['middlename'],
                //         'lastname' => $user['lastname'],
                //         'address' => $user['address'],
                //         'contact_number' => $user['contact_number'],
                //         'email' => $user['email'],
                //         'username' => $user['username'],
                //         'isLoggedIn' => true,
                //     ]
                //     ]);
                return redirect()->to(base_url('/'))->with('success', 'Welcome back ' . $sessionData['username']);
            }
            return redirect()->to(base_url('login'))->withInput()->with('error', 'No user found.');

        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());
            return redirect()->to(base_url('login'))->withInput()->with('error', 'Login Failed. Please try again later.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'You have been logged out.');
    }
}
