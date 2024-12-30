<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("config.php");  // Make sure the connection is included here

if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("Invalid product ID.");
}

$product_id = intval($_GET['product_id']);
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($con, $query);  

if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>

    <div class="product-detail">
        <img src="Admin/uploads/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image" />
      
        <div class="details">
            <h3 class="name"><?php echo htmlspecialchars($product['name']); ?></h3>
            <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>

            <div class="price-container">
                $<?php echo number_format($product['price'], 2); ?>
            </div>

            <div class="btn-container">
                <button id="checkout-btn" class="btn">Buy</button>
            </div>
            
            <br>
            <a href="index.php#products">
                <button class="btn">Back to Products</button>
            </a> 
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#checkout-btn").click(function(e){
                e.preventDefault();

                var userChoice = confirm("Are you sure you don't want to add another item?");

                if (userChoice) {
                    $.ajax({
                        type: 'POST',
                        url: 'process_checkout.php',
                        data: {action: 'checkout', product_id: <?php echo $product_id; ?>, add_more: 'no'},
                        success: function(response){
                            if(response == 'success') {
                                window.location.href = 'success.php?product_id=<?php echo $product_id; ?>';
                            } else {
                                alert("Error processing checkout.");
                            }
                        }
                    });
                } else {
                    window.location.href = "success.php?product_id=<?php echo $product_id; ?>";
                }
            });
        });
    </script>
</body>
</html>


</body>
</html>
<style>
       
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .product-detail {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 1200px;
        }

        .product-image {
            width: 40%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }

        .details {
            width: 55%;
            padding-left: 20px;
        }

        .name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .description {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2a9d8f;
        }

        .btn-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn {
            background-color:rgb(14, 122, 4);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color:rgb(11, 60, 7);
        }

        .price-container {
            font-size: 24px;
            font-weight: bold;
            color:rgb(0, 0, 0);
        }

        
        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column; /* Stack the image and details vertically */
                text-align: center;
            }

            .product-image {
                width: 60%;
                margin-bottom: 20px;
            }

            .details {
                width: 100%;
                padding-left: 0;
            }

            .btn-container {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .price {
                margin-top: 15px;
            }

            .btn {
                width: 100%;
                margin-top: 15px;
            }
        }
    </style>