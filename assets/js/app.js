// Simple Task Manager JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Initialize basic functionality
    initializeTaskFilters();
    initializeCommentForm();
    showFlashMessages();
}

function initializeTaskFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get filter value
            const filterValue = this.dataset.filter;
            
            // Filter tasks
            filterTasks(filterValue);
        });
    });
}

function filterTasks(status) {
    const taskItems = document.querySelectorAll('.task-item');
    
    taskItems.forEach(task => {
        if (status === 'all') {
            task.style.display = 'block';
        } else {
            const taskStatus = task.dataset.status;
            if (taskStatus === status) {
                task.style.display = 'block';
            } else {
                task.style.display = 'none';
            }
        }
    });
}

function initializeCommentForm() {
    const toggleButtons = document.querySelectorAll('.toggle-comment-form');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = document.querySelector('.add-comment-form');
            if (form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        });
    });
}

function showFlashMessages() {
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(alert => {
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
}
