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
            $path = "../images/category/".$image_name;
            
            // Remove the image
            $remove = unlink($path);

            // Check if image removal was successful
            if($remove == false) {
                // Failed to remove image
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                // Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop further execution
                die();
            }
        }

        // Delete Data from Database
        // SQL Query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the data successfully deleted from database or not
        if($res == true) {
            // Query executed successfully and category deleted
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            // Set Failed Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    } else {
        // Redirect to Manage Category Page
        
    }
?>
