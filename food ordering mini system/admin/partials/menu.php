<?php
    // Include configuration file for database connection and other constants
    include('../config/constants.php'); 

    // Include file to check if the user is logged in
    include('login-check.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bites and Bytes Food Order Website Home Page</title>
    <link rel="stylesheet" href="../css/a.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li> <!-- Link to the home page -->
                <li><a href="manage-admin.php">Admin</a></li> <!-- Link to manage admin page -->
                <li><a href="manage-category.php">Category</a></li> <!-- Link to manage categories page -->
                <li><a href="manage-food.php">Food</a></li> <!-- Link to manage food items page -->
                <li><a href="manage-order.php">Order</a></li> <!-- Link to manage orders page -->
                <li><a href="logout.php">Logout</a></li> <!-- Link to logout page -->
            </ul>               
        </div>
    </div>
    <!-- Menu Section Ends -->
</body>
</html>
