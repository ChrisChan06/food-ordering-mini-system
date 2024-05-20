<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!-- Add Category Form Starts -->
        <form action="#" method="POST" enctype="multipart/form-data">
            <table class="tbl-form">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>            
        </form>

        <?php
        // Check whether the Submit Button is clicked or Not
        if(isset($_POST['submit'])) {
            // echo "Clicked";
            // 1. Get the Value from Category Form
            $title = $_POST['title'];
            
            // For Radio input, we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
                // Get the Value from form
                $featured = $_POST['featured'];
            } else {
                // Set the Default Value
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                // Get the Value from form
                $active = $_POST['active'];
            } else {
                // Set the Default Value
                $active = "No";
            }

            //check whether the image is selected or not and set the value for image name accordingly
           // print_r($_FILES['image']);
           // die();

             if(isset($_FILES['image']['name'])) {
            // Upload the Image
            // To upload an image, we need the image name, source path, and destination path
            $image_name = $_FILES['image']['name'];

            //Upload image only if the image is selected
            if($image_name != "") {
                //auto rename our image
                //get the extension of our image(.jpg, .png, .gif etc..) e.g. "special.food1.jpg"
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g "Food_Category_111.jpg"

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name; // Provide your destination path here

                //upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check whether the file is uploaded or not; if the image is not uploaded, will stop the process and redirect with error message
                if($upload==false) {
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                    //redirect to add category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                }
            }
        } else {
            // Don't Upload Image and set the image name value as blank
            $image_name = "";
            }
        
            //Create SQL Query to insert Category into database
            $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";

            //Execute Query and save it database
            $res = mysqli_query($conn, $sql);
            
            //check whether the query executed or not and data added or not
            if($res==true) {
                //Query executed and Category Added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                //Redirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
            } else {
                //failed to add Category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                //Redirect to Manage Category page
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
        ?>


    </div>
</div>


<?php include('partials/footer.php'); ?>
