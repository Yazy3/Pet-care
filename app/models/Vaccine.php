<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Vaccine
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
        SELECT * FROM vaccine_table 
        ORDER BY vaccine_id DESC
    ")->fetchAll() ?? [];
    }
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM vaccine_table WHERE vaccine_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function allForDropdown(): array
    {
        return $this->db->query("
            SELECT vaccine_id,
                   CONCAT(vaccine_name,' (', COALESCE(vaccine_form, ''), ')') AS label
            FROM vaccine_table ORDER BY vaccine_name ASC
        ")->fetchAll() ?? [];
    }

    // ==================== UPDATED CREATE ====================
    public function create(string $name, string $type, string $form): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO vaccine_table (vaccine_name, vaccine_type, vaccine_form) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$name, $type, $form]);
    }

    public function update(int $id, string $name, string $type, string $form): bool
    {
        $stmt = $this->db->prepare("
            UPDATE vaccine_table 
            SET vaccine_name = ?, 
                vaccine_type = ?, 
                vaccine_form = ? 
            WHERE vaccine_id = ?
        ");
        return $stmt->execute([$name, $type, $form, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM vaccine_table WHERE vaccine_id = ?");
        return $stmt->execute([$id]);
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM vaccine_table")->fetchColumn();
    }
}