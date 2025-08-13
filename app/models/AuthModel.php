<?php
class AuthModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM user where username=?');
        $this->db->execute([$username]);
        $user = $this->db->fetch();
        if ($user && (password_verify($password, $user['password']))) {
            return $user;
        }
        return [];
    }
}