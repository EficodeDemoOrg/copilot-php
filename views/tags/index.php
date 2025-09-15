<?php
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Manage Tags</h2>
        <div class="header-actions">
            <a href="/?action=create_tag" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Tag
            </a>
            <a href="/" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tasks
            </a>
        </div>
    </div>

    <?php if (empty($tags)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No tags created yet. Create your first tag to organize your tasks!
        </div>
    <?php else: ?>
        <div class="tags-grid">
            <?php foreach ($tags as $tag): ?>
                <div class="tag-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="tag-header">
                                <span class="badge" style="background-color: <?= htmlspecialchars($tag->getColor()) ?>; color: white;">
                                    <?= htmlspecialchars($tag->getName()) ?>
                                </span>
                                <div class="tag-actions">
                                    <a href="/?action=edit_tag&id=<?= $tag->getId() ?>" 
                                       class="btn btn-sm btn-outline-primary" title="Edit Tag">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="/?action=delete_tag&id=<?= $tag->getId() ?>" 
                                          class="d-inline" onsubmit="return confirm('Are you sure? This will remove the tag from all tasks.')">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Tag">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="tag-meta">
                                <small class="text-muted">
                                    Created: <?= $tag->getCreatedAt()->format('M j, Y') ?>
                                </small>
                            </div>
                        </div>
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
