<?php

class DashboardModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getLetter($categoryuser, $department)
    {
        if ($categoryuser === 'admin') {
            // Admin → xem tất cả
            $this->db->query("
            SELECT u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content
            FROM `user` AS u
            JOIN `letter` AS l ON u.userId = l.userId
            ORDER BY l.createdAt DESC
            LIMIT 30
        ");
            $this->db->execute();
        } else {
            // User thường → chỉ xem cùng phòng ban
            $this->db->query("
            SELECT u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content
            FROM `user` AS u
            JOIN `letter` AS l ON u.userId = l.userId
            WHERE u.department = ?
            ORDER BY l.createdAt DESC
            LIMIT 30
        ");
            $this->db->execute([$department]);
        }

        $letter = $this->db->fetchAll();
        return $letter ?: [];
    }
}