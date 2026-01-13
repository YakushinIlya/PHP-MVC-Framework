<!DOCTYPE html>
<html>
<head>
    <title>User list</title>
</head>
<body>
<h1>User list</h1>
<?php foreach ($users as $user): ?>
<p>
    Name: <?= htmlspecialchars($user['name']) ?>
    <br>
    E-mail: <?= htmlspecialchars($user['email']) ?>
    <br>
    Статус: <?= htmlspecialchars($user['status']) ?>
</p>
<?php endforeach; ?>
<?php require_once dirname(__DIR__) . '/views/layouts/menu.php'; ?>
</body>
</html>
