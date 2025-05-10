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

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$_GET['id']]);
$student = $stmt->fetch();

if (!$student) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $math_score = $_POST['math_score'];
    $physics_score = $_POST['physics_score'];
    $chemistry_score = $_POST['chemistry_score'];

    $stmt = $pdo->prepare("UPDATE students SET name = ?, class = ?, math_score = ?, physics_score = ?, chemistry_score = ? WHERE id = ?");
    $stmt->execute([$name, $class, $math_score, $physics_score, $chemistry_score, $_GET['id']]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
            max-width: 600px;
        }
        h2 {
            color: #1e88e5;
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background: #1e88e5;
            border: none;
            border-radius: 8px;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: #1565c0;
        }
        .btn-secondary {
            border-radius: 8px;
        }
        .navbar {
            background: #1e88e5;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Student Management</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Edit Student</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $student['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Class</label>
                <input type="text" name="class" class="form-control" value="<?php echo $student['class']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Math Score</label>
                <input type="number" step="0.1" name="math_score" class="form-control" value="<?php echo $student['math_score']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Physics Score</label>
                <input type="number" step="0.1" name="physics_score" class="form-control" value="<?php echo $student['physics_score']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Chemistry Score</label>
                <input type="number" step="0.1" name="chemistry_score" class="form-control" value="<?php echo $student['chemistry_score']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>