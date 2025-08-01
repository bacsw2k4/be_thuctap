<?php
class UserModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllUser()
    {
        $this->db->query('SELECT fullName,createdAt,status FROM user');
        $this->db->execute();
        $users = $this->db->fetchall();
        if ($users) {
            return $users;
        }
        return [];
    }
    public function findUserByUserName($usersname)
    {
        $this->db->query('SELECT username FROM user where username=?');
        $this->db->execute([$usersname]);
        $users = $this->db->fetch();
        if ($users) {
            return $users;
        }
        return [];
    }
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT email FROM user where email=?');
        $this->db->execute([$email]);
        $email = $this->db->fetch();
        if ($email) {
            return $email;
        }
        return [];
    }
}