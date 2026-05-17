<?php $pageTitle = 'Pet Profile';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row g-3">
  <div class="col-12 col-md-4">
    <div class="panel panel-bd">
      <div class="text-center mb-3">
        <?php $icon = ['dog' => '🐶', 'cat' => '🐱'][$pet['pet_species']] ?? '🐾'; ?>
        <div style="font-size:52px;"><?= $icon ?></div>
        <h5 class="fw-bold mb-0"><?= htmlspecialchars($pet['pet_name']) ?></h5>
        <span class="badge badge-<?= $pet['pet_species'] ?>"><?= htmlspecialchars($pet['pet_species']) ?></span>
        <span class="badge badge-<?= $pet['pet_status'] ?> ms-1"><?= htmlspecialchars($pet['pet_status']) ?></span>
      </div>
      <hr>
      <div class="row g-2 text-center">
        <div class="col-6">
          <div class="text-muted small">Breed</div>
          <strong><?= htmlspecialchars($pet['pet_breed'] ?? '—') ?></strong>
        </div>
        <div class="col-6">
          <div class="text-muted small">Age</div>
          <strong><?= $pet['pet_age'] ? $pet['pet_age'] . ' yrs' : '—' ?></strong>
        </div>
        <div class="col-6">
          <div class="text-muted small">Weight</div>
          <strong><?= $pet['pet_weight'] ? $pet['pet_weight'] . ' kg' : '—' ?></strong>
        </div>
      </div>
      <hr>
      <div class="mb-1"><span class="text-muted small">Owner</span></div>
      <a href="?controller=owner&action=show&id=<?= $pet['owner_id'] ?>" class="fw-semibold text-decoration-none">
        <?= htmlspecialchars($pet['owner_name']) ?>
      </a>
      <div class="text-muted"><?= htmlspecialchars($pet['owner_contact_no'] ?? '') ?></div>
      <div class="d-flex gap-2 mt-3">
        <a href="?controller=pet&action=edit&id=<?= $pet['pet_id'] ?>" class="btn btn-sm btn-warning w-100"><i
            class="bi bi-pencil"></i> Edit</a>
        <a href="?controller=pet&action=index" class="btn btn-sm btn-outline-secondary w-100">Back</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-8">
    <div class="panel">
      <div class="panel-hd">
        <h6><i class="bi bi-clipboard2-pulse-fill me-2 text-success"></i>Vaccination History</h6>

      </div>
      <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
          <thead class="table-light">
            <tr>
              <th>Vaccine</th>
              <th>Form</th>
              <th>Date Given</th>
              <th>Dosage</th>
              <th>Next Dose</th>
              <th>Staff</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($records)): ?>
              <tr>
                <td colspan="7" class="text-center text-muted py-4">No vaccination records.</td>
              </tr>
            <?php else:
              foreach ($records as $r): ?>
                <tr>
                  <td class="fw-semibold"><?= htmlspecialchars($r['vaccine_name']) ?></td>
                  <td><?= htmlspecialchars($r['vaccine_form'] ?? '—') ?></td>
                  <td><?= htmlspecialchars($r['date_administer']) ?></td>
                  <td><?= $r['dosage'] ?? '—' ?></td>
                  <td>
                    <?php if ($r['next_dose']): ?>
                      <span class="badge bg-warning text-dark"><?= htmlspecialchars($r['next_dose']) ?></span>
                    <?php else: ?>—<?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($r['staff_name']) ?></td>

                </tr>
              <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>