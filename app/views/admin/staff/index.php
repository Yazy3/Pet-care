<?php $pageTitle = 'Edit Vaccine'; require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row justify-content-center">
  <div class="col-12 col-lg-5">
    <div class="form-card">
      <div class="fc-title"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Vaccine</div>
      <form method="POST" action="?controller=vaccine&action=update&id=<?= $vaccine['vaccine_id'] ?>">
        <div class="mb-3">
          <label class="form-label fw-semibold">Vaccine Name <span class="text-danger">*</span></label>
          <input type="text" name="vaccine_name" class="form-control" value="<?= htmlspecialchars($vaccine['vaccine_name']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Form</label>
          <select name="vaccine_form" class="form-select">
            <option value="">— Select —</option>
            <?php foreach(['injectable','tablet','syrup'] as $f): ?>
              <option value="<?= $f ?>" <?= ($vaccine['vaccine_form'] ?? '') === $f ? 'selected' : '' ?>><?= ucfirst($f) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-warning"><i class="bi bi-check-lg me-1"></i>Update</button>
          <a href="?controller=vaccine&action=index" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>