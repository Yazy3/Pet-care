<?php
$pageTitle = 'Vaccination Records';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="d-flex justify-content-between align-items-start align-items-sm-center flex-wrap gap-2 mb-4">
    <h5 class="fw-bold mb-0"><i class="bi bi-clipboard2-pulse-fill me-2" style="color:var(--sacc)"></i>Vaccination Records</h5>
    <a href="?controller=records&action=create" class="btn btn-success btn-sm flex-shrink-0">
        <i class="bi bi-plus-lg me-1"></i>New Record
    </a>
</div>

<div class="panel">
    <div class="panel-hd">
        <h6><i class="bi bi-list-ul me-1"></i>Record List</h6>
    </div>
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
                        <i class="bi bi-inbox display-4 d-block mb-3"></i>
                        No records yet.
                    </td>
                </tr>
                <?php else: foreach ($records as $r): 
                    $nextDose = $r['next_dose'] ?? null;
                    $isOverdue = $nextDose && $nextDose < date('Y-m-d');
                    $isDueSoon = $nextDose && !$isOverdue && $nextDose <= date('Y-m-d', strtotime('+30 days'));
                ?>
                <tr>
                    <td class="text-muted" style="font-size:12px"><?= $r['record_id'] ?? '' ?></td>
                    <td>
                        <a href="?controller=pet&action=show&id=<?= $r['pet_id'] ?? '' ?>" class="fw-semibold text-decoration-none" style="color:var(--sbg)">
                            <?= htmlspecialchars($r['pet_name'] ?? '') ?>
                        </a>
                    </td>
                    <td><i class="bi bi-person me-1 text-muted"></i><?= htmlspecialchars($r['owner_name'] ?? '—') ?></td>
                    <td>
                        <div class="fw-semibold"><?= htmlspecialchars($r['vaccine_name'] ?? '') ?></div>
                        <?php if (!empty($r['vaccine_form'])): ?>
                        <small class="text-muted"><?= htmlspecialchars($r['vaccine_form']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($r['date_administer'] ?? '—') ?></td>
                    <td><?= $r['dosage'] ?? '—' ?></td>
                    <td>
                        <?php if ($nextDose): ?>
                            <?php if ($isOverdue): ?>
                            <span class="badge bg-danger"><?= htmlspecialchars($nextDose) ?></span>
                            <div style="font-size:10px;color:#dc3545">Overdue</div>
                            <?php elseif ($isDueSoon): ?>
                            <span class="badge bg-warning text-dark"><?= htmlspecialchars($nextDose) ?></span>
                            <div style="font-size:10px;color:#b45309">Due Soon</div>
                            <?php else: ?>
                            <span class="badge badge-active"><?= htmlspecialchars($nextDose) ?></span>
                            <?php endif; ?>
                        <?php else: ?>—<?php endif; ?>
                    </td>
                    <td><i class="bi bi-person-badge me-1 text-muted"></i><?= htmlspecialchars($r['staff_name'] ?? '—') ?></td>
                    <td class="text-center">
                        <a href="?controller=records&action=edit&id=<?= $r['record_id'] ?? '' ?>" class="btn btn-sm btn-outline-warning py-0 me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                        <a href="?controller=records&action=delete&id=<?= $r['record_id'] ?? '' ?>" class="btn btn-sm btn-outline-danger py-0" onclick="confirmDelete(this.href, 'Delete this record?'); return false;" title="Delete"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>