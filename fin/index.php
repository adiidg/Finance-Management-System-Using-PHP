<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Management - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Welcome to Finance Management</h2>
        <p>Manage your finances effortlessly. Please log in or register to continue.</p>

        <div class="form-container">
            <!-- Login Form -->
            <form method="POST" action="login.php">
                <h3>Login</h3>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>

            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <style>
        /* Additional Styles for index.php */
        .form-container {
            margin-top: 20px;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .form-container h3 {
            margin-bottom: 15px;
            color: #e0e0e0;
        }

        .form-container p {
            margin-top: 15px;
        }
    </style>
</body>

</html>