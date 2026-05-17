<?php
$pageTitle = 'My Schedule';
require __DIR__ . '/../layouts/owner_layout.php';
?>

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="bi bi-calendar2-check-fill me-2" style="color:var(--sacc)"></i>My Schedule</h5>
    </div>

    <div class="panel">
        <div class="panel-hd">
            <h6><i class="bi bi-list-ul me-1"></i> Vaccination Records & Upcoming Doses</h6>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>Pet</th>
                        <th>Vaccine</th>
                        <th>Type</th>
                        <th>Next Dose</th>
                        <th>Administered By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($schedules)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x display-4 d-block mb-3"></i>
                            No vaccination records yet.
                        </td>
                    </tr>
                    <?php else: foreach ($schedules as $s): 
                        $nextDose = $s['next_dose'] ?? null;
                        $isOverdue = $nextDose && $nextDose < date('Y-m-d');
                        $isDueSoon = $nextDose && !$isOverdue && $nextDose <= date('Y-m-d', strtotime('+30 days'));
                    ?>
                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($s['pet_name'] ?? '—') ?></td>
                        <td>
                            <div class="fw-semibold"><?= htmlspecialchars($s['vaccine_name'] ?? '—') ?></div>
                            <?php if (!empty($s['vaccine_form'])): ?>
                            <small class="text-muted"><?= htmlspecialchars($s['vaccine_form']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= ucwords(str_replace('_', ' ', $s['vaccine_type'] ?? '—')) ?></td>
                        <td>
                            <?php if ($nextDose): ?>
                                <?php if ($isOverdue): ?>
                                <span class="badge bg-danger"><?= htmlspecialchars($nextDose) ?> — Overdue</span>
                                <?php elseif ($isDueSoon): ?>
                                <span class="badge bg-warning text-dark"><?= htmlspecialchars($nextDose) ?> — Due Soon</span>
                                <?php else: ?>
                                <span class="badge" style="background:#D8F4F2;color:#134E5E"><?= htmlspecialchars($nextDose) ?></span>
                                <?php endif; ?>
                            <?php else: ?>—<?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($s['staff_name'] ?? '—') ?></td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../layouts/owner_footer.php'; ?>