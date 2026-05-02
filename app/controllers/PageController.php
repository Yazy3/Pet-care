<?php

class PageController
{
    public function home()
    {
        require __DIR__ . '/../views/pages/home.php';
    }

    public function Owner()
    {
        require __DIR__ . '/../views/pages/owner.php';
    }

    public function about()
    {
        require __DIR__ . '/../views/pages/about.php';
    }

    public function contact()
    {
        require __DIR__ . '/../views/pages/contact.php';
    }

    public function record()
    {
        require __DIR__ . '/../views/pages/record.php';
    }

    public function login()
    {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function register()
    {
        require __DIR__ . '/../views/pages/registration.php';
    }

    public function vaccination()
    {
        require __DIR__ . '/../views/pages/vaccination.php';
    }
}