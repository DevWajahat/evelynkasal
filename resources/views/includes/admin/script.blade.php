<script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const backdrop = document.getElementById('sidebarBackdrop');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    if (backdrop) {
                        backdrop.classList.toggle('hidden');
                    }
                });
            }

            if (backdrop) {
                backdrop.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
