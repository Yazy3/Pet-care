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

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM owner_table WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByContact(string $contactNo): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM owner_table WHERE owner_contact_no = ?");
        $stmt->execute([$contactNo]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
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

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM owner_table")->fetchColumn();
    }

    // ✅ Needed when adding owner + pet
    public function getLastInsertId(): int
    {
        return (int) $this->db->lastInsertId();
    }

    public function create(
        string $firstName,
        string $lastName,
        string $suffix,
        string $sex,
        string $contactNo,
        ?string $username = null,
        ?string $password = null
    ): int|false {

        $stmt = $this->db->prepare("
            INSERT INTO owner_table 
            (owner_first_name, owner_last_name, owner_suffix, sex, owner_contact_no, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $success = $stmt->execute([$firstName, $lastName, $suffix, $sex, $contactNo, $username, $password]);

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
        string $contactNo,
        ?string $username = null,
        ?string $password = null
    ): bool {
        $sql = "UPDATE owner_table 
                SET owner_first_name=?, owner_last_name=?, owner_suffix=?, 
                    sex=?, owner_contact_no=?";
        $params = [$firstName, $lastName, $suffix, $sex, $contactNo];

        if ($username !== null) {
            $sql .= ", username = ?";
            $params[] = $username;
        }
        if ($password !== null) {
            $sql .= ", password = ?";
            $params[] = $password;
        }

        $sql .= " WHERE owner_id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
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
}