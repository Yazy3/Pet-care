<?php
$pageTitle = 'Vaccination Schedule';
require __DIR__ . '/../../layouts/layout.php';
?>

<?php if (!empty($overdue)): ?>
    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <strong><?= count($overdue) ?> overdue vaccination(s)</strong> — please contact pet owners immediately.
    </div>
<?php endif; ?>

<div class="row g-3">

    <div class="col-12 col-xl-6">
        <div class="panel">
            <div class="panel-hd">
                <h6><i class="bi bi-exclamation-circle-fill me-2 text-danger"></i>Overdue</h6>
                <span class="badge bg-danger"><?= count($overdue) ?></span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 dt-table">
                    <thead class="table-light">
                        <tr>
                            <th>Pet</th>
                            <th>Vaccine</th>
                            <th>Due Date</th>
                            <th>Owner Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($overdue)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No overdue vaccinations. 🎉</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($overdue as $r): ?>
                                <tr>
                                    <td>
                                        <a href="?controller=pet&action=show&id=<?= $r['pet_id'] ?>"
                                            class="fw-semibold text-decoration-none">
                                            <?= htmlspecialchars($r['pet_name'] ?? '') ?>
                                        </a>
                                        <div><span
                                                class="badge badge-<?= htmlspecialchars($r['pet_species'] ?? '') ?>"><?= htmlspecialchars($r['pet_species'] ?? '') ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($r['vaccine_name'] ?? '') ?></td>
                                    <td><span class="badge bg-danger"><?= htmlspecialchars($r['next_dose'] ?? '') ?></span></td>
                                    <td><?= htmlspecialchars($r['owner_contact_no'] ?? '—') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="panel">
            <div class="panel-hd">
                <h6><i class="bi bi-bell-fill me-2 text-warning"></i>Due</h6>
                <span class="badge bg-warning text-dark"><?= count($dueSoon) ?></span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 dt-table">
                    <thead class="table-light">
                        <tr>
                            <th>Pet</th>
                            <th>Vaccine</th>
                            <th>Due Date</th>
                            <th>Owner Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dueSoon)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No upcoming vaccinations.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($dueSoon as $r): ?>
                                <tr>
                                    <td>
                                        <a href="?controller=pet&action=show&id=<?= $r['pet_id'] ?>"
                                            class="fw-semibold text-decoration-none">
                                            <?= htmlspecialchars($r['pet_name'] ?? '') ?>
                                        </a>
                                        <div><span
                                                class="badge badge-<?= htmlspecialchars($r['pet_species'] ?? '') ?>"><?= htmlspecialchars($r['pet_species'] ?? '') ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($r['vaccine_name'] ?? '') ?></td>
                                    <td><span
                                            class="badge bg-warning text-dark"><?= htmlspecialchars($r['next_dose'] ?? '') ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($r['owner_contact_no'] ?? '—') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>