<?php
$pageTitle = 'Owners';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="d-flex justify-content-between align-items-start align-items-sm-center flex-wrap gap-2 mb-4">
    <h5 class="fw-bold mb-0"><i class="bi bi-people-fill me-2" style="color:var(--sacc)"></i>Owners</h5>
    <a href="?controller=owner&action=create" class="btn btn-success btn-sm flex-shrink-0">
        <i class="bi bi-plus-lg me-1"></i>Add Owner
    </a>
</div>

<div class="panel">
    <div class="panel-hd">
        <h6><i class="bi bi-list-ul me-1"></i>Owner List</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Contact</th>
                    <th>Pets</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($owners)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-inbox display-4 d-block mb-3"></i>
                        No owners found.
                    </td>
                </tr>
                <?php else: foreach ($owners as $o): ?>
                <tr>
                    <td class="text-muted" style="font-size:12px"><?= $o['owner_id'] ?></td>
                    <td>
                        <div class="fw-semibold"><?= htmlspecialchars($o['owner_first_name'] . ' ' . $o['owner_last_name']) ?>
                            <?php if ($o['owner_suffix']): ?>
                            <small class="text-muted"><?= htmlspecialchars($o['owner_suffix']) ?></small>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($o['sex'] ?? '—') ?></td>
                    <td><i class="bi bi-telephone me-1 text-muted"></i><?= htmlspecialchars($o['owner_contact_no'] ?? '—') ?></td>
                    <td>
                        <span class="badge" style="background:var(--sacc);color:#fff;font-size:11px">
                            <?= $o['pet_count'] ?? 0 ?> pet<?= ($o['pet_count'] ?? 0) != 1 ? 's' : '' ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="?controller=owner&action=show&id=<?= $o['owner_id'] ?>" class="btn btn-sm btn-outline-info py-0" title="View"><i class="bi bi-eye"></i></a>
                        <a href="?controller=owner&action=edit&id=<?= $o['owner_id'] ?>" class="btn btn-sm btn-outline-warning py-0" title="Edit"><i class="bi bi-pencil"></i></a>
                        <a href="?controller=owner&action=delete&id=<?= $o['owner_id'] ?>" class="btn btn-sm btn-outline-danger py-0" onclick="confirmDelete(this.href, 'Delete this owner? Their pets will also be removed.'); return false;" title="Delete">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>