<?php
require_once __DIR__ . '/../config/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($name, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$name, $email, $hash]);
    }
}
