<?php
$pageTitle = 'Edit Pet';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="form-card">
            <div class="fc-title">
                <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Pet
            </div>

            <form method="POST" action="?controller=pet&action=update&id=<?= $pet['pet_id'] ?? $pet['id'] ?>">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Owner <span class="text-danger">*</span></label>
                        <select name="owner_id" class="form-select" required>
                            <option value="">— Select Owner —</option>
                            <?php foreach ($owners as $o): ?>
                                <option value="<?= $o['owner_id'] ?>" <?= ($o['owner_id'] == $pet['owner_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($o['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pet Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                            value="<?= htmlspecialchars($pet['pet_name'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Age (years)</label>
                        <input type="number" name="age" class="form-control" value="<?= $pet['pet_age'] ?? '' ?>"
                            min="0">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Weight (kg)</label>
                        <input type="number" step="0.01" name="weight" class="form-control"
                            value="<?= $pet['pet_weight'] ?? '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Species <span class="text-danger">*</span></label>
                        <select name="species" class="form-select" required>
                            <?php foreach (['dog', 'cat'] as $sp): ?>
                                <option value="<?= $sp ?>" <?= strtolower($pet['pet_species'] ?? '') === $sp ? 'selected' : '' ?>>
                                    <?= ucfirst($sp) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Breed</label>
                        <input type="text" name="breed" class="form-control"
                            value="<?= htmlspecialchars($pet['pet_breed'] ?? '') ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <?php foreach (['active', 'inactive', 'deceased'] as $st): ?>
                                <option value="<?= $st ?>" <?= strtolower($pet['pet_status'] ?? '') === $st ? 'selected' : '' ?>>
                                    <?= ucfirst($st) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Update Pet
                    </button>
                    <a href="?controller=pet&action=index" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>