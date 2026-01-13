<!DOCTYPE html>
<html>
<head>
    <title>User #<?= htmlspecialchars($id) ?></title>
</head>
<body>
<h1>User ID: <?= htmlspecialchars($id) ?></h1>
<p>
    Name: <?= htmlspecialchars($name) ?>
    <br>
    E-mail: <?= htmlspecialchars($email) ?>
    <br>
    Статус: <?= htmlspecialchars($status) ?>
</p>
<?php require_once dirname(__DIR__) . '/views/layouts/menu.php'; ?>
</body>
</html>
