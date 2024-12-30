<?php
require 'config.php'; 


if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); 

    
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $con->prepare($sql);  
    if ($stmt) {
        $stmt->bind_param("i", $product_id); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Product found
            $product = $result->fetch_assoc();
            $name = $product['name'];
            $price = $product['price'];
            $image_url = 'Admin/uploads/' . $product['image_url'];
        } else {
           
            echo "Product not found.";
            exit();
        }
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement.";
        exit();
    }
} else {
    echo "No product selected.";
    exit();
}

$con->close(); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    
</head>
<body>

    <div class="order-success">
        <h2>Thank you for your purchase!</h2>
        <p>Your order for the product <strong><?php echo $name; ?></strong> has been successfully processed.</p>
        <img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>" />
        <p class="price">Price: $<?php echo number_format($price, 2); ?></p>
        <a href="index.php" class="btn">Return to Home</a>
       
    </div>

</body>
</html>
<style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .order-success {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            margin: 50px auto;
            max-width: 600px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .order-success h2 {
            font-size: 28px;
            color:rgb(28, 136, 25); /* Green color */
            margin-bottom: 20px;
        }

        .order-success p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .order-success img {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .order-success .price {
            font-size: 24px;
            font-weight: bold;
            color:rgb(0, 0, 0); /* Green color for price */
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 12px 25px;
            background-color:rgb(34, 144, 12); /* Green button color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn:hover {
            background-color:rgb(42, 94, 11); /* Darker green on hover */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .order-success {
                width: 90%;
                padding: 20px;
            }

            .order-success img {
                width: 120px;
                height: 120px;
            }

            .order-success .price {
                font-size: 20px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>