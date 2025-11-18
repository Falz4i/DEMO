<?php
namespace App\Models;

use App\Core\BaseModel;
use PDO;

class GameModel extends BaseModel
{
    protected string $table = "games";

    /* ==== COMPATIBLE WITH BASEMODEL ==== */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /* ==== EXTRA METHODS ==== */

    /** Ambil semua genre unik */
    public function getGenres(): array
    {
        $stmt = $this->db->query("SELECT DISTINCT genre FROM {$this->table} ORDER BY genre ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /** Tambah game baru */
    public function create(string $name, string $genre): bool
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, genre) VALUES (:name, :genre)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":genre", $genre);
        return $stmt->execute();
    }
}
