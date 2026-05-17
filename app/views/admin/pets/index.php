<?php
$pageTitle = 'Pets';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="d-flex justify-content-between align-items-start align-items-sm-center flex-wrap gap-2 mb-4">
    <h5 class="fw-bold mb-0"><i class="bi bi-paw-fill me-2" style="color:var(--sacc)"></i>Pets</h5>
</div>

<div class="panel">
    <div class="panel-hd">
        <h6><i class="bi bi-list-ul me-1"></i>Pet List</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pets)): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                            No pets found.
                        </td>
                    </tr>
                <?php else:
                    foreach ($pets as $p): ?>
                        <tr>
                            <td class="text-muted" style="font-size:12px"><?= $p['pet_id'] ?? '' ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($p['pet_name'] ?? '') ?></td>
                            <td>
                                <span class="badge badge-<?= $p['pet_species'] ?? 'other' ?>">
                                    <i class="bi bi-<?= ($p['pet_species'] ?? '') === 'dog' ? 'joystick' : 'stars' ?> me-1"></i>
                                    <?= ucfirst(htmlspecialchars($p['pet_species'] ?? '')) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($p['pet_breed'] ?? '—') ?></td>
                            <td><?= $p['pet_age'] ? $p['pet_age'] . ' yr' . ($p['pet_age'] > 1 ? 's' : '') : '—' ?></td>
                            <td><?= $p['pet_weight'] ? $p['pet_weight'] . ' kg' : '—' ?></td>
                            <td>
                                <i class="bi bi-person me-1 text-muted"></i><?= htmlspecialchars($p['owner_name'] ?? '—') ?>
                            </td>
                            <td>
                                <span class="badge badge-<?= $p['pet_status'] ?? 'other' ?>">
                                    <?= ucfirst(htmlspecialchars($p['pet_status'] ?? '')) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="?controller=pet&action=show&id=<?= $p['pet_id'] ?? '' ?>"
                                    class="btn btn-sm btn-outline-info py-0" title="View"><i class="bi bi-eye"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>