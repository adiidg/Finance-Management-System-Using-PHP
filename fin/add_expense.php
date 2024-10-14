<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $sql = "INSERT INTO expenses (user_id, category_id, amount, date, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $category_id, $amount, $date, $description]);

    echo "Expense added successfully!";
}
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
        <form method="POST" action="add_expense.php">
            <select name="category" required>
                <option value="">Select Category</option>
                <?php
                $sql = "SELECT * FROM categories";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
            <input type="number" name="amount" placeholder="Amount" required>
            <input type="date" name="date" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit">Add Expense</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>

</html>