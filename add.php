<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $math_score = $_POST['math_score'];
    $physics_score = $_POST['physics_score'];
    $chemistry_score = $_POST['chemistry_score'];

    $stmt = $pdo->prepare("INSERT INTO students (name, class, math_score, physics_score, chemistry_score) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $class, $math_score, $physics_score, $chemistry_score]);

    header("Location: index.php");
    exit;
}
?>