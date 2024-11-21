<?php
session_start();
require 'db.php';

$adminError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adminId'])) {
    $username = $_POST['adminId'];
    $password = $_POST['adminPassword'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $adminError = "Invalid password.";
        }
    } else {
        $adminError = "No user found with that ID.";
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin_login_page.css">
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <?php if ($adminError): ?>
            <div class="error-message"><?php echo $adminError; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="adminId">Username:</label>
            <input type="text" name="adminId" required>
            
            <label for="adminPassword">Password:</label>
            <input type="password" name="adminPassword" required>
            
            <button type="submit">Login</button>
            <p><a href="admin_registration.php">Sign up</a></p>
            <p><a href="index.html">Home</a></p>
        </form>
    </div>
</body>
</html>