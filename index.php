<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
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
            margin-bottom: 2rem;
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
        .btn-danger, .btn-warning {
            border-radius: 8px;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background: #1e88e5;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        .table tbody tr:hover {
            background: #e3f2fd;
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
            <a class="navbar-brand" href="#"><i class="bi bi-mortarboard-fill"></i> Student Management</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Add New Student</h2>
        <form action="add.php" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Class</label>
                    <input type="text" name="class" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Math Score</label>
                    <input type="number" step="0.1" name="math_score" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Physics Score</label>
                    <input type="number" step="0.1" name="physics_score" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Chemistry Score</label>
                    <input type="number" step="0.1" name="chemistry_score" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>

        <h2 class="mt-5">Student List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Math</th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['class']; ?></td>
                    <td><?php echo $student['math_score']; ?></td>
                    <td><?php echo $student['physics_score']; ?></td>
                    <td><?php echo $student['chemistry_score']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>