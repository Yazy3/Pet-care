<?php $pageTitle = 'Vaccines';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="panel">
            <div class="panel-hd">
                <h6><i class="bi bi-shield-fill-plus me-2 text-primary"></i>Vaccine List</h6>
                <a href="?controller=vaccine&action=create" class="btn btn-sm btn-success"><i class="bi bi-plus-lg"></i>
                    Add Vaccine</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 dt-table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Vaccine Name</th>
                            <th>Form</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($vaccines)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No vaccines found.</td>
                            </tr>
                        <?php else:
                            foreach ($vaccines as $v): ?>
                                <tr>
                                    <td><?= $v['vaccine_id'] ?></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($v['vaccine_name']) ?></td>
                                    <td><span
                                            class="badge bg-secondary"><?= htmlspecialchars($v['vaccine_form'] ?? '—') ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="?controller=vaccine&action=edit&id=<?= $v['vaccine_id'] ?>"
                                            class="btn btn-sm btn-outline-warning py-0"><i class="bi bi-pencil"></i></a>
                                        <a href="?controller=vaccine&action=delete&id=<?= $v['vaccine_id'] ?>"
                                            class="btn btn-sm btn-outline-danger  py-0"
                                            onclick="return confirm('Delete this vaccine?')"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="form-card">
            <div class="fc-title"><i class="bi bi-plus-circle me-2 text-success"></i>Quick Add Vaccine</div>
            <form method="POST" action="?controller=vaccine&action=store">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Vaccine Name <span class="text-danger">*</span></label>
                    <input type="text" name="vaccine_name" class="form-control" placeholder="e.g. Rabies" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Form <span class="text-danger">*</span></label>
                    <select name="vaccine_form" class="form-select" required>
                        <option value="">— Select —</option>
                        <option value="injectable">Injectable</option>
                        <option value="tablet">Tablet</option>
                        <option value="syrup">Syrup</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100"><i class="bi bi-check-lg me-1"></i>Save</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>