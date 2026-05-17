<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class StaffController
{
    private Staff $staff;

    public function __construct()
    {
        AuthMiddleware::check();
        $this->staff = new Staff();
    }

    public function index()
    {
        $staffs = $this->staff->all();
        $pageTitle = 'Staff Management';
        require __DIR__ . '/../views/admin/staff/index.php';
    }

    public function create()
    {
        $pageTitle = 'Add New Staff';
        require __DIR__ . '/../views/admin/staff/create.php';
    }

    public function store()
    {
        $staffName = trim((string) ($_POST['staff_name'] ?? ''));
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = $_POST['password'] ?? '';

        if (empty($staffName) || empty($username) || empty($password)) {
            Flash::set('error', 'All fields are required.');
            header("Location: ?controller=staff&action=create");
            exit;
        }

        // Validation
        if (preg_match('/\d/', $staffName)) {
            Flash::set('error', 'Staff name cannot contain numbers.');
            header("Location: ?controller=staff&action=create");
            exit;
        }
        if (preg_match('/\d/', $username)) {
            Flash::set('error', 'Username cannot contain numbers.');
            header("Location: ?controller=staff&action=create");
            exit;
        }
        if (strlen($password) < 6) {
            Flash::set('error', 'Password must be at least 6 characters.');
            header("Location: ?controller=staff&action=create");
            exit;
        }

        // ✅ Prevent duplicate username
        if ($this->staff->findByUsername($username)) {
            Flash::set('error', 'Username is already taken. Please choose another one.');
            header("Location: ?controller=staff&action=create");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->staff->create($staffName, $username, $hashedPassword);

        if ($result) {
            Flash::set('success', 'New staff member added successfully.');
            header("Location: ?controller=staff&action=index");
            exit;
        } else {
            Flash::set('error', 'Failed to create staff member. Please try again.');
            header("Location: ?controller=staff&action=create");
            exit;
        }
    }

    public function edit(int $id)
    {
        $staff = $this->staff->find($id);
        if (!$staff) {
            Flash::set('error', 'Staff not found.');
            header("Location: ?controller=staff&action=index");
            exit;
        }
        $pageTitle = 'Edit Staff';
        require __DIR__ . '/../views/admin/staff/edit.php';
    }

    public function update(int $id)
    {
        $staffName = trim((string) ($_POST['staff_name'] ?? ''));
        $username = trim((string) ($_POST['username'] ?? ''));

        if (empty($staffName) || empty($username)) {
            Flash::set('error', 'Name and username are required.');
            header("Location: ?controller=staff&action=edit&id=$id");
            exit;
        }

        $this->staff->update($id, $staffName, $username);
        Flash::set('success', 'Staff updated successfully.');
        header("Location: ?controller=staff&action=index");
        exit;
    }

    public function delete(int $id)
    {
        $this->staff->delete($id);
        Flash::set('success', 'Staff deleted successfully.');
        header("Location: ?controller=staff&action=index");
        exit;
    }
}