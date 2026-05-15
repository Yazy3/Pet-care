<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Registration
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(string $staffName, string $username, string $password): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO staff_table (staff_name, username, password)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([$staffName, $username, $password]);
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM staff_table WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() ?: null;
    }
    public function countStaff(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM staff_table");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}