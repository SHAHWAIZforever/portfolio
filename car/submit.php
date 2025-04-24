<?php
// Database connection
$host = "localhost";
$user = "root";
$password = ""; // Update with your DB password if any
$dbname = "autoaudit";

// Connect to database
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vin = $_POST['vin'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Simple validation
    if (empty($vin) || empty($phone) || empty($email)) {
        die("⚠️ All fields are required.");
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO vin_requests (vin, phone, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $vin, $phone, $email);

    if ($stmt->execute()) {
        echo "✅ VIN Check request submitted successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "🚫 Invalid request method.";
}

$conn->close();
?>
