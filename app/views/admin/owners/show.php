<?php $pageTitle = 'Owner Profile';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row g-3">
    <div class="col-12 col-md-4">
        <div class="panel panel-bd">
            <div class="text-center mb-3">
                <div class="stat-i mx-auto mb-2"
                    style="width:60px;height:60px;font-size:28px;border-radius:50%;background:#dbeafe;color:#1d4ed8;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <h5 class="mb-0 fw-bold">
                    <?= htmlspecialchars($owner['owner_first_name'] . ' ' . $owner['owner_last_name']) ?>
                    <?php if ($owner['owner_suffix']): ?><small
                            class="text-muted"><?= htmlspecialchars($owner['owner_suffix']) ?></small><?php endif; ?>
                </h5>
                <div class="text-muted"><?= htmlspecialchars($owner['sex'] ?? '') ?></div>
            </div>
            <hr>
            <div class="mb-2"><span class="text-muted small">Contact
                    No.</span><br><strong><?= htmlspecialchars($owner['owner_contact_no'] ?? '—') ?></strong></div>
            <div class="d-flex gap-2 mt-3">
                <a href="?controller=owner&action=edit&id=<?= $owner['owner_id'] ?>"
                    class="btn btn-sm btn-warning w-100"><i class="bi bi-pencil"></i> Edit</a>
                <a href="?controller=owner&action=index" class="btn btn-sm btn-outline-secondary w-100">Back</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div class="panel-hd">
            <h6><i class="bi bi-paw-fill me-2 text-success"></i>Pets (<?= count($pets) ?>)</h6>
            <a href="?controller=pet&action=create&owner_id=<?= $owner['owner_id'] ?>" class="btn btn-sm btn-success">
                <i class="bi bi-plus-lg"></i> Add Pet
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pets)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No pets registered.</td>
                        </tr>
                    <?php else:
                        foreach ($pets as $p): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($p['pet_name']) ?></td>
                                <td><span
                                        class="badge badge-<?= $p['pet_species'] ?>"><?= htmlspecialchars($p['pet_species']) ?></span>
                                </td>
                                <td><?= htmlspecialchars($p['pet_breed'] ?? '—') ?></td>
                                <td><?= $p['pet_age'] ? $p['pet_age'] . ' yrs' : '—' ?></td>
                                <td><span
                                        class="badge badge-<?= $p['pet_status'] ?>"><?= htmlspecialchars($p['pet_status']) ?></span>
                                </td>
                                <td><a href="?controller=pet&action=show&id=<?= $p['pet_id'] ?>"
                                        class="btn btn-sm btn-outline-info py-0"><i class="bi bi-eye"></i></a></td>
                            </tr>
                        <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>