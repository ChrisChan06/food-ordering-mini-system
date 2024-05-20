<?php include('partials/menu.php');?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br/>

            <?php
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorized'])) {
                    echo $_SESSION['unauthorized'];
                    unset($_SESSION['unauthorized']);
                }

                if(isset($_SESSION['update'] )) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

            ?>
            <br/> <br/>

            <!-- Button to add Food -->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

            <br/> <br/> <br/>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    // Query to get all food items from the database
                    $sql = "SELECT * FROM tbl_food";

                    // Execute query
                    $res = mysqli_query($conn, $sql);

                    // Check if query executed successfully
                    if($res) {
                        // Count the number of rows returned by the query
                        $count = mysqli_num_rows($res);

                        if($count > 0) {
                            // If food items are found, display them in a table
                            $sn = 1; // Serial number counter

                            // Loop through each row of the result set
                            while($row = mysqli_fetch_assoc($res)) {
                                // Retrieve data from the current row
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                // Display the food item details in a table row
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php
                                            if($image_name == "") {
                                                // If no image is available, display an error message
                                                echo "<div class='error'>Image not Added</div>";
                                            } else {
                                                // If an image is available, display it
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" height="130" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <!-- Links to update and delete food items -->
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            // If no food items are found, display a message
                            ?>
                            <tr>
                                <td colspan="7"><div class="error">No Food Items Found</div></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // If query execution fails, display an error message
                        ?>
                        <tr>
                            <td colspan="7"><div class="error">Failed to fetch food items</div></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>

        </div>
    </div>
    <!-- Main Content Section Ends -->
    
<?php include('partials/footer.php');?>
