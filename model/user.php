<?php

require_once './config/database.php';

class User extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getUser($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM participant WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the each row
        return $result ?: null;
    }
    public function getUserAdmin($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the each row
        return $result ?: null;
    }
}