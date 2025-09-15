<?php
use App\Utils\Security;
ob_start();
?>

<div class="container">
    <div class="error-page">
        <div class="error-icon">⚠️</div>
        <h2>Oops! Something went wrong</h2>
        <p class="error-message">
            <?php echo isset($message) ? Security::escapeHtml($message) : 'An unexpected error occurred.'; ?>
        </p>
        <div class="error-actions">
            <a href="index.php" class="btn btn-primary">Go Home</a>
            <button onclick="history.back()" class="btn btn-secondary">Go Back</button>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Error';
include __DIR__ . '/layout.php';
?>
