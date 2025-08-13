<?php
class LetterModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllLetter($search, $limit, $offset, $department = null, $category = null)
    {
        $letters = [];
        $total = 0;

        // Điều kiện lọc phòng ban nếu không phải admin
        $deptCondition = "";
        $paramsDept = [];
        if ($category !== 'admin' && !empty($department)) {
            $deptCondition = " AND u.department = ?";
            $paramsDept[] = $department;
        }

        if ($search) {
            // SELECT thư có điều kiện tìm kiếm
            $this->db->query("
            SELECT l.letterId, u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content,l.approverId
            FROM letter l
            JOIN user u ON l.userId = u.userId
            WHERE (u.fullName LIKE ? OR l.categoryLetter LIKE ? OR l.content LIKE ?)
            $deptCondition
            LIMIT ? OFFSET ?
        ");
            $this->db->execute(array_merge(["%$search%", "%$search%", "%$search%"], $paramsDept, [$limit, $offset]));
            $letters = $this->db->fetchAll();

            // COUNT tổng số thư
            $this->db->query("
            SELECT COUNT(*) AS total
            FROM letter l
            JOIN user u ON l.userId = u.userId
            WHERE (u.fullName LIKE ? OR l.categoryLetter LIKE ? OR l.content LIKE ?)
            $deptCondition
        ");
            $this->db->execute(array_merge(["%$search%", "%$search%", "%$search%"], $paramsDept));
            $total = $this->db->fetch()['total'];
        } else {
            // SELECT thư không có tìm kiếm
            $where = "";
            if (!empty($deptCondition)) {
                $where = "WHERE 1=1 $deptCondition";
            }

            $this->db->query("
            SELECT l.letterId, u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content,l.approverId
            FROM letter l
            JOIN user u ON l.userId = u.userId
            $where
            LIMIT ? OFFSET ?
        ");
            $this->db->execute(array_merge($paramsDept, [$limit, $offset]));
            $letters = $this->db->fetchAll();

            // COUNT tổng
            $this->db->query("
            SELECT COUNT(*) AS total
            FROM letter l
            JOIN user u ON l.userId = u.userId
            $where
        ");
            $this->db->execute($paramsDept);
            $total = $this->db->fetch()['total'];
        }

        return [
            'letters' => $letters,
            'total' => $total
        ];
    }

    public function getUserByDepartment($data)
    {
        $this->db->query("SELECT * FROM user where department=? and userType IN(?,?)");
        $this->db->execute([$data, "admin", "Quản lý"]);
        return $this->db->fetchall();
    }
    public function addLetter($data)
    {
        $this->db->query("INSERT INTO letter(userId ,title,content,approverId,categoryLetter,startDate,endDate,attachment,status) VALUES (?,?,?,?,?,?,?,?,?)");
        return $this->db->execute([$data['userid'], $data['title'], $data['content'], $data['roleuser'], $data['categoryletter'], $data['startdate'], $data['enddate'], $data['file'], $data['status']]);
    }
    public function findLettertById($id)
    {
        $this->db->query("SELECT * FROM letter where letterId =?");
        $this->db->execute([$id]);
        return $this->db->fetch();
    }
    public function acceptLetter($data, $id)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query('UPDATE letter set status=?,approvalDate=? where letterId =? ');
            $approvalDate = date('Y-m-d');
            $this->db->execute([$data['status'], $approvalDate, $id]);
            $this->db->commit();
            return true;
        } catch (PDO $err) {
            $this->db->rollBack();
            echo "Error";
            return false;
        }
    }
    public function cancelLetter($data, $id)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query('UPDATE letter set status=?,approvalDate=? where letterId =? ');
            $approvalDate = date('Y-m-d');
            $this->db->execute([$data['status'], $approvalDate, $id]);
            $this->db->commit();
            return true;
        } catch (PDO $err) {
            $this->db->rollBack();
            echo "Error";
            return false;
        }
    }
}