<?php
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Edit Comment</h2>
        <a href="/?action=comments&task_id=<?= htmlspecialchars($comment->getTaskId()) ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Comments
        </a>
    </div>

    <div class="form-container">
        <form method="POST" action="/?action=edit_comment&id=<?= $comment->getId() ?>" class="comment-form">
            <div class="form-group">
                <label for="content" class="form-label">Comment Content *</label>
                <textarea id="content" 
                          name="content" 
                          class="form-textarea" 
                          placeholder="Enter your comment..."
                          required><?= htmlspecialchars($comment->getContent()) ?></textarea>
                <small class="form-text text-muted">You can only edit comments you authored.</small>
            </div>

            <div class="form-group">
                <label for="author" class="form-label">Author *</label>
                <input type="text" 
                       id="author" 
                       name="author" 
                       class="form-input" 
                       value="<?= htmlspecialchars($comment->getAuthor()) ?>"
                       placeholder="Enter your name..."
                       required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Comment
                </button>
                <a href="/?action=comments&task_id=<?= htmlspecialchars($comment->getTaskId()) ?>" 
                   class="btn btn-secondary">
                    Cancel
                </a>
                <a href="/?action=delete_comment&id=<?= $comment->getId() ?>&author=<?= urlencode($comment->getAuthor()) ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to delete this comment?');">
                    <i class="fas fa-trash"></i> Delete Comment
                </a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Edit Comment';
include __DIR__ . '/../layout.php';
?>
