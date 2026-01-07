<?php
include_once(__DIR__ . '/classes/User.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

<div class="container mt-4">
			<div class="alert alert-info text-center">Welkom, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! Dit is je profielpagina.</div>
		</div>
    
</body>
</html>