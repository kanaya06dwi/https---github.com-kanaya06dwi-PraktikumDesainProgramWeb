</main>
<footer class="text-center py-3 text-muted border-top mt-auto">
    <div class="container d-flex justify-content-between align-items-center">
        <p class="mb-0">&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 7</p>
        <div>
            <a href="<?php echo $base; ?>debug_session.php" class="btn btn-outline-secondary btn-sm me-2" target="_blank">🔍 Debug Session</a>
            <a href="<?php echo $base; ?>reset_session.php" class="btn btn-outline-danger btn-sm" onclick="return confirm('Kosongkan semua data session?')">🗑️ Reset Data</a>
        </div>
    </div>
</footer>
<script src="<?php echo $base; ?>assets/js/app.js"></script>
<?php if (!empty($extra_scripts)): foreach ($extra_scripts as $src): ?>
    <script src="<?php echo $src; ?>"></script>
<?php endforeach; endif; ?>
</body>
</html>