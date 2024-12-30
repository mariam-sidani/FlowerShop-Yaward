<?php

include('Config.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];

     $sql = "DELETE FROM products WHERE name = '$name'";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            $message = "Product deleted successfully!";
        } else {
            $message = "No product found with the given name.";
        }
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
       
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

        input[type="text"] {
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
            background-color:rgb(26, 129, 29);
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
    <h2>Delete a Product&nbsp;&nbsp;&nbsp;     
    <a href="add.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Add</a>
    <a href="update.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Update</a>
    <a href="../logout.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Logout</a>
    </h2>

    <?php if ($message): ?>
        <div class="<?php echo strpos($message, 'Error') !== false || strpos($message, 'No product') !== false ? 'error' : 'message'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form action="delete.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <input type="submit" value="Delete Product">
    </form>
</div>
</body>
</html>
