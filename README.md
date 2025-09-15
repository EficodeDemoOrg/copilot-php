# Simple Task Manager

A lightweight web application for managing tasks, built with PHP. This application allows users to create, view, edit, and delete tasks without requiring a database setup - all data is stored in a JSON file.

## Features

### Core Task Management
- **View All Tasks** - Display a list of all tasks with status indicators
- **Add New Task** - Create new tasks with title and status
- **Edit Tasks** - Modify existing task titles and statuses
- **Delete Tasks** - Remove tasks from the list
- **Task Statistics** - View counts of tasks by status
- **Task Filtering** - Filter tasks by status (To Do, In Progress, Done)

### Comments System
- **Add Comments** - Add comments to tasks with author attribution
- **Edit Comments** - Inline editing of comments with AJAX support
- **Delete Comments** - Remove comments from tasks
- **Author Tracking** - Track comment authors and timestamps

### Tags System
- **Create Tags** - Create color-coded tags for task organization
- **Color Management** - Assign custom colors to tags
- **Tag Assignment** - Assign and remove tags from tasks
- **Filter by Tags** - Filter tasks by assigned tags
- **Tag Management** - Comprehensive tag CRUD operations


## Task Statuses

- **To Do** - Tasks that haven't been started
- **In Progress** - Tasks currently being worked on
- **Done** - Completed tasks

## Requirements

- PHP 7.4 or higher
- Composer (for dependency management)
- Web server (Apache, Nginx, or PHP built-in server)
- Write permissions for `data/` and `logs/` directories

### Dependencies

#### Production Dependencies
- `vlucas/phpdotenv` ^5.4 - Environment variable management

#### Development Dependencies  
- `phpunit/phpunit` ^9.5 - Testing framework

### PHP Extensions
- JSON extension (usually included by default)
- Session extension (usually included by default)

## Installation

1. **Clone or download the project**
   ```bash
   git clone <repository-url>
   cd simple-task-manager
   ```

2. **Install dependencies** (if using Composer)
   ```bash
   composer install
   ```

3. **Set up permissions**
   ```bash
   chmod 755 data/ logs/
   chmod 644 data/tasks.json
   ```

4. **Start the application**
   
   **Option A: Using PHP built-in server**
   ```bash
   php -S localhost:8000
   ```
   
   **Option B: Using Composer script**
   ```bash
   composer run serve
   ```

5. **Access the application**
   - Open your browser and navigate to `http://localhost:8000`
   - Start creating and managing your tasks!

## Usage

### Task Management

#### Creating a New Task
1. Click the "Add New Task" button
2. Enter a task title (3-255 characters)
3. Select a status (defaults to "To Do")
4. Optionally assign tags to categorize the task
5. Click "Create Task"

#### Editing a Task
1. Click the "Edit" button on any task
2. Modify the title, status, or assigned tags as needed
3. Click "Update Task" to save changes

#### Deleting a Task
1. Click the "Delete" button on any task
2. Confirm the deletion in the popup dialog

#### Filtering Tasks
- Use the filter buttons to view tasks by status
- Click on tags to filter tasks by specific categories
- Use "All" to view all tasks regardless of status

### Comments System

#### Adding Comments
1. Navigate to a task's edit page
2. Scroll to the comments section
3. Click "Add Comment" to show the comment form
4. Enter your comment content and author name
5. Click "Post Comment"

#### Managing Comments
- **Edit**: Click the edit button on any comment for inline editing
- **Delete**: Click the delete button and confirm removal
- **AJAX Updates**: Comments can be edited without page refresh

### Tags System

#### Creating Tags
1. Click "Manage Tags" from the main task list
2. Click "Create Tag" 
3. Enter tag name and select a color
4. Click "Create Tag"

#### Assigning Tags to Tasks
1. Edit a task
2. In the tags section, select from available tags
3. Save the task to apply tag assignments

#### Managing Tags
- Edit existing tags to change name or color
- Delete tags (removes them from all assigned tasks)
- View all tags in the tag management interface

### Keyboard Shortcuts

- `Ctrl+N` (or `Cmd+N` on Mac) - Create new task
- `Escape` - Go back to task list

## Configuration

The application can be configured by editing the `config/config.php` file or by using environment variables in a `.env` file.

### Available Configuration Options

#### Application Settings
- `APP_NAME` - Application name (default: "Simple Task Manager")
- `APP_DEBUG` - Enable/disable debug mode (true/false)
- `APP_ENV` - Environment (development/production)

#### Storage Settings  
- `STORAGE_DRIVER` - Storage type (currently: json)
- `STORAGE_PATH` - Path to the tasks JSON file

#### Logging Settings
- `LOG_ENABLED` - Enable/disable logging (true/false)
- `LOG_LEVEL` - Log level (info, debug, error, warning)
- `LOG_PATH` - Path to log files

#### Security Settings
- `CSRF_PROTECTION` - Enable/disable CSRF protection (true/false)
- `XSS_PROTECTION` - Enable/disable XSS protection (true/false)
- `SESSION_LIFETIME` - Session timeout in seconds

#### Development Settings
- `DISPLAY_ERRORS` - Show PHP errors (development only)
- `ERROR_REPORTING` - PHP error reporting level

## Security Features

- **Input Sanitization** - All user input is sanitized to prevent XSS attacks
- **Input Validation** - Both client-side and server-side validation
- **File Locking** - Prevents data corruption during concurrent access
- **Error Handling** - Graceful error handling and logging

## Data Storage

The application uses JSON files for data persistence:

### Tasks (`data/tasks.json`)
```json
[
  {
    "id": "task_unique_id",
    "title": "Task title",
    "status": "To Do",
    "tags": ["tag_id_1", "tag_id_2"],
    "created_at": "2024-01-01 12:00:00",
    "updated_at": "2024-01-01 12:00:00"
  }
]
```

### Comments (`data/comments.json`)
```json
[
  {
    "id": "comment_unique_id",
    "task_id": "task_unique_id",
    "content": "Comment content",
    "author": "Author name",
    "created_at": "2024-01-01 12:00:00",
    "updated_at": "2024-01-01 12:00:00"
  }
]
```

### Tags (`data/tags.json`)
```json
[
  {
    "id": "tag_unique_id",
    "name": "Tag name",
    "color": "#007bff",
    "created_at": "2024-01-01 12:00:00"
  }
]
```

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## API Endpoints

The application provides the following endpoints:

### Task Operations
- `GET /?action=index` - List all tasks
- `GET /?action=create` - Show create task form
- `POST /?action=create` - Create new task
- `GET /?action=edit&id={id}` - Show edit task form
- `POST /?action=edit&id={id}` - Update task
- `POST /?action=delete&id={id}` - Delete task

### Comment Operations
- `GET /?action=comments` - List all comments
- `GET /?action=create_comment` - Show create comment form
- `POST /?action=create_comment` - Create new comment
- `GET /?action=edit_comment&id={id}` - Show edit comment form
- `POST /?action=edit_comment&id={id}` - Update comment
- `POST /?action=delete_comment&id={id}` - Delete comment
- `POST /?action=update_comment_ajax&id={id}` - Update comment via AJAX

### Tag Operations
- `GET /?action=tags` - List all tags
- `GET /?action=create_tag` - Show create tag form
- `POST /?action=create_tag` - Create new tag
- `GET /?action=edit_tag&id={id}` - Show edit tag form
- `POST /?action=edit_tag&id={id}` - Update tag
- `POST /?action=delete_tag&id={id}` - Delete tag
- `POST /?action=assign_tag` - Assign tag to task
- `POST /?action=remove_tag` - Remove tag from task

## Testing

The project includes PHPUnit for testing:

```bash
# Run all tests
composer test

# Run tests with coverage (if configured)
vendor/bin/phpunit --coverage-html coverage/
```

## Troubleshooting

### Common Issues

**Permission Denied Errors**
- Ensure the web server has write permissions to `data/` and `logs/` directories
- Check file ownership and permissions

**Tasks Not Saving**
- Verify `data/tasks.json` exists and is writable
- Check error logs for detailed error messages

**Styling Issues**
- Ensure CSS files are being loaded correctly
- Check browser console for any JavaScript errors

### Debug Mode

Enable debug mode by setting `APP_DEBUG=true` in your `.env` file or `config/config.php`. This will:
- Display detailed error messages
- Show PHP errors and warnings
- Log additional debug information

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For support, please check the troubleshooting section above or create an issue in the project repository.
