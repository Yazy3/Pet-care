<?php
declare(strict_types=1);

require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Records.php';
require_once __DIR__ . '/../models/Vaccine.php';

class HomeController
{
    public function __construct()
    {
        AuthMiddleware::check();
    }

    public function index()
    {
        $owner   = new Owner();
        $pet     = new Pet();
        $record  = new Record();
        $vaccine = new Vaccine();

        $totalOwners   = $owner->count();
        $totalPets     = $pet->count();
        $totalRecords  = $record->count();
        $totalVaccines = $vaccine->count();
        $dueSoon       = $record->countDueSoon(30);
        $recentRecords = $record->recent(5);

        $pageTitle = 'Home';
        require __DIR__ . '/../views/admin/home/index.php';
    }
}