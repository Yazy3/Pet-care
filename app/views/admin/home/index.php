<?php
$pageTitle = 'Home';
require __DIR__ . '/../../layouts/layout.php';
?>

<style>
.clinic-image-panel {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--border);
    position: relative;
    min-height: 280px;
    display: flex;
    align-items: flex-end;
    background: linear-gradient(135deg, #134E5E 0%, #1a6a7a 60%, #63BFBF 100%);
}
.clinic-image-panel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    inset: 0;
    opacity: 0.5;
}
.clinic-image-overlay {
    position: relative;
    z-index: 1;
    padding: 22px 24px;
    width: 100%;
    background: linear-gradient(to top, rgba(19,78,94,0.88) 0%, transparent 100%);
}
.clinic-image-overlay h6 {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 4px;
}
.clinic-image-overlay p {
    color: rgba(255,255,255,0.75);
    font-size: 12px;
    margin: 0;
}
</style>

<div class="container-fluid px-0">

    <!-- Welcome Card -->
    <div id="welcome-card" class="mb-4" style="
        background: linear-gradient(135deg, #134E5E 0%, #1a6a7a 60%, #63BFBF 100%);
        border-radius: 16px; padding: 32px; position: relative;
        overflow: hidden; box-shadow: 0 4px 24px rgba(19,78,94,0.18);">
        <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.06);"></div>
        <div style="position:absolute;bottom:-30px;right:100px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,0.05);"></div>
        <div style="position:absolute;right:32px;top:50%;transform:translateY(-50%);opacity:0.08;font-size:120px;line-height:1;">
            <i class="bi bi-paw-fill"></i>
        </div>
        
        <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,0.15);display:grid;place-items:center;font-size:26px;color:#fff;flex-shrink:0;">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <div>
                <div style="color:rgba(255,255,255,0.65);font-size:12px;letter-spacing:.05em;text-transform:uppercase;">PetCare Veterinary Clinic</div>
                <h4 style="color:#fff;font-weight:700;margin:0;">
                    Welcome back, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'Staff') ?>!
                </h4>
            </div>
        </div>
        <p style="color:rgba(255,255,255,0.72);margin:0;font-size:14px;max-width:500px;">
            You're logged in as <strong style="color:#fff;">Staff</strong>. Use the sidebar to manage owners, pets, vaccination records, and schedules.
        </p>
        <div class="mt-3" style="color:rgba(255,255,255,0.5);font-size:12px;">
            <i class="bi bi-calendar3 me-1"></i><?= date('l, F j, Y') ?>
            &nbsp;&nbsp;<i class="bi bi-clock me-1"></i><?= date('g:i A') ?>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-c">
                <div class="stat-i" style="background:#D8F4F2;">
                    <i class="bi bi-people-fill" style="color:#134E5E"></i>
                </div>
                <div>
                    <div class="stat-v"><?= $totalOwners ?? 0 ?></div>
                    <div class="stat-l">Total Owners</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-c">
                <div class="stat-i" style="background:#D8F4F2;">
                    <i class="bi bi-paw-fill" style="color:#134E5E"></i>
                </div>
                <div>
                    <div class="stat-v"><?= $totalPets ?? 0 ?></div>
                    <div class="stat-l">Total Pets</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-c">
                <div class="stat-i" style="background:#D8F4F2;">
                    <i class="bi bi-clipboard2-pulse-fill" style="color:#134E5E"></i>
                </div>
                <div>
                    <div class="stat-v"><?= $totalRecords ?? 0 ?></div>
                    <div class="stat-l">Vacc. Records</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-c">
                <div class="stat-i" style="background:<?= ($dueSoon ?? 0) > 0 ? '#fee2e2' : '#D8F4F2' ?>;">
                    <i class="bi bi-bell-fill" style="color:<?= ($dueSoon ?? 0) > 0 ? '#dc3545' : '#134E5E' ?>"></i>
                </div>
                <div>
                    <div class="stat-v" style="color:<?= ($dueSoon ?? 0) > 0 ? '#dc3545' : 'inherit' ?>"><?= $dueSoon ?? 0 ?></div>
                    <div class="stat-l">Due This Month</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Width Clinic Image -->
    <div class="clinic-image-panel" style="min-height: 280px;">
        <img
            src="https://t4.ftcdn.net/jpg/07/63/82/49/360_F_763824918_0DC9niVcINfJJ3g0JON4iPukdkrNXIq7.jpg"
            alt="Veterinary clinic"
            onerror="this.style.display='none'"
        >
        <div class="clinic-image-overlay">
            <h6><i class="bi bi-heart-pulse-fill me-2"></i>PetCare Veterinary Clinic</h6>
            <p>Caring for every paw, claw, and tail — every single day.</p>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>