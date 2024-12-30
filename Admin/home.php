<?php
session_start();
if(!isset($_SESSION["LoggedIN_Admin"]) || $_SESSION["LoggedIN_Admin"] != 1){
    header("Location: login.php");  
    exit();
}
$adminUsername = $_SESSION["Username_Admin"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <header>
        <h1>Welcome, <?php echo htmlspecialchars($adminUsername); ?></h1>
        
        <a href="../logout.php" class="btn logout-btn">Logout</a>
    </header>

    <div class="admin-actions">
        <h2>Admin Dashboard</h2>
        <p>What would you like to do?</p>

        
        <a href="add.php" class="btn">Add Products</a>
        <a href="update.php" class="btn">Update Record</a>
        <a href="delete.php" class="btn">Delete Record</a>
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All Rights Reserved.</p>
    </footer>

</body>
</html>

<style>
    
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}


header {
    background-color: #28a745; 
    color: white;
    padding: 20px;
    text-align: center;
}


.admin-actions {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}


h1, h2 {
    font-size: 2rem;
}


.btn {
    display: inline-block;
    background-color: #28a745; 
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #218838; 
}


footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}


@media (max-width: 768px) {
    h1, h2 {
        font-size: 1.5rem; 
    }

    .btn {
        padding: 8px 16px;
        font-size: 0.9rem;
    }

    .admin-actions {
        padding: 15px;
        margin: 15px;
    }
}

@media (max-width: 480px) {
    h1, h2 {
        font-size: 1.2rem;
    }

    .btn {
        width: 100%;
        padding: 12px;
        font-size: 1rem; 
    }
}
/* Button for Logout */
.logout-btn {
    background-color:rgb(239, 239, 239); 
    color: black;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}



</style>