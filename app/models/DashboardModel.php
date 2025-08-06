<?php

class DashboardModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getLetter()
    {
        $this->db->query('SELECT u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content FROM `user` AS u JOIN `letter` AS l ON u.userId = l.userId ORDER BY l.createdAt DESC LIMIT 30');
        $this->db->execute();
        $letter = $this->db->fetchall();
        if ($letter) {
            return $letter;
        }
        return [];
    }
}