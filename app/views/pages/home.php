<?php require __DIR__ . '/../layouts/layout.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">Welcome</h1>
            <p class="lead">Welcome to our Pet Vaccination Management System</p>

            <div class="row mt-5">
                <div class="col-md-6 mb-3">
                    <a href="?controller=page&action=owner" class="btn btn-primary btn-lg w-100">Pet Owners</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="?controller=page&action=vaccination" class="btn btn-success btn-lg w-100">Vaccination
                        Info</a>
                </div>
            </div>


        </div>
    </div>
</div>