<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Record
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        return $this->db->query("
            SELECT r.*,
                   p.pet_name, p.pet_species, p.pet_breed,
                   CONCAT(o.owner_first_name,' ',o.owner_last_name) AS owner_name,
                   o.owner_contact_no,
                   v.vaccine_name, v.vaccine_form,
                   s.staff_name
            FROM record_table r
            LEFT JOIN pet_table     p ON r.pet_id     = p.pet_id
            LEFT JOIN owner_table   o ON p.owner_id   = o.owner_id
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            LEFT JOIN staff_table   s ON r.staff_id   = s.staff_id
            ORDER BY r.date_administer DESC
        ")->fetchAll() ?? [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT r.*,
                   p.pet_name, p.pet_species, p.pet_breed, p.pet_age, p.pet_weight,
                   CONCAT(o.owner_first_name,' ',o.owner_last_name) AS owner_name,
                   o.owner_contact_no,
                   v.vaccine_name, v.vaccine_form,
                   s.staff_name
            FROM record_table r
            LEFT JOIN pet_table     p ON r.pet_id     = p.pet_id
            LEFT JOIN owner_table   o ON p.owner_id   = o.owner_id
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            LEFT JOIN staff_table   s ON r.staff_id   = s.staff_id
            WHERE r.record_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function overdue(): array
    {
        $stmt = $this->db->prepare("
            SELECT r.*,
                   p.pet_name, p.pet_species,
                   CONCAT(o.owner_first_name,' ',o.owner_last_name) AS owner_name,
                   o.owner_contact_no,
                   v.vaccine_name
            FROM record_table r
            LEFT JOIN pet_table     p ON r.pet_id     = p.pet_id
            LEFT JOIN owner_table   o ON p.owner_id   = o.owner_id
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            WHERE r.next_dose IS NOT NULL
              AND r.next_dose < CURDATE()
            ORDER BY r.next_dose ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll() ?? [];
    }

    public function dueSoon(int $days = 30): array
    {
        $stmt = $this->db->prepare("
            SELECT r.*,
                   p.pet_name, p.pet_species,
                   CONCAT(o.owner_first_name,' ',o.owner_last_name) AS owner_name,
                   o.owner_contact_no,
                   v.vaccine_name
            FROM record_table r
            LEFT JOIN pet_table     p ON r.pet_id     = p.pet_id
            LEFT JOIN owner_table   o ON p.owner_id   = o.owner_id
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            WHERE r.next_dose IS NOT NULL
              AND r.next_dose BETWEEN CURDATE() 
                  AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
            ORDER BY r.next_dose ASC
        ");
        $stmt->execute([$days]);
        return $stmt->fetchAll() ?? [];
    }

    public function findByPet(int $petId): array
    {
        $stmt = $this->db->prepare("
            SELECT r.*, v.vaccine_name, v.vaccine_form, s.staff_name
            FROM record_table r
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            LEFT JOIN staff_table   s ON r.staff_id   = s.staff_id
            WHERE r.pet_id = ?
            ORDER BY r.date_administer DESC
        ");
        $stmt->execute([$petId]);
        return $stmt->fetchAll() ?? [];
    }

    public function recent(int $limit = 8): array
    {
        $limit = (int) $limit;
        $stmt = $this->db->query("
            SELECT r.*,
                   p.pet_name, p.pet_species,
                   CONCAT(o.owner_first_name,' ',o.owner_last_name) AS owner_name,
                   v.vaccine_name, s.staff_name
            FROM record_table r
            LEFT JOIN pet_table     p ON r.pet_id     = p.pet_id
            LEFT JOIN owner_table   o ON p.owner_id   = o.owner_id
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            LEFT JOIN staff_table   s ON r.staff_id   = s.staff_id
            ORDER BY r.date_administer DESC
            LIMIT {$limit}
        ");
        return $stmt->fetchAll() ?? [];
    }

    public function create(
        int $petId,
        int $vaccineId,
        string $dateAdminister,
        int $dosage,
        string $nextDose,
        int $staffId,
        string $dateUpdated
    ): bool {
        $stmt = $this->db->prepare("
            INSERT INTO record_table
                (pet_id, vaccine_id, date_administer, dosage, next_dose, staff_id, date_updated)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$petId, $vaccineId, $dateAdminister, $dosage, $nextDose, $staffId, $dateUpdated]);
    }

    public function update(
        int $id,
        int $petId,
        int $vaccineId,
        string $dateAdminister,
        int $dosage,
        string $nextDose,
        int $staffId,
        string $dateUpdated
    ): bool {
        $stmt = $this->db->prepare("
            UPDATE record_table
            SET pet_id=?, vaccine_id=?, date_administer=?, dosage=?,
                next_dose=?, staff_id=?, date_updated=?
            WHERE record_id=?
        ");
        return $stmt->execute([$petId, $vaccineId, $dateAdminister, $dosage, $nextDose, $staffId, $dateUpdated, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM record_table WHERE record_id = ?");
        return $stmt->execute([$id]);
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM record_table")->fetchColumn();
    }

    public function countDueSoon(int $days = 30): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM record_table
            WHERE next_dose IS NOT NULL
              AND next_dose BETWEEN CURDATE()
                  AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
        ");
        $stmt->execute([$days]);
        return (int) $stmt->fetchColumn();
    }

    public function findByOwner(int $ownerId): array
    {
        $stmt = $this->db->prepare("
            SELECT r.*,
                   p.pet_name, p.pet_species, p.pet_breed,
                   v.vaccine_name, v.vaccine_form, v.vaccine_type,
                   s.staff_name
            FROM record_table r
            LEFT JOIN pet_table     p ON r.pet_id     = p.pet_id
            LEFT JOIN vaccine_table v ON r.vaccine_id = v.vaccine_id
            LEFT JOIN staff_table   s ON r.staff_id   = s.staff_id
            WHERE p.owner_id = ?
            ORDER BY r.date_administer DESC
        ");
        $stmt->execute([$ownerId]);
        return $stmt->fetchAll() ?? [];
    }

}