<?php
$pageTitle = 'Add New Pet';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="panel">
            <div class="panel-hd">
                <h6><i class="bi bi-plus-circle-fill me-2 text-success"></i>Add New Pet</h6>
            </div>
            <div class="panel-bd">

                <?php if (isset($owner) && $owner): ?>
                <div class="alert alert-info">
                    <strong>Adding pet for:</strong>
                    <?= htmlspecialchars($owner['owner_first_name'] . ' ' . $owner['owner_last_name']) ?>
                    <?php if (!empty($owner['owner_suffix'])): ?>
                    <?= htmlspecialchars($owner['owner_suffix']) ?>
                    <?php endif; ?>
                    <br>
                    <strong>Contact:</strong> <?= htmlspecialchars($owner['owner_contact_no'] ?? '—') ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="?controller=pet&action=store">
                    <input type="hidden" name="owner_id" value="<?= $owner['owner_id'] ?? '' ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pet Name <span class="text-danger">*</span></label>
                            <input type="text" name="pet_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Species <span class="text-danger">*</span></label>
                            <select name="pet_species" class="form-select" required>
                                <option value="">Select Species</option>
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Breed</label>
                            <input type="text" name="pet_breed" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Age (years)</label>
                            <input type="number" name="pet_age" class="form-control" min="0">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Weight (kg)</label>
                            <input type="number" step="0.01" name="pet_weight" class="form-control" min="0">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="pet_status" class="form-select">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deceased">Deceased</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Save Pet
                        </button>
                        <a href="?controller=owner&action=show&id=<?= $owner['owner_id'] ?? '' ?>"
                            class="btn btn-secondary btn-lg">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>