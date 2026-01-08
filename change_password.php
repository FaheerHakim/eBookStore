<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
include_once(__DIR__ . '/classes/User.php');

$passwordMsg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    if (strlen($new) < 6)
        $passwordMsg = '<div class="alert alert-danger text-center">Password must be at least 6 characters long.</div>';
    elseif ($new !== $confirm)
        $passwordMsg = '<div class="alert alert-danger text-center">Passwords do not match.</div>';
    else {
        User::changePassword($_SESSION['username'], $new);
        $passwordMsg = '<div class="alert alert-success text-center">Password successfully changed.</div>';
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Wachtwoord wijzigen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, body * {
            font-family: 'Times New Roman', Times, serif !important;
        }
        body {
            background: #fffbe6 !important;
            color: #000;
        }
        .change-password-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(62,163,199,0.08);
            border: 1px solid #b3e6fb;
            padding: 2.5rem 2rem 2rem 2rem;
            margin-top: 60px;
        }
        .change-password-card h2 {
            color: #3ea3c7;
            font-weight: 700;
        }
        .btn-primary {
            background-color: #b3e6fb !important;
            border-color: #b3e6fb !important;
            color: #000 !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #3ea3c7 !important;
            border-color: #3ea3c7 !important;
            color: #fff !important;
        }
        a {
            color: #3ea3c7;
        }
        a:hover {
            color: #ecd17b;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width:420px;">
        <div class="change-password-card">
            <h2 class="mb-4 text-center">Password Reset</h2>
            <?php if ($passwordMsg) { echo $passwordMsg; } ?>
            <form method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required minlength="6">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required minlength="6">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Save Password</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <a href="profile.php">Back to Profile</a>
            </div>
        </div>
    </div>
</body>
</html>
