<?php
$pageTitle = $pageTitle ?? 'PetCare Clinic';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> — PetCare Clinic</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #1f7a5a;
            --dark: #0f3d56;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #e0f2f1 0%, #dbeafe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1100px;
            min-height: 620px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            display: grid;
            grid-template-columns: 1.1fr 1fr;
        }

        /* LEFT SIDE - Attractive Panel */
        .auth-left {
            background: linear-gradient(rgba(15, 61, 86, 0.85), rgba(15, 61, 86, 0.9)),
                url('../assets/images/petcare-bg.jpg') center/cover no-repeat;
            padding: 60px 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .brand-logo {
            width: 75px;
            height: 75px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            backdrop-filter: blur(10px);
        }

        .auth-left h1 {
            font-size: 38px;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 15px;
        }

        .auth-left p {
            font-size: 17px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* RIGHT SIDE - Form */
        .auth-right {
            padding: 60px 50px;
            display: flex;
            align-items: center;
        }

        .auth-form-box {
            width: 100%;
            max-width: 400px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            border-radius: 10px;
            padding: 14px 16px;
            border: 1.5px solid #e5e7eb;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(31, 122, 90, 0.15);
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            border: none;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .auth-wrapper {
                grid-template-columns: 1fr;
            }

            .auth-left {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <!-- LEFT SIDE -->
        <div class="auth-left">
            <div class="brand">
                <div class="brand-logo">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
            </div>
            <h1>Welcome to PetCare</h1>
            <p>Professional Pet Medical Record & Vaccination Monitoring System</p>
        </div>

        <!-- RIGHT SIDE -->
        <div class="auth-right">
            <div class="auth-form-box">
                <?= $content ?? '<p class="text-danger">Content missing</p>' ?>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>