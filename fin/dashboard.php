<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome to your dashboard!";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <a href="add_income.php">Add Income</a> |
        <a href="add_expense.php">Add Expense</a> |
        <a href="view_transactions.php">View Transactions</a> |
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>