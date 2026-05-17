<?php
if (isset($_SESSION['user'])) {
    header("Location: ?controller=auth&action=index");
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
        <p>Create New Account</p>
    </div>

    <div class="auth-body">
        <?php foreach (Flash::get('error') as $msg): ?>
            <div class="alert alert-danger mb-3"><?= htmlspecialchars($msg) ?></div>
        <?php endforeach; ?>

        <div class="d-flex justify-content-center mb-4 gap-2">
            <button onclick="showForm('staff')" class="btn btn-outline-secondary" id="staff-btn">Staff
                Registration</button>
            <button onclick="showForm('owner')" class="btn btn-outline-success" id="owner-btn">Pet Owner
                Registration</button>
        </div>

        <!-- STAFF FORM -->
        <form id="staff-form" method="POST" action="?controller=registration&action=store">
            <div class="mb-3">
                <label class="form-label">Staff Name <span class="text-danger">*</span></label>
                <input type="text" name="staff_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="staffPassword" class="form-control" required minlength="6">
            </div>
            <button type="submit" class="btn-auth">Create Staff Account</button>
        </form>

        <!-- OWNER FORM -->
        <form id="owner-form" method="POST" action="?controller=ownerregistration&action=store" style="display:none;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="owner_first_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="owner_last_name" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Suffix (Optional)</label>
                <input type="text" name="owner_suffix" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sex <span class="text-danger">*</span></label>
                    <select name="sex" class="form-control" required>
                        <option value="">Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                    <input type="text" name="owner_contact_no" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="ownerPassword" class="form-control" required minlength="6">
            </div>
            <button type="submit" class="btn-auth">Create Pet Owner Account</button>
        </form>

        <p class="auth-link mt-4 text-center">
            Already have an account? <a href="?controller=auth&action=index" class="text-success fw-semibold">Sign in here</a>
        </p>
    </div>
</div>

<script>
    function showForm(type) {
        document.getElementById('staff-form').style.display = type === 'staff' ? 'block' : 'none';
        document.getElementById('owner-form').style.display = type === 'owner' ? 'block' : 'none';
        document.getElementById('staff-btn').classList.toggle('active', type === 'staff');
        document.getElementById('owner-btn').classList.toggle('active', type === 'owner');
    }

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

    window.onload = () => showForm('staff');
</script>

<?php
$content = ob_get_clean();
$pageTitle = 'Create Account — PetCare Clinic';
require __DIR__ . '/../auth/auth_layout.php';
?>