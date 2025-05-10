<?php
$host = 'db-student.mysql.database.azure.com';
$dbname = 'student_management';
$username = 'tu92541';
$password = 'Tu@01215255404';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
