<?php
ob_start(); // Start output buffering

include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
        // Check whether the id is set or not
        if (isset($_GET['id'])) {
            // Get the id and other details
            $id = $_GET['id'];
            
            // Create SQL Query to get all other details
            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            
            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Count the rows to check if the id is valid or not
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                // Get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // Redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Food Not Found.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }
        } else {
            // Redirect to Manage Category
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit();
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-form">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="22" rows="3"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Display Image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" height="130" width="150px">
                            <?php
                        } else {
                            // Display error Message
                            echo "<div class='error'>Image Not Added. </div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            // Query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            // Execute the query
                            $res = mysqli_query($conn, $sql);
                            // Count rows
                            $count = mysqli_num_rows($res);
                            // Check whether category available or not
                            if ($count > 0) {
                                // Category Available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    ?>
                                    <option <?php if ($current_category == $category_id) { echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            } else {
                                // Category Not Available
                                echo "<option value='0'>Category Not Available. </option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            
            // Updating New Image if selected
            // Check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {
                // Get the Image Details
                $image_name = $_FILES['image']['name'];
                
                // Check whether the image is available or not
                if ($image_name != "") {
                    // Image Available and Upload Image
                    // Auto rename our image
                    // Get the extension of our image (.jpg, .png, .gif etc.)
                    $ext = end(explode('.', $image_name));
                    // Rename the image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name; // Provide your destination path here
                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    // Check whether the file is uploaded or not; if the image is not uploaded, will stop the process and redirect with error message
                    if ($upload == false) {
                        // Set message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        // Redirect to manage category page
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        // Stop the process
                        exit();
                    }
                    // Remove the Current Image if available
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);
                        // Check whether the image is removed or not
                        // If failed to remove, then display message and stop the process
                        if ($remove == false) {
                            // Failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image. </div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            exit(); // Stop the process
                        }
                    }
                } else {
                    // Image not selected, retain the current image
                    $image_name = $current_image;
                }
            } else {
                // Default image when button is not clicked
                $image_name = $current_image;
            }
            // Update the Database
            $sql2 = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id = $id";
            // Execute the Query
            $res2 = mysqli_query($conn, $sql2);
            // Redirect to Manage Category with Message
            // Check whether executed or not
            if ($res2 == true) {
                // Category Updated
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully. </div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            } else {
                // Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to Update Food List. </div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }
        }
        ?>
    </div>
</div>

<?php
include('partials/footer.php');
ob_end_flush(); // Flush output buffer
?>
