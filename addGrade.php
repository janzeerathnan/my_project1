<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = intval($_POST['student_id']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);

    $sql = "INSERT INTO grades (user_id, subject, grade) VALUES ('$student_id', '$subject', '$grade')";

    if ($conn->query($sql) === TRUE) {
        echo "Grade added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: admin_dashboard.php");
}
?>