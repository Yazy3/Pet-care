<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Registration.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../core/Session.php';

class RegistrationController
{
    private Registration $registration;

    public function __construct()
    {
        Session::start();
        $this->registration = new Registration();
    }

    public function create()
    {
        if (isset($_SESSION['user'])) {
            header("Location: ?controller=auth&action=index");
            exit;
        }
        require __DIR__ . '/../views/registration/create.php';
    }

    public function store()
    {
        $staffName = trim($_POST['staff_name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (preg_match('/\d/', $staffName))
            $errors[] = 'Staff name cannot contain numbers.';
        if (empty($staffName))
            $errors[] = 'Staff name is required.';

        if (preg_match('/\d/', $username))
            $errors[] = 'Username cannot contain numbers.';
        if (empty($username))
            $errors[] = 'Username is required.';

        if (strlen($password) < 6)
            $errors[] = 'Password must be at least 6 characters.';

        if (!empty($errors)) {
            Flash::set('error', $errors);
            header("Location: ?controller=registration&action=create");
            exit;
        }

        if ($this->registration->countStaff() >= 5) {
            Flash::set('error', 'Maximum staff accounts (5) reached.');
            header("Location: ?controller=registration&action=create");
            exit;
        }

        if ($this->registration->findByUsername($username)) {
            Flash::set('error', 'Username is already taken.');
            header("Location: ?controller=registration&action=create");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->registration->create($staffName, $username, $hashedPassword);

        Flash::set('success', 'Staff account created successfully!');
        header("Location: ?controller=auth&action=index");
        exit;
    }
}