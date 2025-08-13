<?php
class UserModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllUser($search, $limit, $offset, $department, $category)
    {
        $users = [];
        $total = 0;

        // Xác định điều kiện lọc phòng ban
        $deptCondition = "";
        $params = [];
        if ($category !== 'admin' && !empty($department)) {
            $deptCondition = " AND department = ?";
            $params[] = $department;
        }

        if ($search && is_numeric($search)) {
            // Tìm theo ID
            $this->db->query("SELECT * FROM user WHERE userId = ? $deptCondition LIMIT ? OFFSET ?");
            $this->db->execute(array_merge([$search], $params, [$limit, $offset]));
            $users = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total FROM user WHERE userId = ? $deptCondition");
            $this->db->execute(array_merge([$search], $params));
            $total = $this->db->fetch()['total'];
        } elseif ($search) {
            // Tìm theo tên
            $this->db->query("SELECT * FROM user WHERE fullName LIKE ? $deptCondition LIMIT ? OFFSET ?");
            $this->db->execute(array_merge(["%$search%"], $params, [$limit, $offset]));
            $users = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total FROM user WHERE fullName LIKE ? $deptCondition");
            $this->db->execute(array_merge(["%$search%"], $params));
            $total = $this->db->fetch()['total'];
        } else {
            // Không tìm kiếm
            $condition = "";
            if (!empty($deptCondition)) {
                $condition = "WHERE 1=1 $deptCondition";
            }

            $this->db->query("SELECT * FROM user $condition LIMIT ? OFFSET ?");
            $this->db->execute(array_merge($params, [$limit, $offset]));
            $users = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total FROM user $condition");
            $this->db->execute($params);
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
        try {
            $this->db->beginTransaction();
            $this->db->query('INSERT INTO user(username ,fullName,password,email ,dob,userType,department,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $this->db->execute([
                $data['username'],
                $data['fullname'],
                $data['password'],
                $data['email'],
                $data['birthdate'],
                $data['categoryuser'],
                $data['department'],
                $data['status']
            ]);
            $this->db->commit();
            return true;
        } catch (PDO $err) {
            $this->db->rollBack();
            echo "Error";
            return false;
        }
    }
    public function deleteById($id)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query('DELETE FROM letter WHERE userId = ?');
            $this->db->execute([$id]);
            $this->db->query('DELETE FROM user where userId =?');
            $this->db->execute([$id]);
            $this->db->commit();
            return true;
        } catch (PDO $err) {
            $this->db->rollBack();
            echo "Error";
            return false;
        }
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
        try {
            $this->db->beginTransaction();
            $this->db->query("DELETE FROM letter WHERE userId IN ($placeholders)");
            $this->db->execute($ids);
            $this->db->query("DELETE FROM user WHERE userId IN ($placeholders)");
            $this->db->execute($ids);
            $this->db->rowcount() > 0;
            $this->db->commit();
            return true;
        } catch (PDO $err) {
            $this->db->rollBack();
            echo "Error";
            return false;
        }
    }
}