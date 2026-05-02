<?php
if (isset($_SESSION['user'])) {
    header("Location: ?controller=owner&action=index");
    exit;
}

require_once BASE_PATH . '/app/core/Flash.php';
ob_start();
?>

<?php foreach (Flash::get('error') as $msg): ?>
    <div class="alert alert-danger mb-3">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endforeach; ?>

<?php foreach (Flash::get('success') as $msg): ?>
    <div class="alert alert-success mb-3">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endforeach; ?>

<h2>Create Account</h2>
<p class="subtitle">Register to access the clinic management system</p>

<form method="POST" action="?controller=registration&action=store">

    <div class="mb-3">
        <label class="form-label">Staff Name</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>
            <input type="text" name="staff_name" class="form-control" placeholder="Enter staff name" required autofocus>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-at"></i>
            </span>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-lock"></i>
            </span>
            <input type="password" name="password" id="registerPassword" class="form-control"
                placeholder="Create password" required>
            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('registerPassword', this)">
                <i class="bi bi-eye"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn-auth">
        <i class="bi bi-person-check"></i> Create Account
    </button>
</form>

<p class="auth-link">
    Already have an account?
    <a href="?controller=auth&action=index">Sign in here</a>
</p>

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
$pageTitle = 'Register — PetCare Clinic';
require __DIR__ . '/../auth/auth_layout.php';
?>