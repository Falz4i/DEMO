<?php
namespace App\Models;

use App\Core\BaseModel;

class PricingModel extends BaseModel
{
    protected string $table = "pricing";

    public function create(string $packageName, int $price): bool
    {
        $query = $this->db->prepare(
            "INSERT INTO {$this->table} (package_name, price) VALUES (?, ?)"
        );
        return $query->execute([$packageName, $price]);
    }

    public function update(int $id, string $packageName, int $price): bool
    {
        $query = $this->db->prepare(
            "UPDATE {$this->table} SET package_name = ?, price = ? WHERE id = ?"
        );
        return $query->execute([$packageName, $price, $id]);
    }
}
