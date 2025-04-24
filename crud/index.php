<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Set cookie
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + 300, "/"); // expires in 5 minutes

// Database connection
$host = 'localhost';
$db_username = 'root';
$db_password = '';
$dbname = 'aacc'; // Ensure this matches your actual database name

$conn = new mysqli($host, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add 'course' column if it doesn't exist
$result = $conn->query("SHOW COLUMNS FROM clients LIKE 'course'");
if ($result->num_rows == 0) {
    $alter_sql = "ALTER TABLE clients ADD COLUMN course VARCHAR(255) DEFAULT NULL";
    if (!$conn->query($alter_sql)) {
        echo "Error adding column: " . $conn->error;
    }
}

// Create 'clients' table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15),
    address TEXT,
    profile_image VARCHAR(255) DEFAULT NULL,
    course VARCHAR(255) DEFAULT NULL
)";
if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
}

// Fetch data
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admission Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #000;
        }
        /* Desktop sidebar */
        nav.sidebar {
            padding-top: 50px;
            color: white;
            display: grid;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: grey; /* Light black shade */
            width: 30%;
        }
        .navbar-brand{
            color: white !important;
        }
        nav.sidebar ul {
            transform: translateX(20px);
        }
        nav.sidebar ul > li {
            font-size: 2rem;
            font-family: Arial, Helvetica, sans-serif;
        }
        nav.sidebar ul > li:hover {
            background:red;
            display: grid;
            place-items: center;
            border-radius: 4px;
            width: fit-content;
            padding: 0% 20%;
        }
        nav.sidebar ul > li > a {
            text-decoration: none;
            color: white;
        }

        /* Mobile navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            
        }

        .container.mt-5 {
            position: absolute;
            right: 0;
            background: #000;
            padding: 1rem;
        }

        @media (min-width: 769px) {
            .container.mt-5 {
                width: 70%;
                top: 0;
            }
        }

        @media (max-width: 768px) {
            nav.sidebar {
                display: none;
            }

            .container.mt-5 {
                width: 100% !important;
                margin-top: 80px;
                position: relative;
            }
        }

        .heading {
            color: white;
            text-shadow: 2px 2px 4px black;
        }
        table {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
        }
        th, td {
            color: white;
            text-align: center;
        }
        th {
            text-shadow: 2px 2px 2px black;
        }
        .profile-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid white;
        }
        #profileimg {
            display: grid;
            place-items: center;
        }
        .btns > a {
            margin-top: 8px;
        }
        * {
            color: white !important;
        }
        a {
            color: black !important;
        }
    </style>
</head>
<body>

<!-- Mobile Top Navbar -->
<nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="mobileNav">
        <ul class="navbar-nav ms-3">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">Admin Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="Crudadd.php">ADD Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="Crudsearch.php">Search Record</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Desktop Sidebar -->
<nav class="sidebar d-none d-md-grid">
    <ul>
        <li><a class="text-white" href="index.php">Admin Page</a></li>
        <li><a class="text-white" href="Crudadd.php">ADD Student</a></li>
        <li><a class="text-white" href="Crudsearch.php">Search Record</a></li>
        <li><a class="text-white" href="logout.php">Logout</a></li>

    </ul>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <h1 class="text-center mb-4 heading">Admission Form</h1>

    <a href="Crudadd.php" class="btn btn-primary mb-3">Add Student</a>
    <a href="Crudsearch.php" class="btn btn-warning mb-3">Search Record</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Course</th><th>Image</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = $row['profile_image'] ? 'uploads/' . htmlspecialchars($row['profile_image']) : 'default.jpg';
                    echo '<tr>
                        <td>' . htmlspecialchars($row['id']) . '</td>
                        <td>' . htmlspecialchars($row['name']) . '</td>
                        <td>' . htmlspecialchars($row['email']) . '</td>
                        <td>' . htmlspecialchars($row['phone']) . '</td>
                        <td>' . htmlspecialchars($row['address']) . '</td>
                        <td>' . htmlspecialchars($row['course']) . '</td>
                        <td id="profileimg"><img src="' . $imagePath . '" class="profile-img" alt="Client Image"></td>
                        <td class="text-center btns">
                            <a href="Crudupdate.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Update</a>
                            <a href="Cruddelete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this client?\')">Delete</a>
                        </td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="8" class="text-center text-white">No clients found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
