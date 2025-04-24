<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoaudit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
  echo "Please fill in all required fields.";
  exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Execute and respond
if ($stmt->execute()) {
  echo "✅ Message sent successfully! Thank you, " . htmlspecialchars($name) . ".";
} else {
  echo "❌ Error: " . $stmt->error;
}

// Close
$stmt->close();
$conn->close();
?>
