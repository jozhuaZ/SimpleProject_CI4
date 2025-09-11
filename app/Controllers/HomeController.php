<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $session = session();

        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        $data['user'] = [
            'id'             => $session->get('user_id'),
            'firstname'      => $session->get('firstname'),
            'middlename'     => $session->get('middlename'),
            'lastname'       => $session->get('lastname'),
            'address'        => $session->get('address'),
            'contact_number' => $session->get('contact_number'),
            'email'          => $session->get('email'),
            'username'       => $session->get('username'),
        ];
        
        return view('Home/index', $data);
    }
}
