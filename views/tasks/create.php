<?php
use App\Models\Task;
use App\Utils\Security;
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Add New Task</h2>
        <a href="/" class="btn btn-secondary">← Back to Tasks</a>
    </div>

    <div class="form-container">
        <form method="POST" action="/?action=create" class="task-form" id="createTaskForm">
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
                    value="<?php echo isset($title) ? Security::escapeHtml($title) : ''; ?>"
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
                    $selectedStatus = isset($status) ? $status : Task::STATUS_TODO;
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
                    <label class="form-label">Tags (Optional)</label>
                    <div class="tags-container">
                        <?php foreach ($allTags as $tag): ?>
                            <div class="form-check form-check-inline">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="tags[]" 
                                    value="<?= $tag->getId() ?>" 
                                    id="tag-<?= $tag->getId() ?>"
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

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Task</button>
                <a href="/" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Add New Task';
include __DIR__ . '/../layout.php';
?>
