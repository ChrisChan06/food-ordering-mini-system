<?php
    // Include Constants File
    include('../config/constants.php');

    // Check whether the id and image name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        // Get the value
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        // Remove the physical image file if available
        if($image_name != "") {
            // Image is available, so remove it
            $path = "../images/food/".$image_name;

            // Debugging: Output the file path
            // Uncomment the next line for debugging purposes
            // echo "Attempting to delete file: $path";

            // Remove the image
            $remove = unlink($path);

            // Check if image removal was successful
            if($remove == false) {
                // Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Food Image</div>";
                // Redirect to Manage Food Page
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop further execution
                die();
            }
        }

        // Delete Data from Database
        // SQL Query to delete data from database
        $sql = "DELETE FROM tbl_food WHERE id = $id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the data successfully deleted from database or not
        if($res == true) {
            // Query executed successfully and food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        } else {
            // Set Failed Message
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
        }
        //Redirect to Manage Food Page
        header('location:'.SITEURL.'admin/manage-food.php');
    } else {
        // Redirect to Manage Food Page
        $_SESSION['unauthorized'] ="<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>
