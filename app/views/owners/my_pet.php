<?php
$pageTitle = 'My Pets';
require __DIR__ . '/../layouts/owner_layout.php';
?>

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="bi bi-paw-fill me-2" style="color:var(--sacc)"></i>My Pets</h5>
    </div>

    <!-- Table -->
    <div class="panel">
        <div class="panel-hd">
            <h6><i class="bi bi-list-ul me-1"></i> Pet List</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pets)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                            No pets registered yet.
                        </td>
                    </tr>
                    <?php else: foreach ($pets as $p): ?>
                    <tr>
                        <td><?= $p['pet_id'] ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($p['pet_name']) ?></td>
                        <td>
                            <span class="badge badge-<?= $p['pet_species'] ?>">
                                <?= ucfirst(htmlspecialchars($p['pet_species'] ?? '')) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($p['pet_breed'] ?? '—') ?></td>
                        <td><?= $p['pet_age'] ? $p['pet_age'] . ' yr' . ($p['pet_age'] > 1 ? 's' : '') : '—' ?></td>
                        <td><?= $p['pet_weight'] ? $p['pet_weight'] . ' kg' : '—' ?></td>
                        <td>
                            <span class="badge badge-<?= $p['pet_status'] ?>">
                                <?= ucfirst($p['pet_status'] ?? '') ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../layouts/owner_footer.php'; ?>