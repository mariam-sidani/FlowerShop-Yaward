<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>



        <a href="#" class="logo">Ya<span>ward</span></a>
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#products">Products</a>
            <a href="login.php">Login</a>
        </nav>
       
    </header>

    <section class="home" id="home">
        <div class="content">
            <h3>fresh flowers</h3>
            <span>natural and beautiful flowers</span>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod culpa earum id, voluptatem debitis illo?
                Debitis vitae ratione cupiditate dicta autem facere quae repellendus ullam illum, adipisci quaerat fugit
                eveniet!
            </p>
            <a href="#products" class="btn">shop now</a>
        </div>
    </section>


    <section class="about" id="about">
        <h1 class="heading"><span>about</span>us</h1>
        <div class="row">
            <div class="video-container">
                <video src="wedd.mp4" loop autoplay muted></video>
                <h3>best flower sellers</h3>
            </div>
            <div class="content">
                <h3>why choose us?</h3>
                <p>"I chose *Yaward* because of their exceptional quality of flowers and the personalized service I
                    received. Every bouquet I’ve ordered has been stunning and fresh, and their team always goes the
                    extra mile to ensure everything is perfect. Their convenient online ordering and reliable delivery
                    make them my go-to for every occasion."</p>
                <p>At Yaward, we take pride in curating a diverse selection of exquisite flowers that are perfect for
                    any occasion. Our passion for floral artistry shines through in every bouquet and arrangement we
                    create, ensuring that each customer receives a stunning result that exceeds expectations. Whether
                    you're celebrating a milestone, expressing gratitude, or simply brightening someone's day, our
                    dedication to quality and craftsmanship ensures that your floral gift from Yaward leaves a lasting
                    impression.</p>
                <a href="#" class="btn">learn more</a>
            </div>
        </div>
    </section><section class="products" id="products">
    <h1 class="heading">latest <span>products</span></h1>
    <div class="box-container">
  

    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flowers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $discount = $row['discount'] ? '-' . $row['discount'] . '%' : '';
        $image_url = 'Admin/uploads/' . $row['image_url'];  
        $name = $row['name'];
        $price = '$' . number_format($row['price'], 2);
        $id = $row['id'];  
        
        echo "
        <div class='box'>
            <span class='discount'>$discount</span>
            <div class='image'>
                <img src='$image_url' alt='$name'>  <!-- Display the image from the uploads directory -->
                <div class='icons'>
                        <a href='#' class='fas fa-heart'></a>
                        <a href='buy.php?product_id=$id' class='cart-btn'>Add to Cart</a>

  

                        <a href='#' class='fas fa-share' id='share-btn'></a>
                    </div>
            </div>
            <div class='content'>
                <h3>$name</h3>
                <div class='price'>$price</div>
            </div>
        </div>";
    }
} else {
    echo "No products found.";
}

$conn->close();
?>



    </div>
</section>

</body>

</html>
