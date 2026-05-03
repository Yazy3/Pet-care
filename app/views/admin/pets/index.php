<?php
$pageTitle = 'Pets';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="bi bi-paw-fill text-warning me-2"></i>
            Pets
        </h2>

    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">

        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
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
                            <td>
                                <?= $p['pet_id'] ?? '' ?>
                            </td>
                            <td class="fw-semibold">
                                <?= htmlspecialchars($p['pet_name'] ?? '') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($p['pet_species'] ?? '') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($p['pet_breed'] ?? '—') ?>
                            </td>
                            <td>
                                <?= $p['pet_age'] ? $p['pet_age'] . ' yrs' : '—' ?>
                            </td>
                            <td>
                                <?= $p['pet_weight'] ? $p['pet_weight'] . ' kg' : '—' ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($p['owner_name'] ?? '—') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($p['pet_status'] ?? '') ?>
                            </td>
                            <td class="text-center">
                                <a href="?controller=pet&action=show&id=<?= $p['pet_id'] ?? '' ?>"
                                    class="btn btn-sm btn-outline-info py-0"><i class="bi bi-eye"></i></a>
                                <a href="?controller=pet&action=edit&id=<?= $p['pet_id'] ?? '' ?>"
                                    class="btn btn-sm btn-outline-warning py-0"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>