<?php $pageTitle =
    'Edit Owner';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="form-card">
            <div class="fc-title"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Owner</div>
            <form method="POST" action="?controller=owner&action=update&id=<?= $owner['owner_id'] ?>">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="owner_first_name" class="form-control"
                            value="<?= htmlspecialchars($owner['owner_first_name']) ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="owner_last_name" class="form-control"
                            value="<?= htmlspecialchars($owner['owner_last_name']) ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Suffix</label>
                        <input type="text" name="owner_suffix" class="form-control"
                            value="<?= htmlspecialchars($owner['owner_suffix'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Sex</label>
                        <select name="sex" class="form-select">
                            <option value="">— Select —</option>
                            <option value="Male" <?= ($owner['sex'] ?? '') === 'Male' ? 'selected' : '' ?>>Male
                            </option>
                            <option value="Female" <?= ($owner['sex'] ?? '') === 'Female' ? 'selected' : '' ?>>Female
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Contact Number</label>
                        <input type="text" name="owner_contact_no" class="form-control"
                            value="<?= htmlspecialchars($owner['owner_contact_no'] ?? '') ?>">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-check-lg me-1"></i>Update
                        Owner</button>
                    <a href="?controller=owner&action=index" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>