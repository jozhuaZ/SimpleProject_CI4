<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'firstname', 
        'middlename',
        'lastname',
        'address',
        'contact_number',
        'username',
        'email',
        'password'
    ];
    // protected $hidden = ['password'];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }

    public function verifyUser(string $email, string $password)
    {
        try {
            if (!isset($email) || !isset($password)) {
                return null;
            }

            $user = $this->where('email', $email)->first();
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }

            return null;
        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());
            return null;
        }
    }

    public function register(array $data): bool
    {
        try {
            return $this->insert($data) !== false;
        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function fetchUsers()
    {
        $users = $this->select( 'id,
                                firstname, 
                                middlename,
                                lastname,
                                username,
                                email,
                                address,
                                contact_number' )
                      ->findAll();
        return $users;
    }
}