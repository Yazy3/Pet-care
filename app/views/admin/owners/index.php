<?php $pageTitle = 'Owners'; require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="panel">
  <div class="panel-hd">
    <h6><i class="bi bi-people-fill me-2 text-primary"></i>Owner List</h6>
    <a href="?controller=owner&action=create" class="btn btn-sm btn-success"><i class="bi bi-plus-lg"></i> Add Owner</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 dt-table">
      <thead class="table-light">
        <tr><th>#</th><th>Name</th><th>Sex</th><th>Contact</th><th>Pets</th><th class="text-center">Actions</th></tr>
      </thead>
      <tbody>
        <?php if(empty($owners)): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">No owners found.</td></tr>
        <?php else: foreach($owners as $o): ?>
          <tr>
            <td><?= $o['owner_id'] ?></td>
            <td>
              <div class="fw-semibold">
                <?= htmlspecialchars($o['owner_first_name'].' '.$o['owner_last_name']) ?>
                <?php if($o['owner_suffix']): ?><small class="text-muted"><?= htmlspecialchars($o['owner_suffix']) ?></small><?php endif; ?>
              </div>
            </td>
            <td><?= htmlspecialchars($o['sex'] ?? '—') ?></td>
            <td><?= htmlspecialchars($o['owner_contact_no'] ?? '—') ?></td>
            <td><span class="badge bg-primary"><?= $o['pet_count'] ?></span></td>
            <td class="text-center">
              <a href="?controller=owner&action=show&id=<?= $o['owner_id'] ?>" class="btn btn-sm btn-outline-info py-0"><i class="bi bi-eye"></i></a>
              <a href="?controller=owner&action=edit&id=<?= $o['owner_id'] ?>" class="btn btn-sm btn-outline-warning py-0"><i class="bi bi-pencil"></i></a>
              <a href="?controller=owner&action=delete&id=<?= $o['owner_id'] ?>"
                 class="btn btn-sm btn-outline-danger py-0"
                 onclick="return confirm('Delete this owner? Their pets will also be removed.')"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>