<?php
class UserModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllUser($search, $limit, $offset)
    {
        if ($search && is_numeric($search)) {
            $this->db->query("SELECT * FROM user WHERE userId = ? LIMIT ? OFFSET ?");
            $this->db->execute([$search, $limit, $offset]);
            $users = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total FROM user WHERE userId = ?");
            $this->db->execute([$search]);
            $total = $this->db->fetch()['total'];
        } elseif ($search) {
            $this->db->query("SELECT * FROM user WHERE fullName LIKE ? LIMIT ? OFFSET ?");
            $this->db->execute(["%$search%", $limit, $offset]);
            $users = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total FROM user WHERE fullName LIKE ?");
            $this->db->execute(["%$search%"]);
            $total = $this->db->fetch()['total'];
        } else {
            $this->db->query("SELECT * FROM user LIMIT ? OFFSET ?");
            $this->db->execute([$limit, $offset]);
            $users = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total FROM user");
            $this->db->execute();
            $total = $this->db->fetch()['total'];
        }
        return [
            'users' => $users,
            'total' => $total
        ];
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
        $this->db->query('DELETE FROM letter WHERE userId = ?');
        $this->db->execute([$id]);
        $this->db->query('DELETE FROM user where userId =?');
        return $this->db->execute([$id]);
    }
    public function findUserById($id)
    {
        $this->db->query('SELECT * FROM user where userId=?');
        $this->db->execute([$id]);
        $users = $this->db->fetch();
        return $users;
    }
    public function updateUser($id, $data)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query('UPDATE user set username=?,fullName=?,password=?,email=?,dob=?,userType=?,department=?,status=? where userId=? ');
            $this->db->execute([$data['username'], $data['fullname'], $data['password'], $data['email'], $data['birthdate'], $data['categoryuser'], $data['department'], $data['status'], $id]);
            $this->db->commit();
            return true;
        } catch (PDO $err) {
            $this->db->rollBack();
            echo "Error";
            return false;
        }
    }
    public function deleteMultipleUsers($ids)
    {
        if (empty($ids)) return false;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $this->db->query("DELETE FROM letter WHERE userId IN ($placeholders)");
        $this->db->execute($ids);
        $this->db->query("DELETE FROM user WHERE userId IN ($placeholders)");
        $this->db->execute($ids);
        return $this->db->rowcount() > 0;
    }
}