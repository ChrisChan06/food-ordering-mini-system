<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <!-- Display session message if set -->
        <?php
            // Check if session 'add' is set
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Remove session message to prevent displaying again
            }
        ?>

        <!-- Add Admin Form -->
        <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process form data and save in database
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Insert data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$fullname',
            username= '$username',
            password= '$password'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Redirect based on query result
        if ($res == TRUE) {
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>"; // Success message
            header("location:" .SITEURL.'admin/manage-admin.php'); // Redirect to manage admin page
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>"; // Error message
            header("location:" .SITEURL.'admin/add-admin.php'); // Redirect to add admin page
        }
    } 
?>
