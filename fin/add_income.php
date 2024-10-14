<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category'] ?? null; // Check if category is set, else set to null
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Validate if category is selected
    if ($category_id === null || $category_id === "") {
        $error = "Please select a category.";
    } else {
        try {
            $sql = "INSERT INTO income (user_id, category_id, amount, date, description) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_id, $category_id, $amount, $date, $description]);
            echo "Income added successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
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
        <h2>Add Income</h2>
        <!-- Form to Add Income -->
        <form method="POST" action="add_income.php">
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="">Select Category</option>
                <?php
                $sql = "SELECT * FROM categories";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" placeholder="Amount" required>

            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Description"></textarea>

            <button type="submit">Add Income</button>
        </form>

        <?php
        if (!empty($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>

        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>

</html>