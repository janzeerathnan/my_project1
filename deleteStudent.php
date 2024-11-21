<?php
session_start();
require 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // First, delete the grades associated with this student
    $delete_grades_sql = "DELETE FROM grades WHERE user_id = $id";
    $conn->query($delete_grades_sql);

    // Now, delete the student
    $delete_student_sql = "DELETE FROM users WHERE id = $id AND user_type = 'student'";

    if ($conn->query($delete_student_sql) === TRUE) {
        echo "Student and associated grades deleted successfully.";
    } else {
        echo "Error deleting student: " . $conn->error;
    }
    header("Location: admin_dashboard.php");
}
?>