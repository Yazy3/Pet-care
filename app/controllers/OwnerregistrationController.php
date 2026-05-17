<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../core/Session.php';

class OwnerregistrationController
{
    private Owner $owner;

    public function __construct()
    {
        Session::start();
        $this->owner = new Owner();
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
        $firstName = trim($_POST['owner_first_name'] ?? '');
        $lastName = trim($_POST['owner_last_name'] ?? '');
        $suffix = trim($_POST['owner_suffix'] ?? '');
        $sex = $_POST['sex'] ?? '';
        $contactNo = trim($_POST['owner_contact_no'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (preg_match('/\d/', $firstName))
            $errors[] = 'First name cannot contain numbers.';
        if (preg_match('/\d/', $lastName))
            $errors[] = 'Last name cannot contain numbers.';
        if (preg_match('/\d/', $username))
            $errors[] = 'Username cannot contain numbers.';

        if (empty($firstName))
            $errors[] = 'First name is required.';
        if (empty($lastName))
            $errors[] = 'Last name is required.';
        if (empty($sex))
            $errors[] = 'Sex is required.';
        if (empty($contactNo))
            $errors[] = 'Contact number is required.';
        if (empty($username))
            $errors[] = 'Username is required.';
        if (strlen($password) < 6)
            $errors[] = 'Password must be at least 6 characters.';

        if (!empty($errors)) {
            Flash::set('error', $errors);
            header("Location: ?controller=registration&action=create");
            exit;
        }

        if ($this->owner->findByUsername($username)) {
            Flash::set('error', 'Username is already taken.');
            header("Location: ?controller=registration&action=create");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $this->owner->create($firstName, $lastName, $suffix, $sex, $contactNo, $username, $hashedPassword);

        if ($result !== false) {
            Flash::set('success', 'Pet Owner account created successfully!');
            header("Location: ?controller=auth&action=index");
            exit;
        } else {
            Flash::set('error', 'Failed to create account. Please try again.');
            header("Location: ?controller=registration&action=create");
            exit;
        }
    }
}