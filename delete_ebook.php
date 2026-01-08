<?php
session_start();
include_once('classes/Db.php');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    exit('forbidden');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $db = Db::getConnection();
    $stmt = $db->prepare('DELETE FROM ebooks WHERE id = ?');
    if($stmt->execute([$_POST['id']])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>