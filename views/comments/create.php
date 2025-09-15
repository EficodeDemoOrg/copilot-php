<?php
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Add Comment</h2>
        <a href="/?action=comments&task_id=<?= htmlspecialchars($taskId) ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Comments
        </a>
    </div>

    <div class="form-container">
        <form method="POST" action="/?action=create_comment" class="comment-form">
            <input type="hidden" name="task_id" value="<?= htmlspecialchars($taskId) ?>">
            
            <div class="form-group">
                <label for="content" class="form-label">Comment Content *</label>
                <textarea id="content" 
                          name="content" 
                          class="form-textarea" 
                          placeholder="Enter your comment..."
                          required></textarea>
            </div>

            <div class="form-group">
                <label for="author" class="form-label">Author *</label>
                <input type="text" 
                       id="author" 
                       name="author" 
                       class="form-input" 
                       placeholder="Enter your name..."
                       required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Comment
                </button>
                <a href="/?action=comments&task_id=<?= htmlspecialchars($taskId) ?>" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Add Comment';
include __DIR__ . '/../layout.php';
?>
