<?php $pageTitle = 'Add New Vaccine';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-5">
        <div class="form-card">
            <div class="fc-title"><i class="bi bi-plus-circle me-2 text-success"></i>Add New Vaccine</div>
            <form method="POST" action="?controller=vaccine&action=store">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Vaccine Name <span class="text-danger">*</span></label>
                    <input type="text" name="vaccine_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Vaccine Type <span class="text-danger">*</span></label>
                    <select name="vaccine_type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="anti rabies">Anti Rabies</option>
                        <option value="deworm">Deworm</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Form</label>
                    <select name="vaccine_form" class="form-select">
                        <option value="">Select Form</option>
                        <?php foreach (['injectable', 'tablet', 'syrup'] as $f): ?>
                        <option value="<?= $f ?>">
                            <?= ucfirst($f) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i>Save Vaccine
                    </button>
                    <a href="?controller=vaccine&action=index" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>