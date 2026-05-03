<?php
$pageTitle = 'Vaccination Records';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="bi bi-clipboard2-pulse-fill text-success me-2"></i>
            Vaccination Records
        </h2>
        <a href="?controller=records&action=create" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> New Record
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <strong>Record List</strong>
        </div>

        <div class="card-body p-0">
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
                                <td colspan="9" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox display-4 d-block mb-3 text-secondary"></i>
                                    No records yet.
                                </td>
                            </tr>
                        <?php else:
                            foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r['record_id'] ?? '' ?></td>
                                    <td>
                                        <a href="?controller=pet&action=show&id=<?= $r['pet_id'] ?? '' ?>"
                                            class="fw-semibold text-decoration-none">
                                            <?= htmlspecialchars($r['pet_name'] ?? '') ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($r['owner_name'] ?? '—') ?></td>
                                    <td>
                                        <div class="fw-semibold">
                                            <?= htmlspecialchars($r['vaccine_name'] ?? '') ?>
                                        </div>
                                        <?php if (!empty($r['vaccine_form'])): ?>
                                            <small class="text-muted">
                                                <?= htmlspecialchars($r['vaccine_form']) ?>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($r['date_administer'] ?? '') ?></td>
                                    <td><?= $r['dosage'] ?? '—' ?></td>
                                    <td>
                                        <?php if ($r['next_dose']): ?>
                                            <span class="badge bg-warning text-dark">
                                                <?= htmlspecialchars($r['next_dose']) ?>
                                            </span>
                                        <?php else: ?>—<?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($r['staff_name'] ?? '—') ?></td>
                                    <td class="text-center">
                                        <!-- Eye button removed -->
                                        <a href="?controller=records&action=edit&id=<?= $r['record_id'] ?? '' ?>"
                                            class="btn btn-sm btn-outline-warning me-1" title="Edit Record">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="?controller=records&action=delete&id=<?= $r['record_id'] ?? '' ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this record?')" title="Delete Record">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>