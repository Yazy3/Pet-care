<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Registration.php';
require_once __DIR__ . '/../core/Flash.php';

class RegistrationController
{
    private Registration $registration;

    public function __construct()
    {
        $this->registration = new Registration();
    }

    public function create()
    {
        require __DIR__ . '/../views/registration/create.php';
    }

    public function store()
    {
        $staffName = trim((string) ($_POST['staff_name'] ?? ''));
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($staffName === '') {
            Flash::set('error', 'Staff name is required.');
        }

        if ($username === '') {
            Flash::set('error', 'Username is required.');
        }

        if (strlen($password) < 6) {
            Flash::set('error', 'Password must be at least 6 characters.');
        }

        if ($this->registration->findByUsername($username)) {
            Flash::set('error', 'Username already exists.');
        }

        if (Flash::has('error')) {
            header("Location: ?controller=registration&action=create");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->registration->create($staffName, $username, $hashedPassword);

        Flash::set('success', 'Account created successfully! You can now login.');
        header("Location: ?controller=auth&action=index");
        exit;
    }
}