<?php
if (isset($_SESSION['user'])) {
    header("Location: ?controller=owner&action=index");
    exit;
}

require_once BASE_PATH . '/app/core/Flash.php';
ob_start();
?>

<div class="auth-card">
    <div class="auth-banner">
        <div class="brand-icon">
            <i class="bi bi-heart-pulse-fill text-white"></i>
        </div>
        <h3>PetCare Clinic</h3>
        <p>Staff Login — Pet Medical Record & Vaccination Monitoring System</p>
    </div>

    <div class="auth-body">

        <?php foreach (Flash::get('error') as $msg): ?>
            <div class="alert alert-danger mb-3">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" action="?controller=auth&action=login">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required
                        autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" id="loginPassword" class="form-control"
                        placeholder="Enter password" required>
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="togglePassword('loginPassword', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-auth">
                <i class="bi bi-box-arrow-in-right"></i> Sign In
            </button>
        </form>

        <p class="auth-link">
            Don't have an account?
            <a href="?controller=registration&action=create">Create Staff Account</a>
        </p>
    </div>
</div>

<script>
    function togglePassword(id, btn) {
        const field = document.getElementById(id);
        const icon = btn.querySelector("i");

        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            field.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>

<?php
$content = ob_get_clean();
$pageTitle = 'Login — PetCare Clinic';
require __DIR__ . '/auth_layout.php';
?>