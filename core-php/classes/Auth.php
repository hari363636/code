<?php
require_once 'User.php';

class Auth
{
    private $user;

    public function __construct()
    {
        session_start();
        $this->user = new User();
    }

    public function register($name, $email, $password)
    {
        if ($this->user->findByEmail($email)) {
            throw new Exception("Email already exists");
        }
        return $this->user->create($name, $email, $password);
    }

    public function login($email, $password)
    {
        $user = $this->user->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception("Invalid credentials");
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        return true;
    }

    public function logout()
    {
        session_destroy();
    }

    public function check()
    {
        return isset($_SESSION['user_id']);
    }
}
