<?php
namespace App\Config;

use PDO;
use PDOException;

class Database 
{
    private string $host = "localhost";
    private string $db   = "nexus_db";
    private string $user = "root";
    private string $pass = "";
    private ?PDO $conn = null;

    public function connect(): PDO
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db}",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }

        return $this->conn;
    }
}
