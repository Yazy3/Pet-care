</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
    function toggleSidebar() {
        document.getElementById('sb').classList.toggle('show');
        document.getElementById('sbdrop').classList.toggle('show');
    }

    function closeSidebar() {
        document.getElementById('sb').classList.remove('show');
        document.getElementById('sbdrop').classList.remove('show');
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.dt-table').forEach(function (el) {
            new DataTable(el, { responsive: true });
        });
    });
    </script>

</body>
</html>