<?php
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Comments for Task</h2>
        <div class="header-actions">
            <a href="/?action=create_comment&task_id=<?= htmlspecialchars($taskId) ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Comment
            </a>
            <a href="/" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tasks
            </a>
        </div>
    </div>

    <div class="comments-section">
        <div class="comments-box">
            <?php if (empty($comments)): ?>
                <div class="no-comments">
                    <i class="fas fa-info-circle"></i> No comments yet. Be the first to add one!
                </div>
            <?php else: ?>
                <div class="comments-list">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment-item">
                            <div class="comment-header">
                                <div class="comment-meta">
                                    <span class="comment-author"><?= htmlspecialchars($comment->getAuthor()) ?></span>
                                    <span class="comment-date"><?= $comment->getCreatedAt() ?></span>
                                    <?php if ($comment->getUpdatedAt() !== $comment->getCreatedAt()): ?>
                                        <span class="edited-indicator">(edited <?= $comment->getUpdatedAt() ?>)</span>
                                    <?php endif; ?>
                                </div>
                                <div class="comment-actions">
                                    <a href="/?action=edit_comment&id=<?= $comment->getId() ?>" 
                                       class="btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="/?action=delete_comment&id=<?= $comment->getId() ?>" 
                                          style="display: inline;" 
                                          onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        <input type="hidden" name="author" value="<?= htmlspecialchars($comment->getAuthor()) ?>">
                                        <button type="submit" class="btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Comments';
include __DIR__ . '/../layout.php';
?>
