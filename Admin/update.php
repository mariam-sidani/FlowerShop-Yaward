<?php
// Include database connection file
include('Config.php');

// Initialize variables
$message = '';

// Handle form submission to update the product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $previous_name = $_POST['previous_name'];
    $new_name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    // Check if the product with the previous name exists
    $sql = "SELECT * FROM products WHERE name = '$previous_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Update the product with new details
        $update_sql = "UPDATE products 
                       SET name = '$new_name', price = '$price', discount = '$discount', description = '$description'
                       WHERE name = '$previous_name'";

        if (mysqli_query($conn, $update_sql)) {
            $message = "Product updated successfully!";
        } else {
            $message = "Error updating product: " . mysqli_error($conn);
        }
    } else {
        $message = "Product with the name '$previous_name' not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        /* Centering the content */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], textarea {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            color: green;
            text-align: center;
            margin-top: 20px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }

    </style>
</head>
<body>

<div class="form-container">
<h2>
    Update Product &nbsp;&nbsp;&nbsp;     
    <a href="add.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Add</a>
    <a href="delete.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Delete</a>
    <a href="../logout.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Logout</a>

</h2>

<?php if ($message): ?>
    <div class="<?php echo strpos($message, 'Error') !== false ? 'error' : 'message'; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form action="update.php" method="POST">
    <label for="previous_name">Previous Product Name:</label>
    <input type="text" id="previous_name" name="previous_name" required>

    <label for="name">New Product Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="price">New Price:</label>
    <input type="number" id="price" name="price" step="0.01" required>

    <label for="discount">New Discount (%):</label>
    <input type="text" id="discount" name="discount">

    <label for="description">New Description:</label>
    <textarea id="description" name="description"></textarea>

    <input type="submit" value="Update Product">
</form>
</div>

</body>
</html>
