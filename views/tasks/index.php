<?php
use App\Utils\Security;
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>All Tasks</h2>
        <div class="header-actions">
            <a href="/?action=tags" class="btn btn-secondary">
                <i class="fas fa-tags"></i> Manage Tags
            </a>
            <a href="/?action=create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Task
            </a>
        </div>
    </div>

    <?php if (empty($tasks)): ?>
        <div class="empty-state">
            <div class="empty-icon">📝</div>
            <h3>No tasks yet</h3>
            <p>Get started by creating your first task!</p>
            <a href="index.php?action=create" class="btn btn-primary">Create Your First Task</a>
        </div>
    <?php else: ?>
        <div class="task-stats">
            <?php
            $todoCount = 0;
            $inProgressCount = 0;
            $doneCount = 0;
            $totalCount = count($tasks);
            
            foreach ($tasks as $task) {
                switch ($task->getStatus()) {
                    case 'To Do':
                        $todoCount++;
                        break;
                    case 'In Progress':
                        $inProgressCount++;
                        break;
                    case 'Done':
                        $doneCount++;
                        break;
                }
            }
            ?>
            <div class="stat-item">
                <span class="stat-number"><?php echo $totalCount; ?></span>
                <span class="stat-label">All Tasks</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo $todoCount; ?></span>
                <span class="stat-label">To Do</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo $inProgressCount; ?></span>
                <span class="stat-label">In Progress</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo $doneCount; ?></span>
                <span class="stat-label">Done</span>
            </div>
        </div>

        <!-- Task Filters -->
        <div class="task-filters">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-list"></i> All Tasks
                </button>
                <button class="filter-btn" data-filter="to-do">
                    <i class="fas fa-clock"></i> To Do
                </button>
                <button class="filter-btn" data-filter="in-progress">
                    <i class="fas fa-play"></i> In Progress
                </button>
                <button class="filter-btn" data-filter="done">
                    <i class="fas fa-check"></i> Done
                </button>
            </div>
        </div>

        <div class="task-list">
            <?php foreach ($tasks as $task): ?>
                <?php 
                $taskTags = $taskTagsMap[$task->getId()] ?? [];
                $tagIds = array_map(function($tag) { return $tag->getId(); }, $taskTags);
                ?>
                <div class="task-item" 
                     data-status="<?php echo strtolower(str_replace(' ', '-', $task->getStatus())); ?>"
                     data-tags="<?php echo htmlspecialchars(json_encode($tagIds)); ?>">
                    <div class="task-content">
                        <h3 class="task-title"><?php echo Security::escapeHtml($task->getTitle()); ?></h3>
                        
                        <div class="task-meta">
                            <!-- Status -->
                            <div class="task-meta-item">
                                <span class="task-status status-<?php echo strtolower(str_replace(' ', '-', $task->getStatus())); ?>">
                                    <?php echo Security::escapeHtml($task->getStatus()); ?>
                                </span>
                            </div>
                            
                            <!-- Tags -->
                            <?php if (!empty($task->getTags())): ?>
                                <div class="task-meta-item">
                                    <div class="task-tags">
                                        <?php foreach ($taskTags as $tag): ?>
                                            <span class="badge" 
                                                  style="background-color: <?= htmlspecialchars($tag->getColor()) ?>; color: white;"
                                                  data-tag-id="<?= htmlspecialchars($tag->getId()) ?>">
                                                <?= htmlspecialchars($tag->getName()) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Date -->
                            <div class="task-meta-item">
                                <span class="task-date">
                                    Created: <?php echo $task->getCreatedAt()->format('M j, Y g:i A'); ?>
                                </span>
                            </div>
                            
                            <!-- Comments -->
                            <?php if ($task->getCommentCount() > 0): ?>
                                <div class="task-meta-item">
                                    <span class="task-comments">
                                        <i class="fas fa-comments"></i> <?= $task->getCommentCount() ?> comment(s)
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="task-actions">
                        <a href="/?action=edit&id=<?php echo urlencode($task->getId()); ?>" 
                           class="btn btn-secondary btn-sm" title="Edit Task">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="/?action=delete&id=<?php echo urlencode($task->getId()); ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this task?')"
                           title="Delete Task">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
