<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Add a new category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name]);
    echo "Category added successfully!";
}

// Delete a category
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);
    echo "Category deleted successfully!";
}

// Fetch all categories
$sql = "SELECT * FROM categories";
$stmt = $conn->query($sql);
$categories = $stmt->fetchAll();
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
        <h2>Manage Categories</h2>
        <form method="POST" action="categories.php">
            <input type="text" name="name" placeholder="Category Name" required>
            <button type="submit" name="add_category">Add Category</button>
        </form>

        <h2>Existing Categories</h2>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?= $category['name'] ?></td>
                    <td><a href="categories.php?delete=<?= $category['id'] ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <a href="dashboard.php">Back to Dashboard</a>

    </div>
</body>

</html>