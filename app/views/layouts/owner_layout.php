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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap5.min.css">

    <style>
    :root {
        --sw: 240px;
        --sbg: #134E5E;
        --sacc: #63BFBF;
        --stxt: #A7E0E0;
        --th: 58px;
        --acc-dark: #3a9f9f;
        --page-bg: #F7FFFE;
        --border: #D8F4F2;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
        margin: 0;
        background: var(--page-bg);
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-size: 14px;
        color: #1e293b;
    }

    #sb {
        position: fixed;
        inset: 0 auto 0 0;
        width: var(--sw);
        background: var(--sbg);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        z-index: 1040;
        transition: transform .28s ease;
    }

    .sb-brand {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 18px 18px 16px;
        border-bottom: 1px solid rgba(255,255,255,.06);
        text-decoration: none;
    }

    .sb-ico {
        width: 38px; height: 38px;
        background: var(--sacc);
        border-radius: 10px;
        display: grid; place-items: center;
        font-size: 19px; color: #fff; flex-shrink: 0;
    }

    .sb-name { color: #fff; font-weight: 700; font-size: 15px; line-height: 1.2; }
    .sb-sub  { color: var(--stxt); font-size: 11px; }

    .sb-sec  { padding: 18px 14px 4px; }

    .sb-lbl {
        font-size: 10px; font-weight: 600;
        letter-spacing: .09em; text-transform: uppercase;
        color: rgba(255,255,255,.25);
        padding: 0 8px; margin-bottom: 4px;
    }

    .sb-nav { list-style: none; padding: 0; margin: 0; }

    .sb-nav .nl {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 12px; border-radius: 8px;
        color: var(--stxt); font-size: 13.5px;
        text-decoration: none;
        transition: background .14s, color .14s;
        margin-bottom: 2px;
    }

    .sb-nav .nl i { font-size: 16px; width: 18px; text-align: center; flex-shrink: 0; }

    .sb-nav .nl:hover,
    .sb-nav .nl.active { background: rgba(255,255,255,.08); color: #fff; }
    .sb-nav .nl.active { background: var(--sacc); }

    .sb-foot {
        margin-top: auto;
        padding: 14px;
        border-top: 1px solid rgba(255,255,255,.06);
    }

    .sb-usr { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 8px; }

    .sb-av {
        width: 32px; height: 32px; border-radius: 50%;
        background: var(--sacc);
        display: grid; place-items: center;
        font-size: 13px; font-weight: 600; color: #fff; flex-shrink: 0;
    }

    .sb-un { color: #fff; font-size: 13px; font-weight: 500; }
    .sb-ur { color: var(--stxt); font-size: 11px; }

    .sb-out { margin-left: auto; color: var(--stxt); font-size: 17px; text-decoration: none; transition: color .15s; }
    .sb-out:hover { color: #f87171; }

    #main { margin-left: var(--sw); min-height: 100vh; display: flex; flex-direction: column; }

    #topbar {
        height: var(--th);
        background: #fff;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center;
        padding: 0 24px; gap: 12px;
        position: sticky; top: 0; z-index: 100;
    }

    #sbtog { display: none; }

    .pg { padding: 24px; flex: 1; }

    .panel {
        background: #fff;
        border-radius: 12px;
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .panel-hd {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
    }

    .panel-hd h6 { margin: 0; font-weight: 600; font-size: 14px; }
    .panel-bd { padding: 20px; }

    .badge-dog    { background: #D8F4F2; color: #134E5E; }
    .badge-cat    { background: #A7E0E0; color: #134E5E; }
    .badge-active   { background: #D8F4F2; color: #134E5E; }
    .badge-inactive { background: #fef9c3; color: #713f12; }
    .badge-deceased { background: #fee2e2; color: #991b1b; }

    #sbdrop {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1030; opacity: 0; visibility: hidden;
        transition: opacity .28s ease, visibility .28s ease;
    }

    #sbdrop.show { opacity: 1; visibility: visible; }

    .btn-success            { background-color: #63BFBF !important; border-color: #63BFBF !important; color: #fff !important; }
    .btn-success:hover      { background-color: #3a9f9f !important; border-color: #3a9f9f !important; }
    .btn-outline-success    { border-color: #63BFBF !important; color: #134E5E !important; }
    .btn-outline-success:hover { background-color: #D8F4F2 !important; }
    .alert-success          { background-color: #D8F4F2 !important; border-color: #A7E0E0 !important; color: #134E5E !important; }
    .text-success           { color: #134E5E !important; }
    .bg-success             { background-color: #63BFBF !important; }
    .table-light            { background-color: #F7FFFE !important; }

    @media(max-width:991px) {
        #sb { transform: translateX(-100%); }
        #sb.show { transform: translateX(0); }
        #sbdrop { display: block; }
        #main { margin-left: 0; }
        #sbtog { display: inline-flex; }
    }
    </style>
</head>

<body>
    <div id="sbdrop" onclick="closeSidebar()"></div>

    <?php
    function isActiveOwner(string $ctrl, string $act = ''): string
    {
        $c = $_GET['controller'] ?? '';
        $a = $_GET['action'] ?? '';
        if ($act === '') return $c === $ctrl ? 'active' : '';
        return ($c === $ctrl && $a === $act) ? 'active' : '';
    }
    $me = $_SESSION['user'] ?? ['name' => 'Owner'];
    ?>

<!-- SIDEBAR -->
    <nav id="sb">
        <a href="?controller=ownerdashboard&action=index" class="sb-brand">
            <div class="sb-ico"><i class="bi bi-heart-pulse-fill"></i></div>
            <div>
                <div class="sb-name">PetCare</div>
                <div class="sb-sub">Owner Portal</div>
            </div>
        </a>

        <!-- Nav links -->
        <div class="sb-sec">
            <div class="sb-lbl">My Pets</div>
            <ul class="sb-nav">

                <li><a href="?controller=ownerdashboard&action=index" class="nl <?= isActiveOwner('ownerdashboard', 'index') ?>" onclick="closeSidebar()">
                    <i class="bi bi-paw-fill"></i> My Pets
                </a></li>

                <li><a href="?controller=ownerdashboard&action=schedule" class="nl <?= isActiveOwner('ownerdashboard', 'schedule') ?>" onclick="closeSidebar()">
                    <i class="bi bi-calendar2-check-fill"></i> My Schedule
                </a></li>

            </ul>
        </div>

        <!-- Owner profile & Logout -->
        <div class="sb-foot">
            <div class="sb-usr">
                <div class="sb-av"><?= strtoupper(substr($me['name'], 0, 1)) ?></div>
                <div>
                    <div class="sb-un"><?= htmlspecialchars($me['name']) ?></div>
                    <div class="sb-ur">Pet Owner</div>
                </div>
                <a href="?controller=auth&action=logout" class="sb-out"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </nav>

    <div id="main">
        <div id="topbar">
            <button id="sbtog" class="btn btn-sm btn-outline-secondary" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="pg">

            <?php if (!empty($_SESSION['flash']['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php foreach ($_SESSION['flash']['success'] as $m): ?>
                <div><?= htmlspecialchars($m) ?></div>
                <?php endforeach; unset($_SESSION['flash']['success']); ?>
                <button type="button" class="btn-close" onclick="this.closest('.alert').remove()"></button>
            </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['flash']['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?php foreach ($_SESSION['flash']['error'] as $m): ?>
                <div><?= htmlspecialchars($m) ?></div>
                <?php endforeach; unset($_SESSION['flash']['error']); ?>
                <button type="button" class="btn-close" onclick="this.closest('.alert').remove()"></button>
            </div>
            <?php endif; ?>