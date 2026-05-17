<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../core/Flash.php';

class AuthController
{
    private Staff $staff;
    private Owner $owner;

    public function __construct()
    {
        Session::start();
        $this->staff = new Staff();
        $this->owner = new Owner();
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $this->redirectByRole();
            exit;
        }

        $pageTitle = 'Login — PetCare Clinic';
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login()
    {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            Flash::set('error', 'Username and password are required.');
            header("Location: ?controller=auth&action=index");
            exit;
        }

        // Staff Login
        $staff = $this->staff->findByUsername($username);
        if ($staff && password_verify($password, $staff['password'] ?? '')) {
            $_SESSION['user'] = [
                'id' => $staff['staff_id'],
                'name' => $staff['staff_name'],
                'role' => 'staff',
            ];
            Flash::set('success', 'Welcome back, ' . $staff['staff_name'] . '!');
            header("Location: ?controller=home&action=index");
            exit;
        }

        // Owner Login
        $owner = $this->owner->findByUsername($username);
        if ($owner && password_verify($password, $owner['password'] ?? '')) {
            $_SESSION['user'] = [
                'id' => $owner['owner_id'],
                'name' => trim($owner['owner_first_name'] . ' ' . ($owner['owner_last_name'] ?? '')),
                'role' => 'owner',
            ];
            Flash::set('success', 'Welcome, ' . $owner['owner_first_name'] . '!');
            header("Location: ?controller=ownerdashboard&action=index");
            exit;
        }

        Flash::set('error', 'Invalid username or password.');
        header("Location: ?controller=auth&action=index");
        exit;
    }

    private function redirectByRole()
    {
        if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'owner') {
            header("Location: ?controller=ownerdashboard&action=index");
        } else {
            header("Location: ?controller=home&action=index");   // Staff goes to Dashboard
        }
        exit;
    }

    public function logout()
    {
        Session::start();
        Session::destroy();
        header("Location: ?controller=auth&action=index");
        exit;
    }
}