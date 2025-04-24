<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + 300, "/");

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'aacc';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $client_id = $_GET['id'];

    $sql = "SELECT * FROM clients WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        echo "Client not found.";
        exit;
    }
} else {
    echo "No client ID provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $course = $_POST['course'];

    $imageName = $client['profile_image'];

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $imageName = $_FILES['profile_image']['name'];
        $imageTempPath = $_FILES['profile_image']['tmp_name'];
        $imagePath = 'uploads/' . basename($imageName);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($_FILES['profile_image']['type'], $allowedTypes)) {
            if (!move_uploaded_file($imageTempPath, $imagePath)) {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid image type. Only JPG, JPEG, PNG are allowed.";
            exit;
        }
    }

    $update_sql = "UPDATE clients SET name=?, email=?, phone=?, address=?, profile_image=?, course=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssi", $name, $email, $phone, $address, $imageName, $course, $client_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #000;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 100px auto 40px auto;
            padding: 2rem 1rem;
            position: relative;
        }

        form {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 10px;
        }

        h2 {
            color: white;
            text-shadow: 2px 2px 4px black;
            text-align: center;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid white;
            margin-top: 20px;
        }

        .form-control, .btn {
            background: none;
            color: white;
            border: 1px solid #fff;
        }

        .form-control:focus, .btn:focus {
            background-color: rgba(255, 255, 255, 0.1);
            outline: 2px solid #fff;
        }

        nav.sidebar {
            padding-top: 50px;
            color: white;
            display: grid;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: grey;
            width: 25%;
            min-width: 200px;
            z-index: 100;
        }

        nav.sidebar ul {
            padding-left: 20px;
            list-style: none;
        }

        nav.sidebar ul li {
            font-size: 1.5rem;
            font-family: Arial, Helvetica, sans-serif;
            margin: 20px 0;
        }

        nav.sidebar ul li:hover {
            background: red;
            padding: 10px;
            border-radius: 4px;
            transform: translateX(-10px);
            transition: 0.3s ease;
        }

        nav.sidebar ul li a {
            text-decoration: none;
            color: white;
        }
        .container{
            margin-right: 100px;
        }

        @media (max-width: 768px) {
            nav.sidebar {
                display: none;
            }

            .container {
                margin-top: 120px;
                width: 90%;
                margin-left: 20px;
            }

            .profile-img {
                width: 120px;
                height: 120px;
            }

            form {
                padding: 1rem;
            }
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #333;
        }

        * {
            color: white !important;
        }

        input {
            color: white !important;
        }
    </style>
</head>
<body>

    <!-- Mobile Navbar -->
    <nav class="navbar navbar-expand-md bg-dark d-md-none">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Admin Panel</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-light"></span>
            </button>
            <div class="collapse navbar-collapse" id="mobileNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
        </div>
    </nav>

    <!-- Desktop Sidebar -->
    <nav class="sidebar d-none d-md-grid">
        <ul>
            <li><a href="index.php">Admin Page</a></li>
            <li><a href="Crudadd.php">ADD Student</a></li>
            <li><a href="Crudsearch.php">Search Record</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center mb-4">Update Student</h2>

        <div class="text-center mb-4">
            <?php
            $imagePath = !empty($client['profile_image']) ? 'uploads/' . htmlspecialchars($client['profile_image']) : 'uploads/default.jpg';
            ?>
            <img src="<?php echo $imagePath; ?>" alt="Profile Image" class="profile-img">
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($client['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($client['address']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" value="<?php echo htmlspecialchars($client['course']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                <small class="form-text text-muted">Leave empty if you don't want to change the profile image.</small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
