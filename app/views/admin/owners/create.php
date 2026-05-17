<?php
$pageTitle = 'Add Owner';
require __DIR__ . '/../../layouts/layout.php';
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-9">
        <div class="panel">
            <div class="panel-hd">
                <h6><i class="bi bi-person-plus-fill me-2 text-success"></i>Add New Owner</h6>
            </div>
            <div class="panel-bd">
                <form method="POST" action="?controller=owner&action=storeWithPet">


                    <h5 class="mb-4 text-success fw-semibold">
                        <i class="bi bi-person-badge-fill me-2 text-success"></i>Owner Information
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_first_name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_last_name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Suffix</label>
                            <input type="text" name="owner_suffix" class="form-control" placeholder="Jr, Sr, III">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Contact Number <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="owner_contact_no" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sex <span class="text-danger">*</span></label>
                            <select name="sex" class="form-select" required>
                                <option value=""> Select Sex </option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-5">


                    <h5 class="mb-4 text-success fw-semibold">
                        <i class="bi bi-paw-fill me-2">Pet Information </i>
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pet Name <span class="text-danger">*</span></label>
                            <input type="text" name="pet_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Species <span class="text-danger">*</span></label>
                            <select name="pet_species" class="form-select" required>
                                <option value=""> Select Species </option>
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Breed</label>
                            <input type="text" name="pet_breed" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Age</label>
                            <input type="number" name="pet_age" class="form-control" min="0" max="30">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Weight (kg)</label>
                            <input type="number" step="0.01" name="pet_weight" class="form-control" min="0">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Pet Status</label>
                            <select name="pet_status" class="form-select">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deceased">Deceased</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-fill"></i> Save Owner & Pet
                        </button>
                        <a href="?controller=owner&action=index" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>