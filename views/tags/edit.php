<?php
ob_start();
?>

<div class="container">
    <div class="page-header">
        <h2>Edit Tag</h2>
        <div class="header-actions">
            <a href="/?action=tags" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tags
            </a>
        </div>
    </div>

    <div class="form-container">
        <form method="POST" action="/?action=edit_tag&id=<?= $tag->getId() ?>" class="comment-form">
            <div class="form-group">
                <label for="name" class="form-label">Tag Name *</label>
                <input type="text" class="form-input" id="name" name="name" 
                       value="<?= htmlspecialchars($tag->getName()) ?>" 
                       placeholder="Enter tag name..." required>
            </div>

            <div class="form-group">
                <label for="color" class="form-label">Color</label>
                <div class="color-picker">
                    <input type="color" class="form-control-color" 
                           id="color" name="color" value="<?= htmlspecialchars($tag->getColor()) ?>" 
                           title="Choose color">
                    <span id="color-preview" class="color-preview" 
                          style="background-color: <?= htmlspecialchars($tag->getColor()) ?>; color: white;">
                        <?= htmlspecialchars($tag->getName()) ?>
                    </span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Tag
                </button>
                <a href="/?action=tags" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const colorInput = document.getElementById('color');
    const colorPreview = document.getElementById('color-preview');
    
    // Auto-focus on name input and select all text
    nameInput.focus();
    nameInput.select();
    
    // Update preview when color changes
    colorInput.addEventListener('input', function() {
        colorPreview.style.backgroundColor = this.value;
        updatePreviewText();
    });
    
    // Update preview when name changes
    nameInput.addEventListener('input', function() {
        updatePreviewText();
    });
    
    function updatePreviewText() {
        const name = nameInput.value.trim();
        colorPreview.textContent = name || 'Preview';
    }
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const name = nameInput.value.trim();
        
        if (!name) {
            e.preventDefault();
            alert('Please enter a tag name.');
            nameInput.focus();
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
