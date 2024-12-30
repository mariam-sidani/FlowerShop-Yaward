<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
    <style>
      
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            margin: 20px;
            margin-top:90px
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color:rgb(16, 121, 5);
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
            width: 48%;
            margin-right: 4%;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color:rgb(11, 77, 4);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label[style="color:red"] {
            color: red;
            font-size: 12px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .alert {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
<header>

<input type="checkbox" name="" id="toggler">
<label for="toggler" class="fas fa-bars" style="color: black;"></label>
<a href="#" class="logo">Ya<span>ward</span></a>
<nav class="navbar">
    <a href="index.php#home">Home</a>
    <a href="index.php#about">About</a>
    <a href="index.php#products">Products</a>
    <a href="login.php">Login</a>
</nav>

</header>

<div class="form-container">
    <h1>Register</h1>
   
        <?php
        session_start();
        require("config.php"); // Make sure this is included
        
        $name = $nameError = $pass = $passError = $confirm = $confirmError = '';
        
        // Form submission logic
        if(isset($_POST["btnSave"])) {
            $name = mysqli_real_escape_string($con, $_POST["Username"]);
            $pass = mysqli_real_escape_string($con, $_POST["Pass"]);
            $confirm = mysqli_real_escape_string($con, $_POST["Confirm"]);
            $isValid = true;

            // Validate username
            if($name == '') {
                $nameError = "Enter Username";
                $isValid = false;
            } else {
                $query = "SELECT * FROM users WHERE Username = '".$name."'";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0) {
                    $nameError = "Username already Exists";
                    $isValid = false;
                }
            }

            // Validate password and confirm password
            if($pass == '') {
                $passError = "Enter password";
                $isValid = false;
            } else {
                if($confirm == '') {
                    $confirmError = "Confirm the password";
                    $isValid = false;
                }
                if($pass != $confirm) {
                    $passError = "Your password doesn't match";
                    $isValid = false;
                }
            }

            // If all validations pass
            if($isValid) {
                // 1. Hash the password with SHA256
                $hash = hash("sha256", $pass);

                // 2. Generate salt
                $salt = md5(uniqid(rand(), true));
                $salt = substr($salt, 0, 3);

                // 3. Hash password and salt together
                $finalPass = hash("sha256", $hash.$salt);

                // Insert the new user into the database
                $query = "INSERT INTO Users(Username, Password, Salt, RoleId) VALUES('$name', '$finalPass', '$salt', 2)";
                $result = mysqli_query($con, $query);
                
                if(!$result) {
                    echo "<div class='alert'>Error: " . mysqli_error($con) . "</div>";
                } else {
                    echo "<div class='alert'>Successfully registered!</div>";
                    header("Location: login.php");  // Redirect to login page
                }
            }
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" id="Username" name="Username" value="<?php echo $name; ?>" required />
            <label style="color:red" id="lblError"><?php echo $nameError; ?></label>
        </div>

        <div class="form-group">
            <label for="Pass">Password</label>
            <input type="password" id="Pass" name="Pass" value="<?php echo $pass; ?>" required />
            <label style="color:red"><?php echo $passError; ?></label>
        </div>

        <div class="form-group">
            <label for="Confirm">Confirm Password</label>
            <input type="password" id="Confirm" name="Confirm" value="<?php echo $confirm; ?>" required />
            <label style="color:red"><?php echo $confirmError; ?></label>
        </div>

        <div class="btn-container">
            <input type="submit" value="Register" name="btnSave" />
            
        </div>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#Username').blur(function() {
        $.ajax({
            type: "GET",
            url: 'username_vlidation.php',
            data: { 'name': this.value },
            success: function(response) {
                $('#lblError').html(response);
            }
        });
    });
});
</script>

</body>
</html>
