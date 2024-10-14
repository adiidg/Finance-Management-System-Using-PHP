<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch income transactions
$sql_income = "SELECT i.*, c.name AS category_name FROM income i
               JOIN categories c ON i.category_id = c.id
               WHERE i.user_id = ?";
$stmt_income = $conn->prepare($sql_income);
$stmt_income->execute([$user_id]);
$incomes = $stmt_income->fetchAll();

// Fetch expense transactions
$sql_expense = "SELECT e.*, c.name AS category_name FROM expenses e
                JOIN categories c ON e.category_id = c.id
                WHERE e.user_id = ?";
$stmt_expense = $conn->prepare($sql_expense);
$stmt_expense->execute([$user_id]);
$expenses = $stmt_expense->fetchAll();
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
        <h2>Income Transactions</h2>
        <table border="1">
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Description</th>
            </tr>
            <?php foreach ($incomes as $income) { ?>
                <tr>
                    <td><?= $income['date'] ?></td>
                    <td><?= $income['category_name'] ?></td>
                    <td><?= $income['amount'] ?></td>
                    <td><?= $income['description'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <h2>Expense Transactions</h2>
        <table border="1">
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Description</th>
            </tr>
            <?php foreach ($expenses as $expense) { ?>
                <tr>
                    <td><?= $expense['date'] ?></td>
                    <td><?= $expense['category_name'] ?></td>
                    <td><?= $expense['amount'] ?></td>
                    <td><?= $expense['description'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>

</html>