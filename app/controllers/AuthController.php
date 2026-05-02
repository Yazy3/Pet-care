<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../core/Flash.php';

class AuthController
{
    private Staff $staff;
    public function __construct()
    {
        Session::start();
        $this->staff = new Staff();
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header("Location: ?controller=owner&action=index");
            exit;
        }

        $pageTitle = 'Login - PetCare Clinic';
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

        $user = $this->staff->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            Flash::set('error', 'Invalid username or password.');
            header("Location: ?controller=auth&action=index");
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['staff_id'],
            'name' => $user['staff_name'],
            'role' => 'Staff',
        ];

        Flash::set('success', 'Welcome back, ' . $user['staff_name'] . '!');
        header("Location: ?controller=owner&action=index");
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