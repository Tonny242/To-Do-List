<?php
require 'config.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'add' && !empty(trim($_POST['title'] ?? ''))) {
    $pdo->prepare('INSERT INTO tasks (title) VALUES (?)')->execute([trim($_POST['title'])]);
} elseif ($action === 'toggle' && isset($_GET['id'])) {
    $pdo->prepare('UPDATE tasks SET done = 1 - done WHERE id = ?')->execute([$_GET['id']]);
} elseif ($action === 'delete' && isset($_GET['id'])) {
    $pdo->prepare('DELETE FROM tasks WHERE id = ?')->execute([$_GET['id']]);
}

header('Location: index.php');
exit;
