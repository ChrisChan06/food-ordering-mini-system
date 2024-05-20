<?php include('partials/menu.php');?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br>

        <?php
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
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="22" rows="3" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php
                            // Create PHP code to display categories from the database

                            // 1. Create SQL to get all active categories from the database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            // Execute the query
                            $res = mysqli_query($conn, $sql);

                            // Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            // If count is greater than zero, we have categories, else we don't have categories
                            if ($count > 0) {
                                // We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $title = $row['title'];
                                    
                                    ?>
                                    <!-- Display categories in a dropdown -->
                                    <option value="<?php echo $category_id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <!-- We do not have categories -->
                                <option value='0'>No Category Found</option>
                                <?php
                            }
                        ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>            
        </form>

        <?php
            // Check whether the button is clicked or not
            if(isset($_POST['submit'])) {
                // Add the Food in Database
                // echo "Clicked";
                
                // 1. Get the Data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                // Initialize $image_name
                $image_name = "";

                // Check whether radio button for featured is checked or not
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No"; // Setting the Default Value
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No"; // Setting the Default Value
                }


                // 2. Upload the Image if selected
                // Check whether the select image is clicked or not and upload image only if the image is selected
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
                        $image_name = "Food_Name_".rand(000, 999).'.'.$ext; // e.g "Food_Category_111.jpg"
        
                        $source_path = $_FILES['image']['tmp_name'];
        
                        $destination_path = "../images/food/".$image_name; // Provide your destination path here
        
                        //upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
        
                        //check whether the file is uploaded or not; if the image is not uploaded, will stop the process and redirect with error message
                        if($upload==false) {
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    } 
                } else {
                    $image_name ="";
                }

                // 3. Insert Into Database
                //Create an SQL Query to Save or Add Food
                $sql = "INSERT INTO tbl_food SET
                title ='$title',
                description ='$description',
                price =$price,
                image_name ='$image_name',
                category_id =$category,
                featured ='$featured',
                active ='$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql);

                //Check whether data inserted or not
                // 4. Redirect with Message to Manage Food page
                if($res2==true) {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                } else {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food. </div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                }
            }
        ?>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php');?>
