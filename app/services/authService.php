<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

class AuthService
{
    protected $userRepository;

    public function __construct()
    {
        $userRepository = new UserRepository();
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password)
    {

        $user = $this->userRepository->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return [
                'success' => false,
                'errors' => [
                    'email' => $user ? '' : 'Email not found.',
                    'password' => $user ? 'Incorrect password.' : '',
                ],
            ];
        }

        return [
            'success' => true,
            'role' => $user['role'],
            'session' => $user
        ];
    }

    public function regist(array $data){
        return $this->userRepository->save($data);
    }

    public function forgetPassword($email, $password){
        return $this->userRepository->update($email, $password);
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
