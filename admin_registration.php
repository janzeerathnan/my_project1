<?php
session_start();

$registrationSuccess = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'db.php';

    $username = $_POST['username'];
    $adminId = $_POST['adminId'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("INSERT INTO users (username, user_type, password) VALUES (?, 'admin', ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $registrationSuccess = true; 
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Admin Registration</title>
    <link rel="stylesheet" href="css/admin_register_page.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Admin Registration</h1>
            <form method="POST" action="admin_registration.php" onsubmit="return validateForm()">

                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="adminId">Admin ID:</label>
                <input type="text" name="adminId" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit" class="btn">Register</button>
                <p class="signup-link"><a href="admin_login.php">Back to Login</a></p>
            </form>
        </div>
    </div>

    <?php if ($registrationSuccess): ?>
        <div class="popup" id="popup">
            <div class="popup-content">
                <p>Registration successful!</p>
                <p>Back to login to your account.</p>
                <button onclick="closePopup()">Close</button>
            </div>
        </div>
        <script>
            document.getElementById('popup').style.display = 'block';
        </script>
    <?php endif; ?>

    <script>
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function validateForm() {
            return true;
        }
    </script>
</body>

</html>
