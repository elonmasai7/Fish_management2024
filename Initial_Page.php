<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Initial Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-login-form.css">
</head>

<style>
    body {
        position: relative;
        background-image: url("images/sea_background_image.jpg");
        background-color: #9fcdff;
        background-size: cover;
        font-family: "Calibri";
    }

    .hero-image {
        top: 20px;
        background-image: url("images/header_fishes_image.jpg");
        background-color: #cccccc;
        max-width: 1000px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        margin: auto;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .hero-text {
        text-align: center;
        position: relative;
        background: rgba(0, 0, 0, 0.5);
        padding-top: 40px;
        padding-bottom: 40px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .body-box {

        background-color: #2e6da4;
        max-width: 1000px;
        margin: auto;
        align-content: center;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;

    }

</style>



<body>

    <div class="hero-image">
        <div class="hero-text">
            <h1 style="font-size:75px; color: white; text-decoration: aqua;">
                <b>Fishery Management System</b>
            </h1>
        </div>

    </div>

    <div class="body-box">
        <div style="background-color: white; ">
            <h1>
                <div class="btn-group-lg btn-group-justified">
                    <a href="Browsing_Page.php" class="btn btn-light">Browse Inventory</a>                    
                    <a href="Orders_Page.php" class="btn btn-light">Place Order</a>
                    <a href="User_Profile.php" class="btn btn-light">User Profile</a>
                    <a href="Register_Page.php" class="btn btn-light">Register Account</a>
                    <a href="Login_Page.php" class="btn btn-light">Login</a>
                    <a href="Admin_Panel.php" class="btn btn-light">Admin Panel</a>
                    

                </div>
            </h1>
        </div>

    <div class="body-content" style="padding: 20px; margin: auto; color: white">

        <h2>

        Welcome, 

        <?php echo $_SESSION["Username"]; ?>

        <br>Click on Browse Fish to check our stock.
        <br>Click on Order to place an order with us.
        <br>Click on Profile to change your User Info.

        </h2>

    </div>

        <form id="form-signin" action="Initial_Page.php" method="post">
            <button type="submit" name="Logout" class="btn btn-lg btn-primary btn-block" value="Logout">Logout</button>
        </form>

        <?php

        if(isset($_POST['Logout'])) {
            session_destroy();
        }

        ?>

    </div>


</>
</html>