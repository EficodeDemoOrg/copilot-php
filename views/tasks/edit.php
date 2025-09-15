<?php
use App\Models\Task;
use App\Utils\Security;
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Edit Task</h2>
        <a href="/" class="btn btn-secondary">← Back to Tasks</a>
    </div>

    <div class="form-container">
        <form method="POST" action="/?action=edit&id=<?php echo urlencode($task->getId()); ?>" class="task-form" id="editTaskForm">
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-error">
                    <h4>Please fix the following errors:</h4>
                    <ul>
                        <?php foreach ($errors as $field => $error): ?>
                            <li><?php echo Security::escapeHtml($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="title" class="form-label">Task Title *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="form-input <?php echo isset($errors['title']) ? 'error' : ''; ?>"
                    value="<?php echo Security::escapeHtml(isset($title) ? $title : $task->getTitle()); ?>"
                    placeholder="Enter task title..."
                    required
                    maxlength="255"
                >
                <?php if (isset($errors['title'])): ?>
                    <span class="error-message"><?php echo Security::escapeHtml($errors['title']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select 
                    id="status" 
                    name="status" 
                    class="form-select <?php echo isset($errors['status']) ? 'error' : ''; ?>"
                >
                    <?php 
                    $selectedStatus = isset($status) ? $status : $task->getStatus();
                    foreach (Task::getAllowedStatuses() as $statusOption): 
                    ?>
                        <option 
                            value="<?php echo Security::escapeHtml($statusOption); ?>"
                            <?php echo $statusOption === $selectedStatus ? 'selected' : ''; ?>
                        >
                            <?php echo Security::escapeHtml($statusOption); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['status'])): ?>
                    <span class="error-message"><?php echo Security::escapeHtml($errors['status']); ?></span>
                <?php endif; ?>
            </div>

            <!-- Tags Section -->
            <?php if (!empty($allTags)): ?>
                <div class="form-group">
                    <label class="form-label">Tags</label>
                    <div class="tags-container">
                        <?php foreach ($allTags as $tag): ?>
                            <div class="form-check form-check-inline">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="tags[]" 
                                    value="<?= $tag->getId() ?>" 
                                    id="tag-<?= $tag->getId() ?>"
                                    <?= in_array($tag->getId(), $task->getTags()) ? 'checked' : '' ?>
                                >
                                <label class="form-check-label" for="tag-<?= $tag->getId() ?>">
                                    <span class="badge" style="background-color: <?= htmlspecialchars($tag->getColor()) ?>; color: white;">
                                        <?= htmlspecialchars($tag->getName()) ?>
                                    </span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <small class="form-text text-muted">Select tags to organize this task</small>
                </div>
            <?php endif; ?>

            <div class="task-info">
                <p><strong>Created:</strong> <?php echo $task->getCreatedAt()->format('M j, Y g:i A'); ?></p>
                <p><strong>Last Updated:</strong> <?php echo $task->getUpdatedAt()->format('M j, Y g:i A'); ?></p>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="/" class="btn btn-secondary">Cancel</a>
                <a href="/?action=delete&id=<?php echo urlencode($task->getId()); ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to delete this task?')">
                    Delete Task
                </a>
            </div>
        </form>
    </div>

    <!-- Comments Section (Outside main form) -->
    <div class="comments-section">
        <div class="form-group">
            <label class="form-label">Comments</label>
            <div class="comments-box">
                <div class="comments-header">
                    <div class="comments-actions">
                        <button type="button" class="btn btn-outline-success btn-sm" id="toggleCommentForm">
                            <i class="fas fa-plus"></i> Add Comment
                        </button>
                        <span class="comment-count"><?= count($comments ?? []) ?> comment(s)</span>
                    </div>
                </div>
                
                <!-- Inline Comment Form -->
                <div class="add-comment-form" id="commentForm" style="display: none;">
                    <form method="POST" action="/?action=create_comment" class="comment-form">
                        <input type="hidden" name="task_id" value="<?= $task->getId() ?>">
                        <div class="form-group">
                            <input type="text" name="author" class="form-input" 
                                   placeholder="Your name..." required maxlength="100">
                        </div>
                        <div class="form-group">
                            <textarea name="content" class="form-input" rows="3" 
                                      placeholder="Write your comment..." required maxlength="1000"></textarea>
                        </div>
                        <div class="comment-form-actions">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Add Comment
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" id="cancelComment">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="comments-list">
                    <?php if (empty($comments)): ?>
                        <div class="no-comments">
                            <p class="text-muted"><i class="fas fa-comment-slash"></i> No comments yet. Be the first to add one!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="comment-item comment-card" data-comment-id="<?= $comment->getId() ?>">
                                <div class="comment-header">
                                    <div class="comment-meta">
                                        <strong class="comment-author"><?= Security::escapeHtml($comment->getAuthor()) ?></strong>
                                        <small class="comment-date text-muted">
                                            <?= $comment->getCreatedAt()->format('M j, Y g:i A') ?>
                                            <span class="updated-time" <?php if ($comment->getUpdatedAt() <= $comment->getCreatedAt()): ?>style="display: none;"<?php endif; ?>>
                                                (edited <span class="updated-timestamp"><?= $comment->getUpdatedAt()->format('M j, Y g:i A') ?></span>)
                                            </span>
                                        </small>
                                    </div>
                                    <div class="comment-actions">
                                        <button class="btn btn-sm btn-outline-primary edit-comment-btn" 
                                                data-comment-id="<?= $comment->getId() ?>"
                                                data-author="<?= Security::escapeHtml($comment->getAuthor()) ?>"
                                                title="Edit comment">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success save-comment-btn" 
                                                data-comment-id="<?= $comment->getId() ?>"
                                                data-author="<?= Security::escapeHtml($comment->getAuthor()) ?>"
                                                title="Save comment"
                                                style="display: none;">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button class="btn btn-sm btn-secondary cancel-edit-btn" 
                                                data-comment-id="<?= $comment->getId() ?>"
                                                title="Cancel editing"
                                                style="display: none;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <form method="POST" action="/?action=delete_comment&id=<?= $comment->getId() ?>" 
                                              class="d-inline delete-form" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                            <input type="hidden" name="author" value="<?= Security::escapeHtml($comment->getAuthor()) ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete comment">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="comment-content comment-content-display">
                                    <p><?= nl2br(Security::escapeHtml($comment->getContent())) ?></p>
                                </div>
                                <div class="comment-content-edit" style="display: none;">
                                    <textarea class="form-control comment-textarea" rows="4"><?= Security::escapeHtml($comment->getContent()) ?></textarea>
                                    <small class="form-text text-muted mt-1">Only the comment content can be edited. Author cannot be changed.</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Existing comment form toggle functionality
    const toggleCommentForm = document.getElementById('toggleCommentForm');
    const commentForm = document.getElementById('commentForm');
    const cancelComment = document.getElementById('cancelComment');

    if (toggleCommentForm && commentForm) {
        toggleCommentForm.addEventListener('click', function() {
            commentForm.style.display = commentForm.style.display === 'none' ? 'block' : 'none';
        });
    }

    if (cancelComment && commentForm) {
        cancelComment.addEventListener('click', function() {
            commentForm.style.display = 'none';
            commentForm.querySelector('form').reset();
        });
    }

    // Inline comment editing functionality
    // Handle edit button clicks
    document.querySelectorAll('.edit-comment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const card = document.querySelector(`.comment-card[data-comment-id="${commentId}"]`);
            
            // Switch to edit mode
            card.querySelector('.comment-content-display').style.display = 'none';
            card.querySelector('.comment-content-edit').style.display = 'block';
            
            // Toggle buttons
            this.style.display = 'none';
            card.querySelector('.save-comment-btn').style.display = 'inline-block';
            card.querySelector('.cancel-edit-btn').style.display = 'inline-block';
            card.querySelector('.delete-form').style.display = 'none';
            
            // Focus on textarea
            const textarea = card.querySelector('.comment-textarea');
            textarea.focus();
            textarea.setSelectionRange(textarea.value.length, textarea.value.length);
        });
    });

    // Handle cancel button clicks
    document.querySelectorAll('.cancel-edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const card = document.querySelector(`.comment-card[data-comment-id="${commentId}"]`);
            
            // Switch back to display mode
            card.querySelector('.comment-content-display').style.display = 'block';
            card.querySelector('.comment-content-edit').style.display = 'none';
            
            // Toggle buttons
            card.querySelector('.edit-comment-btn').style.display = 'inline-block';
            this.style.display = 'none';
            card.querySelector('.save-comment-btn').style.display = 'none';
            card.querySelector('.delete-form').style.display = 'inline-block';
        });
    });

    // Handle save button clicks
    document.querySelectorAll('.save-comment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const author = this.dataset.author;
            const card = document.querySelector(`.comment-card[data-comment-id="${commentId}"]`);
            const textarea = card.querySelector('.comment-textarea');
            const content = textarea.value.trim();
            
            if (!content) {
                alert('Comment content cannot be empty.');
                return;
            }
            
            // Disable the save button while saving
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            
            // Send AJAX request to update comment
            const formData = new FormData();
            formData.append('content', content);
            formData.append('author', author);
            
            fetch(`/?action=update_comment_ajax&id=${commentId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the display content
                    const displayElement = card.querySelector('.comment-content-display p');
                    displayElement.innerHTML = content.replace(/\n/g, '<br>');
                    
                    // Update the updated timestamp
                    const updatedTime = card.querySelector('.updated-time');
                    const updatedTimestamp = card.querySelector('.updated-timestamp');
                    updatedTimestamp.textContent = new Date().toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric',
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                    updatedTime.style.display = 'inline';
                    
                    // Switch back to display mode
                    card.querySelector('.comment-content-display').style.display = 'block';
                    card.querySelector('.comment-content-edit').style.display = 'none';
                    
                    // Toggle buttons
                    card.querySelector('.edit-comment-btn').style.display = 'inline-block';
                    this.style.display = 'none';
                    card.querySelector('.cancel-edit-btn').style.display = 'none';
                    card.querySelector('.delete-form').style.display = 'inline-block';
                    
                    // Show success message
                    showFlashMessage('Comment updated successfully!', 'success');
                } else {
                    alert('Error updating comment: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating comment. Please try again.');
            })
            .finally(() => {
                // Re-enable the save button
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-save"></i>';
            });
        });
    });
    
    // Function to show flash messages
    function showFlashMessage(message, type) {
        // Create a flash message element
        const flashDiv = document.createElement('div');
        flashDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
        flashDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Insert at the top of the container
        const container = document.querySelector('.container');
        container.insertBefore(flashDiv, container.firstChild);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (flashDiv.parentNode) {
                flashDiv.remove();
            }
        }, 5000);
    }
});
</script>

<?php
$content = ob_get_clean();
$title = 'Edit Task';
include __DIR__ . '/../layout.php';
?>
