<?php

session_start();

//Constants to store non repeating values
define('SITEURL', 'http://localhost/food%20ordering%20mini%20system/');
define('LOCALHOST', 'localhost');
define('DB_ROOT', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-ordering-mini-system');

// Execute Query and Save Data in Database
$conn = mysqli_connect(LOCALHOST, DB_ROOT, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
// This connects to the MySQL server using defined constants for localhost, root, and an empty password.
// If the connection fails, the script will display a user-friendly error message.

$db_select = mysqli_select_db($conn, DB_NAME) or die("Database selection failed: " . mysqli_error($conn));
// This selects the database named 'food-ordering-mini-system' using the defined constant.
// If the database selection fails, the script will display a user-friendly error message.

?>
