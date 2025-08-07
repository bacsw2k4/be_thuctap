<?php
class LetterModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllLetter($search, $limit, $offset)
    {
        if ($search) {
            $this->db->query("SELECT u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content
            FROM letter l
            JOIN user u ON l.userId = u.userId
            WHERE u.fullName LIKE ? or l.categoryLetter LIKE ? or l.content LIKE ?
            LIMIT ? OFFSET ?");
            $this->db->execute(["%$search%", "%$search%", "%$search%", $limit, $offset]);
            $letters = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total
            FROM letter l
            JOIN user u ON l.userId = u.userId
            WHERE u.fullName LIKE ? or l.categoryLetter LIKE ? or l.content LIKE ?");
            $this->db->execute(["%$search%", "%$search%", "%$search%"]);
            $total = $this->db->fetch()['total'];
        } else {
            $this->db->query("SELECT u.fullName, l.categoryLetter, l.createdAt, l.status, l.approvalDate, l.content
            FROM letter l
            JOIN user u ON l.userId = u.userId
            LIMIT ? OFFSET ?");
            $this->db->execute([$limit, $offset]);
            $letters = $this->db->fetchAll();

            $this->db->query("SELECT COUNT(*) AS total
            FROM letter l
            JOIN user u ON l.userId = u.userId");
            $this->db->execute();
            $total = $this->db->fetch()['total'];
        }
        return [
            'letters' => $letters,
            'total' => $total
        ];
    }
}
