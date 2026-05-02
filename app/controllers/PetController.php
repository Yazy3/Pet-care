<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Record.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';


class PetController
{
    private Pet $pet;
    private Owner $owner;
    private Record $record;

    public function __construct()
    {
        AuthMiddleware::check();
        $this->pet = new Pet();
        $this->owner = new Owner();
        $this->record = new Record();
    }

    public function index()
    {
        $pets = $this->pet->all();
        $pageTitle = 'Pets';
        require __DIR__ . '/../views/admin/pets/index.php';
    }

    public function create()
    {
        $owner_id = isset($_GET['owner_id']) ? (int) $_GET['owner_id'] : null;

        $owners = $this->owner->allForDropdown();
        $owner = null;

        if ($owner_id > 0) {
            $owner = $this->owner->find($owner_id);
        }

        $pageTitle = 'Add New Pet';
        require __DIR__ . '/../views/admin/pets/create.php';
    }
    public function show(int $id)
    {
        $pet = $this->pet->find($id);
        if (!$pet) {
            Flash::set('error', 'Pet not found.');
            header("Location: ?controller=pet&action=index");
            exit;
        }
        $records = $this->record->findByPet($id);
        $pageTitle = 'Pet Details';
        require __DIR__ . '/../views/admin/pets/show.php';
    }

    public function edit(int $id)
    {
        $pet = $this->pet->find($id);
        $owners = $this->owner->allForDropdown();
        if (!$pet) {
            Flash::set('error', 'Pet not found.');
            header("Location: ?controller=pet&action=index");
            exit;
        }
        $pageTitle = 'Edit Pet';
        require __DIR__ . '/../views/admin/pets/edit.php';
    }
    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'owner_id' => $_POST['owner_id'] ?? null,
                'name' => $_POST['name'] ?? '',
                'species' => $_POST['species'] ?? '',
                'breed' => $_POST['breed'] ?? '',
                'age' => $_POST['age'] ?? null,
                'weight' => $_POST['weight'] ?? null,
                'status' => $_POST['status'] ?? 'Active'
            ];

            $result = $this->pet->update($id, $data);

            if ($result) {
                Flash::set('success', 'Pet updated successfully!');
                header("Location: ?controller=pet&action=index");
                exit;
            } else {
                Flash::set('error', 'Failed to update pet.');
                header("Location: ?controller=pet&action=edit&id=" . $id);
                exit;
            }
        }


        header("Location: ?controller=pet&action=index");
        exit;
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $owner_id = isset($_POST['owner_id']) ? (int) $_POST['owner_id'] : null;

            if ($owner_id <= 0) {
                Flash::set('error', 'Owner ID is required.');
                header("Location: ?controller=pet&action=index");
                exit;
            }

            $result = $this->pet->create(
                $owner_id,
                trim($_POST['pet_name'] ?? ''),
                (int) ($_POST['pet_age'] ?? 0),
                trim($_POST['pet_species'] ?? ''),
                trim($_POST['pet_breed'] ?? ''),
                (float) ($_POST['pet_weight'] ?? 0),
                trim($_POST['pet_status'] ?? 'active')
            );

            if ($result) {
                Flash::set('success', 'Pet added successfully!');
                header("Location: ?controller=owner&action=show&id=" . $owner_id);
                exit;
            } else {
                Flash::set('error', 'Failed to add pet.');
                header("Location: ?controller=pet&action=create&owner_id=" . $owner_id);
                exit;
            }
        }

        header("Location: ?controller=pet&action=index");
        exit;
    }
}