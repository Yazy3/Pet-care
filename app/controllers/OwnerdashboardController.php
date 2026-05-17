<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Records.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class OwnerdashboardController
{
    private Pet $pet;
    private Record $record;

    public function __construct()
    {
        AuthMiddleware::check();

        if (($_SESSION['user']['role'] ?? '') !== 'owner') {
            header("Location: ?controller=home&action=index");
            exit;
        }

        $this->pet = new Pet();
        $this->record = new Record();
    }

    public function index()
    {
        $ownerId = (int) ($_SESSION['user']['owner_id'] ?? 0);

        if ($ownerId <= 0) {
            Flash::set('error', 'Session error. Please login again.');
            header("Location: ?controller=auth&action=index");
            exit;
        }

        $pets = $this->pet->findByOwner($ownerId);

        $pageTitle = 'My Pets';
        require __DIR__ . '/../views/owners/my_pet.php';
    }

    public function schedule()
    {
        $ownerId = (int) ($_SESSION['user']['owner_id'] ?? 0);

        if ($ownerId <= 0) {
            header("Location: ?controller=auth&action=index");
            exit;
        }

        $schedules = $this->record->findByOwner($ownerId);
        $pageTitle = 'My Schedule';
        require __DIR__ . '/../views/owners/my_sched.php';
    }
}