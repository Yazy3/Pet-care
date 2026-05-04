<?php
$pageTitle = 'Edit Record';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="form-card">
            <div class="fc-title">
                <i class="bi bi-pencil-square me-2 text-warning"></i>
                Edit Vaccination Record
            </div>

            <form method="POST" action="?controller=records&action=update&id=<?= $record['record_id'] ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pet <span class="text-danger">*</span></label>
                        <select name="pet_id" class="form-select" required>
                            <option value=""> Select Pet </option>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['pet_id'] ?>" <?= $p['pet_id'] == $record['pet_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($p['label']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Vaccine <span class="text-danger">*</span></label>
                        <select name="vaccine_id" class="form-select" required>
                            <option value="">— Select Vaccine —</option>
                            <?php foreach ($vaccines as $v): ?>
                                <option value="<?= $v['vaccine_id'] ?>" <?= $v['vaccine_id'] == $record['vaccine_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($v['label']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Date Administered <span
                                class="text-danger">*</span></label>
                        <input type="date" name="date_administer" class="form-control"
                            value="<?= htmlspecialchars($record['date_administer'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dosage</label>
                        <input type="number" name="dosage" class="form-control" value="<?= $record['dosage'] ?? '' ?>"
                            min="0" step="0.01">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Next Dose Date</label>
                        <input type="date" name="next_dose" class="form-control"
                            value="<?= htmlspecialchars($record['next_dose'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Administered By (Staff) <span
                                class="text-danger">*</span></label>
                        <select name="staff_id" class="form-select" required>
                            <option value="">— Select Staff —</option>
                            <?php foreach ($staffs as $s): ?>
                                <option value="<?= $s['staff_id'] ?>" <?= $s['staff_id'] == $record['staff_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['staff_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Update Record
                    </button>
                    <a href="?controller=records&action=index" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>