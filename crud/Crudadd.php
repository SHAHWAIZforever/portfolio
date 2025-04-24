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

// DB Connection
$host = 'localhost';
$db_username = 'root';
$db_password = '';
$dbname = 'aacc';

$conn = new mysqli($host, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add missing columns if needed
$conn->query("ALTER TABLE clients ADD COLUMN IF NOT EXISTS profile_image VARCHAR(255) DEFAULT NULL");
$conn->query("ALTER TABLE clients ADD COLUMN IF NOT EXISTS course VARCHAR(255) DEFAULT NULL");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];
    $course  = $_POST['course'];

    $imageName = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $imageName = $_FILES['profile_image']['name'];
        $tempPath = $_FILES['profile_image']['tmp_name'];
        $uploadPath = 'uploads/' . basename($imageName);
        move_uploaded_file($tempPath, $uploadPath);
    }

    $sql = "INSERT INTO clients (name, email, phone, address, profile_image, course)
            VALUES ('$name', '$email', '$phone', '$address', '$imageName', '$course')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #000;
            margin: 0;
        }

        /* Sidebar Desktop */
        nav.sidebar {
            padding-top: 50px;
            color: white;
            display: grid;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color:grey;
            width: 30%;
        }

        nav.sidebar ul {
            transform: translateX(20px);
        }

        nav.sidebar ul > li {
            font-size: 2rem;
            font-family: Arial, Helvetica, sans-serif;
        }

        nav.sidebar ul > li:hover {
            background: red;
            display: grid;
            place-items: center;
            border-radius: 4px;
            padding: 0 !important;
            transform: translateX(-30px);
        }

        nav.sidebar ul > li > a {
            text-decoration: none;
            color: white;
        }

        /* Mobile Top Navbar */
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

        form {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            padding: 1rem;
            border-radius: 10px;
        }

        h2 {
            color: white;
            text-shadow: 2px 2px 4px black;
        }

        input, label {
            color: white !important;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            background: none;
            color: white;
        }

        input:focus {
            outline: 2px solid white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        #profilePreview {
            width: 200px;
            height: 200px;
            margin-top: 20px;
            border-radius: 50%;
            border: 1px solid white;
            object-fit: contain;
        }

        .btn {
            margin-top: 10px;
        }
        input{
            color: black !important;
        }
    </style>
</head>
<body>

<!-- Mobile Navbar -->
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
    <h2 class="text-center mb-4">Add New Student</h2>

    <center>
        <div id="imagePreviewContainer"></div>
    </center>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" required>
        </div>
        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(event)">
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const imagePreview = document.createElement('img');
            imagePreview.src = reader.result;
            imagePreview.id = 'profilePreview';
            document.getElementById('imagePreviewContainer').innerHTML = '';
            document.getElementById('imagePreviewContainer').appendChild(imagePreview);
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
