<?php
require_once 'bootstrap/app.php';

use App\Controllers\TaskController;
use App\Controllers\CommentController;
use App\Controllers\TagController;

// Simple routing
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

try {
    switch ($action) {
        // Task routes
        case 'index':
            $controller = new TaskController();
            $controller->index();
            break;
        case 'create':
            $controller = new TaskController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();
            } else {
                $controller->create();
            }
            break;
        case 'edit':
            $controller = new TaskController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update($id);
            } else {
                $controller->edit($id);
            }
            break;
        case 'delete':
            $controller = new TaskController();
            $controller->delete($id);
            break;
            
        // Comment routes
        case 'comments':
            $controller = new CommentController();
            $controller->index();
            break;
        case 'create_comment':
            $controller = new CommentController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();
            } else {
                $controller->create();
            }
            break;
        case 'edit_comment':
            $controller = new CommentController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update($id);
            } else {
                $controller->edit($id);
            }
            break;
        case 'delete_comment':
            $controller = new CommentController();
            $controller->delete($id);
            break;
        case 'update_comment_ajax':
            $controller = new CommentController();
            $controller->updateAjax($id);
            break;
            
        // Tag routes
        case 'tags':
            $controller = new TagController();
            $controller->index();
            break;
        case 'create_tag':
            $controller = new TagController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();
            } else {
                $controller->create();
            }
            break;
        case 'edit_tag':
            $controller = new TagController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update($id);
            } else {
                $controller->edit($id);
            }
            break;
        case 'delete_tag':
            $controller = new TagController();
            $controller->delete($id);
            break;
        case 'assign_tag':
            $controller = new TagController();
            $controller->assignToTask();
            break;
        case 'remove_tag':
            $controller = new TagController();
            $controller->removeFromTask();
            break;
        case 'filter_by_tags':
            $controller = new TagController();
            $controller->filterTasks();
            break;
            
        default:
            $controller = new TaskController();
            $controller->index();
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    include 'views/error.php';
}
