<?php
session_start();
require 'db.php';

$studentError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['studentId'])) {
    $username = $_POST['studentId'];
    $password = $_POST['studentPassword'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            header("Location: student_dashboard.php");
            exit();
        } else {
            $studentError = "Invalid password.";
        }
    } else {
        $studentError = "No user found with that ID.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="css/student_login_page.css">
</head>
<body>
    <div class="container">
        <h1>Student Login</h1>
        <?php if ($studentError): ?>
            <div class="error-message"><?php echo $studentError; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="studentId">username:</label>
            <input type="text" name="studentId" required>
            
            <label for="studentPassword">Password:</label>
            <input type="password" name="studentPassword" required>
            
            <button type="submit">Login</button>
            <p><a href="student_registration.php">Sign up</a></p>
            <p><a href="index.html">Home</a></p>
        </form>
    </div>
</body>
</html>