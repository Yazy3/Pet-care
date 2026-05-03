<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Records.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Vaccine.php';
require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class RecordsController
{
    private Record $record;
    private Pet $pet;
    private Vaccine $vaccine;
    private Staff $staff;

    public function __construct()
    {
        AuthMiddleware::check();
        $this->record = new Record();
        $this->pet = new Pet();
        $this->vaccine = new Vaccine();
        $this->staff = new Staff();
    }

    public function index()
    {
        $records = $this->record->all();
        require __DIR__ . '/../views/admin/records/index.php';
    }

    public function schedule()
    {
        $dueSoon = $this->record->dueSoon(30);
        $overdue = $this->record->overdue();
        require __DIR__ . '/../views/admin/records/schedule.php';
    }

    public function create()
    {
        $pets = $this->pet->allForDropdown();
        $vaccines = $this->vaccine->allForDropdown();
        $staffs = $this->staff->allForDropdown();
        require __DIR__ . '/../views/admin/records/create.php';
    }

    public function store()
    {

        $petId = (int) ($_POST['pet_id'] ?? 0);
        $vaccineId = (int) ($_POST['vaccine_id'] ?? 0);
        $dateAdminister = trim((string) ($_POST['date_administer'] ?? ''));
        $dosage = (int) ($_POST['dosage'] ?? 0);
        $nextDose = trim((string) ($_POST['next_dose'] ?? ''));
        $staffId = (int) ($_POST['staff_id'] ?? 0);
        $dateUpdated = date('Y-m-d');

        if ($petId === 0)
            Flash::set('error', 'Please select a pet.');
        if ($vaccineId === 0)
            Flash::set('error', 'Please select a vaccine.');
        if ($dateAdminister === '')
            Flash::set('error', 'Date administered is required.');
        if ($staffId === 0)
            Flash::set('error', 'Please select a staff member.');

        if (Flash::has('error')) {
            header("Location: ?controller=records&action=create");
            exit;
        }

        $this->record->create($petId, $vaccineId, $dateAdminister, $dosage, $nextDose, $staffId, $dateUpdated);
        Flash::set('success', 'Vaccination record saved successfully.');
        header("Location: ?controller=records&action=index");
        exit;
    }

    public function show(int $id)
    {
        $record = $this->record->find($id);
        if (!$record) {
            Flash::set('error', 'Record not found.');
            header("Location: ?controller=records&action=index");
            exit;
        }
        require __DIR__ . '/../../views/records/show.php';
    }

    public function edit(int $id)
    {
        $record = $this->record->find($id);
        $pets = $this->pet->allForDropdown();
        $vaccines = $this->vaccine->allForDropdown();
        $staffs = $this->staff->allForDropdown();

        if (!$record) {
            Flash::set('error', 'Record not found.');
            header("Location: ?controller=records&action=index");
            exit;
        }
        require __DIR__ . '/../../views/records/edit.php';
    }

    public function update(int $id)
    {
        $petId = (int) ($_POST['pet_id'] ?? 0);
        $vaccineId = (int) ($_POST['vaccine_id'] ?? 0);
        $dateAdminister = trim((string) ($_POST['date_administer'] ?? ''));
        $dosage = (int) ($_POST['dosage'] ?? 0);
        $nextDose = trim((string) ($_POST['next_dose'] ?? ''));
        $staffId = (int) ($_POST['staff_id'] ?? 0);
        $dateUpdated = date('Y-m-d');

        if ($petId === 0)
            Flash::set('error', 'Please select a pet.');
        if ($vaccineId === 0)
            Flash::set('error', 'Please select a vaccine.');
        if ($staffId === 0)
            Flash::set('error', 'Please select a staff member.');

        if (Flash::has('error')) {
            header("Location: ?controller=records&action=edit&id={$id}");
            exit;
        }

        $this->record->update($id, $petId, $vaccineId, $dateAdminister, $dosage, $nextDose, $staffId, $dateUpdated);
        Flash::set('success', 'Record updated successfully.');
        header("Location: ?controller=records&action=index");
        exit;
    }

    public function delete(int $id)
    {
        $this->record->delete($id);
        Flash::set('success', 'Record deleted.');
        header("Location: ?controller=records&action=index");
        exit;
    }
}