<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) . ' - ' : ''; ?>Simple Task Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>
    
    <main class="main-content">
        <?php 
        // Display flash messages
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['flash_message'])): 
        ?>
            <div class="container">
                <div class="alert alert-<?= $_SESSION['flash_type'] ?? 'info' ?>">
                    <?= htmlspecialchars($_SESSION['flash_message']) ?>
                </div>
            </div>
            <?php 
            unset($_SESSION['flash_message']);
            unset($_SESSION['flash_type']);
        endif; 
        ?>
        
        <?php echo $content ?? ''; ?>
    </main>
    
    <?php include __DIR__ . '/partials/footer.php'; ?>
    
    <script src="assets/js/app.js"></script>
    <script src="assets/js/validation.js"></script>
</body>
</html>
