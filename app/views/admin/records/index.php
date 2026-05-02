<!-- Page to view the Vaccination Record !-->

<?php $pageTitle = 'Vaccination Records';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="panel">
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Pet</th>
                    <th>Owner</th>
                    <th>Vaccine</th>
                    <th>Date Given</th>
                    <th>Dosage</th>
                    <th>Next Dose</th>
                    <th>Staff</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($records)): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">No records yet.</td>
                </tr>
                <?php else:
          foreach ($records as $r): ?>
                <tr>
                    <td><?= $r['record_id'] ?></td>
                    <td>
                        <a href="?controller=pet&action=show&id=<?= $r['pet_id'] ?>"
                            class="fw-semibold text-decoration-none">
                            <?= htmlspecialchars($r['pet_name']) ?>
                        </a>
                        <div><span class="badge badge-<?= $r['pet_species'] ?>"><?= $r['pet_species'] ?></span></div>
                    </td>
                    <td><?= htmlspecialchars($r['owner_name']) ?></td>
                    <td>
                        <div class="fw-semibold"><?= htmlspecialchars($r['vaccine_name']) ?></div>
                        <small class="text-muted"><?= htmlspecialchars($r['vaccine_form'] ?? '') ?></small>
                    </td>
                    <td><?= htmlspecialchars($r['date_administer']) ?></td>
                    <td><?= $r['dosage'] ?? '—' ?></td>
                    <td>
                        <?php if ($r['next_dose']): ?>
                        <span class="badge bg-warning text-dark"><?= htmlspecialchars($r['next_dose']) ?></span>
                        <?php else: ?>—<?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($r['staff_name']) ?></td>
                    <td class="text-center">
                        <a href="?controller=record&action=show&id=<?= $r['record_id'] ?>"
                            class="btn btn-sm btn-outline-info    py-0"><i class="bi bi-eye"></i></a>
                        <a href="?controller=record&action=edit&id=<?= $r['record_id'] ?>"
                            class="btn btn-sm btn-outline-warning  py-0"><i class="bi bi-pencil"></i></a>
                        <a href="?controller=record&action=delete&id=<?= $r['record_id'] ?>"
                            class="btn btn-sm btn-outline-danger   py-0"
                            onclick="return confirm('Delete this record?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>