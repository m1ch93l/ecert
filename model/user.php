<?php

require_once __DIR__ . '/../config/database.php';

class User extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getUsers($id, $table, $column)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $column = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the each row
        return $result ?: null;
    }

    public function getUser($id)
    {
        return $this->getUsers($id, 'participant', 'participant_id');
    }

    public function getUserAdmin($id)
    {
        return $this->getUsers($id, 'admin', 'username');
    }
}