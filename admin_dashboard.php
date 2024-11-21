<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    exit();
}
require 'db.php';

// Fetch all students
$result = $conn->query("SELECT id, username FROM users WHERE user_type = 'student'");

// Fetch grades for the logged-in admin
$grades_result = $conn->query("SELECT g.id, u.username, g.subject, g.grade FROM grades g JOIN users u ON g.user_id = u.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_dashboard_page.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome, Admin!</h1>

        <h2>Registered Students</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><a href="deleteStudent.php?id=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete this student?');">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Add Student Grades</h2>
        <form action="addGrade.php" method="post">
            <table>
                <tr>
                    <td>Select Student:</td>
                    <td>
                        <select name="student_id" required>
                            <option value="">Select a student</option>
                            <?php
                            $students = $conn->query("SELECT id, username FROM users WHERE user_type = 'student'");
                            while ($student = $students->fetch_assoc()) {
                                echo "<option value='{$student['id']}'>{$student['username']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td><input type="text" name="subject" required></td>
                </tr>
                <tr>
                    <td>Grade:</td>
                    <td><input type="text" name="grade" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Add Grade"></td>
                </tr>
            </table>
        </form>

        <h2>Existing Grades</h2>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($grade_row = $grades_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $grade_row['username']; ?></td>
                        <td><?php echo $grade_row['subject']; ?></td>
                        <td><?php echo $grade_row['grade']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
