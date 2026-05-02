<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class OwnerController
{
    private Owner $owner;
    private Pet $pet;

    public function __construct()
    {
        AuthMiddleware::check();
        $this->owner = new Owner();
        $this->pet = new Pet();
    }


    public function index()
    {
        $owners = $this->owner->all();
        $pageTitle = 'Owners';
        require __DIR__ . '/../views/admin/owners/index.php';
    }


    public function create()
    {
        $pageTitle = 'Add New Owner & Pet';
        require __DIR__ . '/../views/admin/owners/create.php';
    }

    public function storeWithPet()
    {

        $firstName = trim((string) ($_POST['owner_first_name'] ?? ''));
        $lastName = trim((string) ($_POST['owner_last_name'] ?? ''));
        $suffix = trim((string) ($_POST['owner_suffix'] ?? ''));
        $sex = trim((string) ($_POST['sex'] ?? ''));
        $contactNo = trim((string) ($_POST['owner_contact_no'] ?? ''));


        $petName = trim((string) ($_POST['pet_name'] ?? ''));
        $age = (int) ($_POST['pet_age'] ?? 0);
        $species = trim((string) ($_POST['pet_species'] ?? ''));
        $breed = trim((string) ($_POST['pet_breed'] ?? ''));
        $weight = (float) ($_POST['pet_weight'] ?? 0.0);
        $status = trim((string) ($_POST['pet_status'] ?? 'active'));


        $errors = false;

        if ($firstName === '') {
            Flash::set('error', 'Owner first name is required.');
            $errors = true;
        }
        if ($lastName === '') {
            Flash::set('error', 'Owner last name is required.');
            $errors = true;
        }
        if ($contactNo === '') {
            Flash::set('error', 'Owner contact number is required.');
            $errors = true;
        }
        if ($petName === '') {
            Flash::set('error', 'Pet name is required.');
            $errors = true;
        }
        if ($species === '') {
            Flash::set('error', 'Pet species is required.');
            $errors = true;
        }

        if ($errors) {
            header("Location: ?controller=owner&action=create");
            exit;
        }


        $this->owner->create($firstName, $lastName, $suffix, $sex, $contactNo);


        $ownerId = $this->owner->getLastInsertId();


        $this->pet->create($ownerId, $petName, $age, $species, $breed, $weight, $status);

        Flash::set('success', "Owner '{$firstName} {$lastName}' and Pet '{$petName}' added successfully.");

        header("Location: ?controller=owner&action=index");
        exit;
    }


    public function show(int $id)
    {
        $owner = $this->owner->find($id);
        if (!$owner) {
            Flash::set('error', 'Owner not found.');
            header("Location: ?controller=owner&action=index");
            exit;
        }
        $pets = $this->pet->findByOwner($id);
        $pageTitle = 'Owner Details';
        require __DIR__ . '/../views/admin/owners/show.php';
    }

    public function edit(int $id)
    {
        $owner = $this->owner->find($id);
        if (!$owner) {
            Flash::set('error', 'Owner not found.');
            header("Location: ?controller=owner&action=index");
            exit;
        }
        $pageTitle = 'Edit Owner';
        require __DIR__ . '/../views/admin/owners/edit.php';
    }

    public function update(int $id)
    {
        $firstName = trim((string) ($_POST['owner_first_name'] ?? ''));
        $lastName = trim((string) ($_POST['owner_last_name'] ?? ''));
        $suffix = trim((string) ($_POST['owner_suffix'] ?? ''));
        $sex = trim((string) ($_POST['sex'] ?? ''));
        $contactNo = trim((string) ($_POST['owner_contact_no'] ?? ''));

        if ($firstName === '' || $lastName === '') {
            Flash::set('error', 'First name and last name are required.');
            header("Location: ?controller=owner&action=edit&id={$id}");
            exit;
        }

        $this->owner->update($id, $firstName, $lastName, $suffix, $sex, $contactNo);
        Flash::set('success', 'Owner updated successfully.');
        header("Location: ?controller=owner&action=index");
        exit;
    }

    public function delete(int $id)
    {
        $this->owner->delete($id);
        Flash::set('success', 'Owner deleted successfully.');
        header("Location: ?controller=owner&action=index");
        exit;
    }
}