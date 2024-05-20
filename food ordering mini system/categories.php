<?php include('partials-front/menu.php'); ?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
            //Create SQL Query to Display Categories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                //Categories Available
                $i = 0; // Counter for clearing floats
                while($row = mysqli_fetch_assoc($res))
                {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    // Increment counter for clearing floats
                    $i++;

                    // Start a new row after every 3 categories
                    if ($i % 3 == 1) {
                        echo "<div class='clearfix'></div>";
                    }
        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //Check whether the Image is available or not
                            if($image_name=="") {
                                //Display Message
                                echo "<div class='error'>Image Not Available</div>";
                            } else {
                                //Image Available
                            ?> 
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Category_Pic" class="img-responsive img-curve">
                            <?php
                            }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
        <?php
                }
            }
            else
            {
                //Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>     
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
