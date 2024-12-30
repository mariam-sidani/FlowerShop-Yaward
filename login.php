<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>



        <a href="#" class="logo">Ya<span>ward</span></a>
        <nav class="navbar">
            <a href="index.php#home">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#products">Products</a>
            <a href="login.php">Login</a>
        </nav>
       
    </header>
    
    <?php
session_start();
require("config.php");
$username = $nameError = $pass = $passError = '';

if(isset($_POST["btnSave"])){ 
    $username = mysqli_real_escape_string($con, $_POST["Username"]);
    $pass = mysqli_real_escape_string($con, $_POST["Pass"]);
    $isValid = true;

    if($username == ''){
        $nameError = "Enter Username";
        $isValid = false;
    }
    if($pass == ''){
        $passError = "Enter password";
        $isValid = false;
    }

    if($isValid){
        
        if($username == "admin" && $pass == "admin_password"){ 
            $_SESSION["LoggedIN_Admin"] = 1;
            $_SESSION["Username_Admin"] = $username;
            $_SESSION["UserId_Admin"] = 1; 
            header("Location: Admin/home.php");  
            exit();
        } else {
          
            $query = "SELECT * FROM users WHERE Username='".$username."'";
            $result = mysqli_query($con, $query);

            if(!$result) die(mysqli_error()); 

            if(mysqli_num_rows($result) == 0){
                $nameError = "Invalid Username";
            } else {
           
                $row = mysqli_fetch_array($result);
               
                $hash1 = hash('sha256', $pass);
                $salt = $row["Salt"]; 
                $finalPassword = hash('sha256', $hash1.$salt);

               
                if($finalPassword == $row["Password"]){
                    if($row["RoleId"] == 1){
                        // Admin login
                        $_SESSION["LoggedIN_Admin"] = 1;
                        $_SESSION["Username_Admin"] = $username;
                        $_SESSION["UserId_Admin"] = $row["Id"];
                        header("Location: Admin/home.php");
                    }
                    else{ // Public user login
                        echo "Login Successful";
                        $_SESSION["LoggedIN"] = 1;
                        $_SESSION["Username"] = $username;
                        $_SESSION["UserId"] = $row["Id"];
                        header("Location: index.php#products");
                    }
                } else {
                    $passError = "Invalid Password";
                }
            }
        }
    }
}
?>



  <div class="login-container">
    <div class="login-form">
      <h2>Login</h2>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group">
          <label for="Username">Username</label>
          <input type="text" name="Username" value="<?php echo $username; ?>" placeholder="Enter username" />
          <label class="error"><?php echo $nameError; ?></label>
        </div>

        <div class="input-group">
          <label for="Pass">Password</label>
          <input type="password" name="Pass" value="<?php echo $pass; ?>" placeholder="Enter password" />
          <label class="error"><?php echo $passError; ?></label>
        </div>

        <div class="button-group">
          <input type="submit" value="Login" name="btnSave" class="btn-login" />
        
        </div>
      </form>

      <div class="register-link">
        Create an account <a href="register.php" class="register-btn">Creation Here</a>
      </div>
    </div>
  </div>

</body>
</html>
