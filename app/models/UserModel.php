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
        $this->db->query('SELECT userId,fullName,createdAt,status FROM user');
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
    public function addUser($data)
    {
        $this->db->query('INSERT INTO user(username ,fullName,password,email ,dob,userType,department,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        return $this->db->execute([
            $data['username'],
            $data['fullname'],
            $data['password'],
            $data['email'],
            $data['birthdate'],
            $data['categoryuser'],
            $data['department'],
            $data['status']
        ]);
    }
    public function deleteById($id)
    {
        $this->db->query('DELETE FROM user where userId =?');
        return $this->db->execute([$id]);
    }
    public function findByIdOrName($data)
    {
        if (is_numeric($data)) {
            $this->db->query("SELECT * FROM user where userId=?");
            $this->db->execute([$data]);
        } else {
            $this->db->query('SELECT * FROM user where fullName LIKE ?');
            $this->db->execute(["%$data%"]);
        }
        return $this->db->fetchall();
    }
}