</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:360px">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 8px 32px rgba(0,0,0,0.18);overflow:hidden">
            <div class="modal-body p-4 text-center">
                <div style="width:56px;height:56px;border-radius:50%;background:#fee2e2;display:grid;place-items:center;margin:0 auto 16px">
                    <i class="bi bi-exclamation-circle-fill" style="color:#dc3545;font-size:26px"></i>
                </div>
                <div class="fw-bold mb-1" style="font-size:17px;color:#0f172a">Delete</div>
                <div id="deleteModalMsg" class="text-muted mb-4" style="font-size:13px">Are you sure you want to delete this?</div>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <a id="deleteModalBtn" href="#" class="btn btn-danger px-4">
                        <i class="bi bi-trash3-fill me-1"></i>Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleSidebar() {
    document.getElementById('sb').classList.toggle('show');
    document.getElementById('sbdrop').classList.toggle('show');
}

function closeSidebar() {
    document.getElementById('sb').classList.remove('show');
    document.getElementById('sbdrop').classList.remove('show');
}

function confirmDelete(url, message) {
    document.getElementById('deleteModalMsg').textContent = message || 'Are you sure you want to delete this?';
    document.getElementById('deleteModalBtn').href = url;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

</body>
</html>