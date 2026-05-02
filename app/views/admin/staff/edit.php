<?php $pageTitle = 'Edit Staff';
require __DIR__ . '/../../layouts/layout.php'; ?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-5">
        <div class="form-card">
            <div class="fc-title"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Staff</div>
            <form method="POST" action="?controller=staff&action=update&id=<?= $staff['staff_id'] ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Staff Name <span class="text-danger">*</span></label>
                    <input type="text" name="staff_name" class="form-control"
                        value="<?= htmlspecialchars($staff['staff_name']) ?>" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-check-lg me-1"></i>Update</button>
                    <a href="?controller=staff&action=index" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>