<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pizza";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the "Clear" button clicks
if (isset($_POST['clear_orders'])) {
    $clearOrders = "DELETE FROM orders";
    if ($conn->query($clearOrders) === TRUE) {
        echo "<div class='alert alert-success'>Orders table cleared successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error clearing orders table: " . $conn->error . "</div>";
    }
}

if (isset($_POST['clear_customer_totals'])) {
    $clearCustomerTotals = "DELETE FROM customer_totals";
    if ($conn->query($clearCustomerTotals) === TRUE) {
        echo "<div class='alert alert-success'>Customer totals table cleared successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error clearing customer totals table: " . $conn->error . "</div>";
    }
}

// if (isset($_POST['clear_users'])) {
//     $clearUsers = "DELETE FROM users";
//     if ($conn->query($clearUsers) === TRUE) {
//         echo "<div class='alert alert-success'>Users table cleared successfully!</div>";
//     } else {
//         echo "<div class='alert alert-danger'>Error clearing users table: " . $conn->error . "</div>";
//     }
// }

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clear Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: lightgray;
            color: black;
        }
        .container {
            margin-top: 50px;
        }
        .btn + .btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Clear Database Tables</h2>
    <p class="text-center">Click the buttons below to clear the relevant tables.</p>

    <form method="POST" action="">
        <div class="text-center">
            <button type="submit" name="clear_orders" class="btn btn-danger">Clear Orders Table</button>
            <button type="submit" name="clear_customer_totals" class="btn btn-warning">Clear Customer Totals Table</button>
            <!-- <button type="submit" name="clear_users" class="btn btn-secondary">Clear Users Table</button> -->
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-primary">Back to Order Form</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
