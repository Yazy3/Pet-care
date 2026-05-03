<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Pet
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT p.*,
                   CONCAT(o.owner_first_name, ' ', o.owner_last_name) AS owner_name,
                   o.owner_contact_no
            FROM pet_table p
            LEFT JOIN owner_table o ON p.owner_id = o.owner_id
            ORDER BY p.pet_id DESC         
        ")->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT p.*,
                   CONCAT(o.owner_first_name, ' ', o.owner_last_name) AS owner_name,
                   o.owner_contact_no, o.sex AS owner_sex,
                   o.owner_suffix, o.owner_first_name, o.owner_last_name
            FROM pet_table p
            LEFT JOIN owner_table o ON p.owner_id = o.owner_id
            WHERE p.pet_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByOwner(int $ownerId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM pet_table 
            WHERE owner_id = ? 
            ORDER BY pet_id DESC
        ");
        $stmt->execute([$ownerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function create(
        int $ownerId,
        string $name,
        int $age,
        string $species,
        string $breed,
        float $weight,
        string $status
    ): bool {
        $stmt = $this->db->prepare("
        INSERT INTO pet_table 
            (owner_id, pet_name, pet_age, pet_species, pet_breed, pet_weight, pet_status)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
        return $stmt->execute([$ownerId, $name, $age, $species, $breed, $weight, $status]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE pet_table SET 
                    owner_id = :owner_id,
                    pet_name = :pet_name,
                    pet_age = :pet_age,
                    pet_weight = :pet_weight,
                    pet_species = :pet_species,
                    pet_breed = :pet_breed,
                    pet_status = :pet_status
                WHERE pet_id = :pet_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':owner_id' => $data['owner_id'] ?? null,
            ':pet_name' => $data['name'] ?? '',
            ':pet_age' => $data['age'] ?? null,
            ':pet_weight' => $data['weight'] ?? null,
            ':pet_species' => $data['species'] ?? '',
            ':pet_breed' => $data['breed'] ?? '',
            ':pet_status' => $data['status'] ?? 'active',
            ':pet_id' => $id
        ]);
    }



    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM pet_table WHERE pet_id = ?");
        return $stmt->execute([$id]);
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM pet_table")->fetchColumn();
    }
    public function allForDropdown(): array
    {
        return $this->db->query("
            SELECT 
                p.pet_id,
                CONCAT(p.pet_name, ' (', 
                       COALESCE(CONCAT(o.owner_first_name, ' ', o.owner_last_name), 'No Owner'), 
                       ')') AS label
            FROM pet_table p
            LEFT JOIN owner_table o ON p.owner_id = o.owner_id
            ORDER BY p.pet_name ASC
        ")->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

}