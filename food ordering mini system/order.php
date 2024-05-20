<?php include('partials-front/menu.php'); ?>

<?php
// Check whether food id is set or not
if (isset($_GET['food_id'])) {
    // Get the Food id and details of the selected food
    $food_id = $_GET['food_id'];

    // Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // Count the rows
    $count = mysqli_num_rows($res);

    // Check whether the data is available or not
    if ($count == 1) {
        // We have data
        // Get the data from database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // No data found for the provided food id
        // Redirect to homepage
        header('location:'.SITEURL);
        exit(); // Ensure script execution stops after redirection
    }
} else {
    // Food id is not set, redirect to homepage
    header('location:'.SITEURL);
    exit(); // Ensure script execution stops after redirection
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="order-content">
                    <div class="order-img">
                        <?php
                        // Check whether the image is available or not
                        if ($image_name == "") {
                            // Image not available
                            echo "<div class='error'>Image Not Available</div>";
                        } else {
                            // Image is available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Selected Food" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="order-details">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">₱<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter Your Name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Input Your Contact Number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Your email Please" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        // Check whether submit button is clicked or not
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; // Calculate total price
            $order_date = date("Y-m-d h:i:sa"); // Order Date
            $status = "Ordered"; // Status can be Ordered, On Delivery, Delivered, or Cancelled
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Save the order in database
            // Create SQL to save the data
            $sql2 = "INSERT INTO tbl_order SET
            food = '$food',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether the query executed successfully or not
            if ($res2 == true) {
                // Query executed and order saved
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                header('location:'.SITEURL);
            } else {
                // Failed to save order
                $_SESSION['order'] = "<div class='error'>Failed to order food.</div>";
                header('location:'.SITEURL);
            }
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
