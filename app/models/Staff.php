<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Staff
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT staff_id, staff_name, username, created_at 
            FROM staff_table 
            ORDER BY staff_id ASC
        ")->fetchAll() ?? [];
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM staff_table WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT staff_id, staff_name, username, role, created_at 
            FROM staff_table 
            WHERE staff_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(string $staffName, string $username, string $password): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO staff_table (staff_name, username, password) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$staffName, $username, $password]);
    }

    public function update(int $id, string $staffName, string $username): bool
    {
        $stmt = $this->db->prepare("
            UPDATE staff_table 
            SET staff_name = ?, username = ? 
            WHERE staff_id = ?
        ");
        return $stmt->execute([$staffName, $username, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM staff_table WHERE staff_id = ?");
        return $stmt->execute([$id]);
    }

    // ✅ MISSING METHOD - Added for RecordsController
    public function allForDropdown(): array
    {
        return $this->db->query("
            SELECT 
                staff_id,
                staff_name 
            FROM staff_table 
            ORDER BY staff_name ASC
        ")->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
}