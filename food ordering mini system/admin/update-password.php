<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
       
        <br><br>

        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_pass" placeholder="Old Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_pass" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_pass" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    // Check whether the Submit Button is clicked or Not
    if(isset($_POST['submit'])) {
        // 1. Get the Data from Form
        $id = $_POST['id'];
        $current_pass = $_POST['current_pass'];
        $new_pass = $_POST['new_pass'];
        $confirm_pass = $_POST['confirm_pass'];

        // 2. Check whether the user with current ID and Current Password Exists or Not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pass'";
        
        $res = mysqli_query($conn, $sql);

        if($res==true) {
            // Check whether data is available or not
            $count = mysqli_num_rows($res);

            if ($count==1) {
                // User exists and current password matches
                if($new_pass==$confirm_pass) {
                    // Update the password
                    $sql2 = "UPDATE tbl_admin SET password='$new_pass' WHERE id=$id";
                    $res2 = mysqli_query($conn, $sql2);
                    
                    if($res2==true) {
                        // Password changed successfully
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    } else {
                        // Failed to change password
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                } else {
                    // Passwords do not match
                    $_SESSION['pwd-not-match'] = "<div class='error'>Passwords did not match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            } else {
                // User does not exist
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        } else {
            // Failed to execute query
            echo "Failed to execute query.";
        }
    }

?>

<?php include('partials/footer.php'); ?>
