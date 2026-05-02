<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Owner
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT o.*, COUNT(p.pet_id) AS pet_count
            FROM owner_table o
            LEFT JOIN pet_table p ON o.owner_id = p.owner_id
            GROUP BY o.owner_id
            ORDER BY o.owner_id ASC
        ")->fetchAll() ?? [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM owner_table WHERE owner_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function allForDropdown(): array
    {
        return $this->db->query("
            SELECT owner_id,
                   CONCAT(owner_first_name, ' ', owner_last_name) AS full_name
            FROM owner_table
            ORDER BY owner_first_name ASC
        ")->fetchAll() ?? [];
    }

    public function create(
        string $firstName,
        string $lastName,
        string $suffix,
        string $sex,
        string $contactNo
    ): int|false {

        $stmt = $this->db->prepare("
        INSERT INTO owner_table 
            (owner_first_name, owner_last_name, owner_suffix, sex, owner_contact_no)
        VALUES 
            (?, ?, ?, ?, ?)
    ");

        $success = $stmt->execute([$firstName, $lastName, $suffix, $sex, $contactNo]);

        if ($success) {
            return (int) $this->db->lastInsertId();
        }

        return false;
    }
    public function update(
        int $id,
        string $firstName,
        string $lastName,
        string $suffix,
        string $sex,
        string $contactNo
    ): bool {
        $stmt = $this->db->prepare("
            UPDATE owner_table
            SET owner_first_name=?, owner_last_name=?, owner_suffix=?,
                sex=?, owner_contact_no=?
            WHERE owner_id=?
        ");
        return $stmt->execute([$firstName, $lastName, $suffix, $sex, $contactNo, $id]);
    }

    public function delete(int $id): bool
    {
        try {

            $stmt = $this->db->prepare("DELETE FROM pet_table WHERE owner_id = ?");
            $stmt->execute([$id]);


            $stmt = $this->db->prepare("DELETE FROM owner_table WHERE owner_id = ?");
            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            echo "Delete Error: " . $e->getMessage();
            exit;
        }
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM owner_table")->fetchColumn();
    }
    public function getLastInsertId(): int
    {
        return (int) $this->db->lastInsertId();
    }

}