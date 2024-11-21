<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO users (username, password, email, user_type) VALUES ('$username', '$password', '$email', 'student')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New student added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: admin_dashboard.php");
}
?>