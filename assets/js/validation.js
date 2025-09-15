// Simple form validation for Task Manager

document.addEventListener('DOMContentLoaded', function() {
    initializeValidation();
});

function initializeValidation() {
    const forms = document.querySelectorAll('.task-form, .comment-form, .tag-form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const errors = [];
    
    // Clear previous errors
    clearFormErrors(form);
    
    // Validate title field
    const titleInput = form.querySelector('#title, input[name="title"]');
    if (titleInput && titleInput.value.trim() === '') {
        showFieldError(titleInput, 'Title is required');
        isValid = false;
    }
    
    // Validate content field (for comments)
    const contentInput = form.querySelector('#content, textarea[name="content"]');
    if (contentInput && contentInput.value.trim() === '') {
        showFieldError(contentInput, 'Content is required');
        isValid = false;
    }
    
    // Validate author field (for comments)
    const authorInput = form.querySelector('#author, input[name="author"]');
    if (authorInput && authorInput.value.trim() === '') {
        showFieldError(authorInput, 'Author is required');
        isValid = false;
    }
    
    // Validate tag name (for tags)
    const nameInput = form.querySelector('#name, input[name="name"]');
    if (nameInput && nameInput.value.trim() === '') {
        showFieldError(nameInput, 'Name is required');
        isValid = false;
    }
    
    return isValid;
}

function showFieldError(field, message) {
    field.classList.add('error');
    
    // Create error message element
    const errorEl = document.createElement('div');
    errorEl.className = 'error-message';
    errorEl.textContent = message;
    
    // Insert after the field
    field.parentNode.insertBefore(errorEl, field.nextSibling);
}

function clearFormErrors(form) {
    // Remove error classes
    const errorFields = form.querySelectorAll('.error');
    errorFields.forEach(field => field.classList.remove('error'));
    
    // Remove error messages
    const errorMessages = form.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.remove());
}
