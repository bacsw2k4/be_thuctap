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
        $this->db->query('SELECT u.fullName,l.categoryLetter,l.createdAt, l.status,l.approvalDate,l.content FROM `user` as u,`letter` as l WHERE u.userId=l.userId LIMIT 30');
        $this->db->execute();
        $letter = $this->db->fetchall();
        if ($letter) {
            return $letter;
        }
        return [];
    }
}