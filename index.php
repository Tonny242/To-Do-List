<?php
require 'config.php';
$tasks = $pdo->query('SELECT * FROM tasks ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <main class="wrap">
      <h1>Mes tâches</h1>
      <form action="actions.php" method="post" class="add-form">
        <input type="hidden" name="action" value="add">
        <input type="text" name="title" placeholder="Nouvelle tâche…" required autofocus>
        <button type="submit">Ajouter</button>
      </form>
      <ul class="task-list">
        <?php foreach ($tasks as $t): ?>
          <li class="task<?= $t['done'] ? ' done' : '' ?>">
            <a href="actions.php?action=toggle&id=<?= $t['id'] ?>" class="check" aria-label="Marquer comme terminée"></a>
            <span><?= htmlspecialchars($t['title']) ?></span>
            <a href="actions.php?action=delete&id=<?= $t['id'] ?>" class="delete" aria-label="Supprimer">✕</a>
          </li>
        <?php endforeach; ?>
        <?php if (!$tasks): ?>
        <li class="empty">Aucune tâche pour l'instant.</li>
        <?php endif; ?>
      </ul>
    </main>
  </body>
</html>
