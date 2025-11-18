<?php
namespace App\Core;

use PDO;

abstract class BaseModel
{
    protected PDO $db;
    protected string $table;

    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table}");
        $query->execute();
        return $query->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }

    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $query->execute([$id]);
    }
}
