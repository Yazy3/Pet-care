<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Vaccine.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class VaccineController
{
    private Vaccine $vaccine;

    public function __construct()
    {
        AuthMiddleware::check();
        $this->vaccine = new Vaccine();
    }

    public function index()
    {
        $vaccines = $this->vaccine->all();
        require __DIR__ . '/../views/admin/vaccine/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/admin/vaccine/create.php';
    }

    public function store()
    {
        $name = trim((string) ($_POST['vaccine_name'] ?? ''));
        $type = trim((string) ($_POST['vaccine_type'] ?? ''));
        $form = trim((string) ($_POST['vaccine_form'] ?? ''));

        if ($name === '') {
            Flash::set('error', 'Vaccine name is required.');
        }
        if ($type === '') {
            Flash::set('error', 'Vaccine type is required.');
        }

        if (Flash::has('error')) {
            header("Location: ?controller=vaccine&action=create");
            exit;
        }

        $this->vaccine->create($name, $type, $form);
        Flash::set('success', "Vaccine '{$name}' added.");
        header("Location: ?controller=vaccine&action=index");
        exit;
    }

    public function edit(int $id)
    {
        $vaccine = $this->vaccine->find($id);
        if (!$vaccine) {
            Flash::set('error', 'Vaccine not found.');
            header("Location: ?controller=vaccine&action=index");
            exit;
        }
        require __DIR__ . '/../views/admin/vaccine/edit.php';
    }

    public function update(int $id)
    {
        $name = trim((string) ($_POST['vaccine_name'] ?? ''));
        $type = trim((string) ($_POST['vaccine_type'] ?? ''));
        $form = trim((string) ($_POST['vaccine_form'] ?? ''));

        if ($name === '') {
            Flash::set('error', 'Vaccine name is required.');
        }
        if ($type === '') {
            Flash::set('error', 'Vaccine type is required.');
        }

        if (Flash::has('error')) {
            header("Location: ?controller=vaccine&action=edit&id={$id}");
            exit;
        }

        $this->vaccine->update($id, $name, $type, $form);
        Flash::set('success', "Vaccine updated.");
        header("Location: ?controller=vaccine&action=index");
        exit;
    }

    public function delete(int $id)
    {
        $this->vaccine->delete($id);
        Flash::set('success', 'Vaccine deleted.');
        header("Location: ?controller=vaccine&action=index");
        exit;
    }
}