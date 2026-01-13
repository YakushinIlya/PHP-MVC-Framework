<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
<h1><?= htmlspecialchars($title) ?></h1>
<p>Custom MVC framework - home page.</p>
<?php require_once dirname(__DIR__) . '/views/layouts/menu.php'; ?>
</body>
</html>
