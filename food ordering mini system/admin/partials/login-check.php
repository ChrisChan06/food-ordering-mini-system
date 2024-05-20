<?php
// Authorization Access Control

// Check whether the user is logged in or not
if (!isset($_SESSION['user'])) {
    // IF user session is not set
    // User is not logged in

    // Set a message to inform the user to login to access the Admin Panel
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";

    // Redirect the user to the login page
    header('location: ' . SITEURL . 'admin/login.php');

    // Stop further execution after redirection
    exit;
}
?>

