<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Ordering Mini System</title>
        <link rel="stylesheet" href="../css/a.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }

            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="#" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <!-- Login Form Ends Here -->
            <br>

            <p class="text-center">Created By - <a href="">Chanchan</a></p>
        </div>
    </body>
</html>

<?php
// Check whether the Submit Button is Clicked or NOT 
if (isset($_POST['submit'])) {
    // Process for Login
    // Get the Data from Login form 
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
    // Execute the Query 
    $res = mysqli_query($conn, $sql);

    // Check if the connection is successful
    if (!$res) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1){
        //User available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; // to check whether the user is logged in or not

        //Redirect to Home Page/Dashboard
        header('location:'.SITEURL.'admin/index.php');
    } else {
         //User not available and login failed
         $_SESSION['login'] = "<div class='error text-center'>Username or Password did not Match.</div>";
         //Redirect to Home Page/Dashboard
         header('location:'.SITEURL.'admin/login.php');
    }
}
?>
