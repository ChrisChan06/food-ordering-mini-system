<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        // Check whether the order ID is set or not
        if (isset($_GET['id'])) {
            // Get the order details
            $id = $_GET['id'];

            // Get the Details based on this id
            // SQL query to get order details
            $sql = "SELECT * FROM  tbl_order WHERE id=$id";

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Check if the query executed successfully
            if ($res == true) {
                // Count the rows
                $count = mysqli_num_rows($res);

                // Check whether the data is available or not
                if ($count == 1) {
                    // We have data
                    // Get the data from database
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {
                    // Details not available
                    // Redirect to Manage Order
                    header('location:' . SITEURL . 'admin/manage-order.php');
                    exit(); // Ensure script execution stops after redirection
                }
            } else {
                // Query execution failed
                echo "<div class='error'>Failed to retrieve order details.</div>";
            }
        } else {
            // Order ID is not set, redirect to Manage Order
            header('location:' . SITEURL . 'admin/manage-order.php');
            exit(); // Ensure script execution stops after redirection
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><b>₱ <?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="Ordered" <?php if ($status == "Ordered") echo "selected"; ?>>Ordered</option>
                            <option value="On Delivery" <?php if ($status == "On Delivery") echo "selected"; ?>>On Delivery</option>
                            <option value="Delivered" <?php if ($status == "Delivered") echo "selected"; ?>>Delivered</option>
                            <option value="Cancelled" <?php if ($status == "Cancelled") echo "selected"; ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><textarea name="customer_address" cols="22" rows="3"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the form is submitted
        if (isset($_POST['submit'])) {
            // Get the updated values from the form
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            // SQL query to update the order
            $sql2 = "UPDATE tbl_order SET
                price = '$price',
                qty = '$qty',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id=$id";

            // Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            // Check if the query executed successfully
            if ($res2 == true) {
                // Query executed and order updated
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit(); // Ensure script execution stops after redirection
            } else {
                // Failed to update order
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit(); // Ensure script execution stops after redirection
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
