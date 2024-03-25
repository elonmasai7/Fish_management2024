<?php
// Connect to the database
include('connectDB.php');

// Check if a POST request was sent with login credentials
if (isset($_POST['SignIn'])) {
    $username = $_POST['inputUser'];
    $password = $_POST['inputPassword'];

    // Authenticate the user with the database (replace with your actual authentication logic)
    // This example assumes a table named "users" with columns "username" and "password"
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($result) > 0) {
        // User is authenticated, set a session variable and redirect to the main page
        session_start();
        $_SESSION['loggedin'] = true;
        header("Location: main_page.php"); // Replace "main_page.php" with the actual path to your main page
        exit();
    } else {
        // Invalid username or password, display an error message
        echo "<h4>Invalid username or password.</h4>";
    }
}

// Close the database connection
include('connectClose.php');
?>
