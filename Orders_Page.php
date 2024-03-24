<?php session_start(); ?>
<?php include ('connectDB.php'); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
</head>

<style>
    body {
        top: 20px;
        position: relative;
        background-image: url("images/sea_background_image.jpg");
        background-color: #9fcdff;
        background-size: cover;
        font-family: "Calibri";
    }

    .body-box {
        background-color: #2e6da4;
        max-width: 500px;
        margin: auto;
        align-content: center;
        border-radius: 30px;
    }
</style>

<body>
<div class="body-box">
    <div style="text-align: left; color: white; margin: auto; padding-left: 10px; padding-right: 10px; padding-top: 20px; padding-bottom: 30px;">
        <h2>Welcome, <?php echo $_SESSION["Username"]; ?></h2>
        <br>
        <form id="form-signin" action="Orders_Page.php" method="post">
            <label for="FishSpecies">Fish Species</label>
            <select id="FishSpecies" name="FishSpecies" class="form-control">
                <?php
                    $fishList = $conn->query("SELECT Species FROM inventory");
                    while($rows = $fishList->fetch_assoc()){
                        $fishes = $rows['Species'];
                        echo "<option value='$fishes'>$fishes</option>";
                    }
                ?>
            </select>

            <label for="inputWeight">Amount</label>
            <input type="number" name="inputWeight" class="form-control" placeholder="Weight" required>
            <br>
            <button type="submit" name="PlaceOrder" class="btn btn-lg btn-primary btn-block" value="Submit">Place Order.</button>
        </form>

        <?php
            if(isset($_POST['PlaceOrder'])) {
                $order_id = rand(100, 999);
                $Species = $_POST['FishSpecies'];
                $Weight = $_POST['inputWeight'];
                $Date = date("Y-m-d");

                $stmt = $conn->prepare("SELECT price_per_kg FROM inventory WHERE species = ?");
                $stmt->bind_param("s", $Species);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $pricing = $row['price_per_kg'];

                $totalPrice = $Weight * $pricing;

                $Uname = $_SESSION["Username"];
                $stmt = $conn->prepare("SELECT user_id FROM customers WHERE name = ?");
                $stmt->bind_param("s", $Uname);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $Uid = $row['user_id'];

                $OrderComplete = 0;
                $fisheryID = 1000;

                $sql = "INSERT INTO orders (order_id, fish_species, order_date, total_price, order_completed, fishery_id, use_id)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssiii", $order_id, $Species, $Date, $totalPrice, $OrderComplete, $fisheryID, $Uid);

                if ($stmt->execute()) {
                    echo "Order Placed successfully";
                    header('location:Initial_Page.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    header('location:Orders_Page.php');
                }
            }
        ?>
    </div>
</div>
</body>
</html>
<?php include('connectClose.php'); ?>
