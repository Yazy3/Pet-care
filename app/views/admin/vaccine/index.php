<?php $pageTitle = 'Vaccines';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="d-flex justify-content-between align-items-start align-items-sm-center flex-wrap gap-2 mb-4">
    <h5 class="fw-bold mb-0"><i class="bi bi-shield-fill-plus me-2" style="color:var(--sacc)"></i>Vaccines</h5>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="panel">
            <div class="panel-hd">
                <h6><i class="bi bi-list-ul me-1"></i>Vaccine List</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 dt-table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Vaccine Name</th>
                            <th>Type</th>
                            <th>Form</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($vaccines)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No vaccines found.</td>
                        </tr>
                        <?php else: foreach ($vaccines as $v): ?>
                        <tr>
                            <td class="text-muted" style="font-size:12px"><?= $v['vaccine_id'] ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($v['vaccine_name']) ?></td>
                            <td>
                                <?php
                                $type = $v['vaccine_type'] ?? '';
                                $typeBg = $type === 'anti rabies' ? 'background:#134E5E;color:#fff' : 'background:#D8F4F2;color:#134E5E';
                                ?>
                                <span class="badge" style="<?= $typeBg ?>">
                                    <?= ucwords(htmlspecialchars($type)) ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                $form = $v['vaccine_form'] ?? '';
                                $formIcon = match($form) {
                                    'injectable' => 'bi-capsule',
                                    'tablet'     => 'bi-tablet',
                                    'syrup'      => 'bi-droplet-fill',
                                    default      => 'bi-question-circle'
                                };
                                ?>
                                <span class="badge badge-active">
                                    <i class="bi <?= $formIcon ?> me-1"></i><?= ucfirst(htmlspecialchars($form ?: '—')) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="?controller=vaccine&action=edit&id=<?= $v['vaccine_id'] ?>" class="btn btn-sm btn-outline-warning py-0 me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                                <a href="?controller=vaccine&action=delete&id=<?= $v['vaccine_id'] ?>" class="btn btn-sm btn-outline-danger py-0" onclick="confirmDelete(this.href, 'Delete this vaccine?'); return false;" title="Delete"><i class="bi bi-trash"></i></a>
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
            <div class="fc-title"><i class="bi bi-plus-circle me-2" style="color:var(--sacc)"></i>Add Vaccine</div>
            <form method="POST" action="?controller=vaccine&action=store">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Vaccine Name <span class="text-danger">*</span></label>
                    <input type="text" name="vaccine_name" class="form-control" placeholder="e.g. Nobivac" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                    <select name="vaccine_type" class="form-select" required>
                        <option value="">— Select Type —</option>
                        <option value="anti rabies">Anti Rabies</option>
                        <option value="deworm">Deworm</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Form</label>
                    <select name="vaccine_form" class="form-select">
                        <option value="">— Select Form —</option>
                        <option value="injectable">Injectable</option>
                        <option value="tablet">Tablet</option>
                        <option value="syrup">Syrup</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-check-lg me-1"></i>Save Vaccine
                </button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>