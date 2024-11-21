<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'student') {
    header("Location: index.php");
    exit();
}
require 'db.php';

// Fetch grades for the logged-in student
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT subject, grade FROM grades WHERE user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/student_dashboard_page.css">
    <title>Student Dashboard</title>
</head>
<body>
    <div class="container dashboard-container">
        <h1 class="dashboard-title">Welcome, Student!</h1>
        <h2 class="section-title">Your Grades</h2>
        <table class="grades-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['grade']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No grades available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.html" class="logout-link">Logout</a>
    </div>
</body>

</html>