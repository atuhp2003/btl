<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
$stmt->execute([$_GET['id']]);

header("Location: index.php");
exit;
?>