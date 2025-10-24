    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2"></i>Gestion École</h5>
                    <p class="mb-0">Système de gestion des étudiants et professeurs</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0">
                        <i class="fas fa-calendar me-1"></i>
                        © <?php echo date('Y'); ?> - Projet DevOps
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-code me-1"></i>
                        Développé avec PHP & MySQL
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour les confirmations de suppression
        function confirmDelete(message) {
            return confirm(message || 'Êtes-vous sûr de vouloir supprimer cet élément ?');
        }
        
        // Script pour afficher les messages d'alerte
        <?php if (isset($_SESSION['message'])): ?>
            alert('<?php echo addslashes($_SESSION['message']); ?>');
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
