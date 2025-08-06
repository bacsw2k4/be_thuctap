<?php
require_once '../app/config/database.php';
class Database
{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die('Database connection error: ' . $e->getMessage());
        }
    }

    public function query($sql)
    {
        try {
            $this->stmt = $this->conn->prepare($sql);
            if (!$this->stmt) {
                throw new Exception("Prepare failed: " . implode(", ", $this->conn->errorInfo()));
            }
        } catch (Exception $e) {
            die("Lỗi prepare: " . $e->getMessage());
        }
    }


    public function execute($params = [])
    {
        try {
            return $this->stmt->execute($params);
        } catch (PDOException $e) {
            die('Lỗi khi thực thi câu lệnh SQL: ' . $e->getMessage());
        }
    }


    public function fetchall()
    {

        if ($this->stmt) {
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function fetch()
    {

        if ($this->stmt) {
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function rowcount()
    {
        return $this->stmt->rowCount();
    }
    public function beginTransaction()
    {
        $this->conn->beginTransaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollBack()
    {
        $this->conn->rollBack();
    }
}
