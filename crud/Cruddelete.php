<?php
session_start();

// ===== LOGIN PROCESSING =====
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input values
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Hardcoded credentials
    $correctUsername = 'admin';
    $correctPassword = '123';

    if ($user === $correctUsername && $pass === $correctPassword) {
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $pass;

        // Redirect to dashboard
        header('Location: index.php');
        exit;
    } else {
        echo "<script>alert('Invalid username or password!'); window.location.href='login.php';</script>";
        exit;
    }
}
?>

<?php
// ===== CLIENT DELETE PROCESSING =====

// Only process deletion if a user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    echo "<script>alert('You must be logged in to perform this action.'); window.location.href='login.php';</script>";
    exit;
}

// Connect to DB
$host = 'localhost';
$db_username = 'root';
$db_password = '';
$dbname = 'aacc'; // Changed to lowercase 'crud'

$conn = new mysqli($host, $db_username, $db_password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete client if ID is provided
if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']); // Sanitize the ID

    $delete_sql = "DELETE FROM clients WHERE id = $client_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Client deleted successfully!'); window.location.href='Crud.php';</script>";
    } else {
        echo "Error deleting client: " . $conn->error;
    }
} else {
    echo "No client ID provided.";
}

$conn->close();
?>
