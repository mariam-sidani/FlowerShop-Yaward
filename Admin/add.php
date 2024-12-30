<?php

include('Config.php');


$upload_dir = 'uploads/';


$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_name = $_FILES['image_url']['name'];
        $image_tmp_name = $_FILES['image_url']['tmp_name'];
        $image_size = $_FILES['image_url']['size'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

       
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($image_ext), $allowed_exts)) {
            
            $new_image_name = uniqid() . '.' . $image_ext;

            
            if (move_uploaded_file($image_tmp_name, $upload_dir . $new_image_name)) {
                
                $sql = "INSERT INTO products (name, price, discount, image_url, description) 
                        VALUES ('$name', '$price', '$discount', '$new_image_name', '$description')";

                if (mysqli_query($conn, $sql)) {
                    $message = "Product added successfully!";
                } else {
                    $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                $message = "Error uploading the image.";
            }
        } else {
            $message = "Invalid image format. Please upload JPG, JPEG, PNG, or GIF images.";
        }
    } else {
        $message = "No image selected or there was an error with the image upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
   
</head>
<body>

<div class="form-container">
<h2>
    Add a New Product &nbsp;&emsp;     
    <a href="update.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Update</a>
    <a href="delete.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Delete</a>
    <a href="../logout.php" style="font-size: 16px; margin-left: 20px; color: #007BFF; text-decoration: none;">Logout</a>
</h2>

    

    <?php if ($message): ?>
        <div class="<?php echo strpos($message, 'Error') !== false ? 'error' : 'message'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form action="add.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="discount">Discount (%):</label>
        <input type="text" id="discount" name="discount">

        <label for="image_url">Image:</label>
        <input type="file" id="image_url" name="image_url" accept="image/*" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>

        <input type="submit" value="Add Product">
    </form>
</div>

</body>
</html>
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

        input[type="text"], input[type="number"], textarea {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }

        input[type="file"] {
            margin-bottom: 15px;
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