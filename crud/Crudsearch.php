<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + 300, "/");

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "aacc";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
        $searchTerm = trim($_POST['search']);
        $sql = "SELECT * FROM clients WHERE name LIKE ? OR address LIKE ? OR phone LIKE ? OR email LIKE ? OR course LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchWildcard = "%" . $searchTerm . "%";
        $stmt->bind_param('sssss', $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard);
        $stmt->execute();
        $result = $stmt->get_result();
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteSql = "DELETE FROM clients WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param('i', $delete_id);
    if ($deleteStmt->execute()) {
        echo "<script>alert('Record deleted successfully'); window.location='Crudsearch.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location='Crudsearch.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #000;
            display: flex;
        }

        nav {
            padding-top: 50px;
            color: white;
            display: grid;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: grey;
            width: 30%;
        }

        nav ul {
            transform: translateX(20px);
        }

        nav ul li {
            font-size: 2rem;
            font-family: Arial, Helvetica, sans-serif;
        }

        nav ul li:hover {
            background:red;
            display: grid;
            place-items: center;
            border-radius: 4px;
            transform: translateX(-30px);
        }

        nav ul li a {
            text-decoration: none;
            color: white;
        }

        @media (max-width: 768px) {
            nav {
                display: none;
            }

            .container.mt-5 {
                width: 100% !important;
                margin-top: 80px;
                position: relative;
            }
        }

        .container.mt-5 {
            width: 70%;
            position: absolute;
            right: 0;
            background: #000;
            top: 0;
        }

        h2 {
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

        .profile-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid white;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex-grow: 1;
        }

        /* Mobile Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        *{
            color: white !important;
        }
        input{
            color: black !important;
        }
    </style>
</head>
<body>



<!-- Desktop Sidebar -->
<nav class="d-none d-md-grid">
    <ul>
        <li><a href="index.php">Admin Page</a></li>
        <li><a href="Crudadd.php">ADD Student</a></li>
        <li><a href="Crudsearch.php">Search Record</a></li>
        <li><a href="logout.php">Logout</a></li>

    </ul>
</nav>

<div class="container mt-5">
    <h2>Search Students</h2>

    <div class="search-container">
        <form class="search-form" method="post" action="" onsubmit="return validateSearch()">
            <input type="text" name="search" class="form-control" placeholder="Search by Name, Address, Phone, Email, or Course" value="<?php echo htmlspecialchars($searchTerm); ?>" />
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="index.php" class="btn btn-danger">Back</a>
        </form>
    </div>

    <hr>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <?php
        $trimmed = trim($_POST['search']);
        $hasResults = ($result && $result->num_rows > 0);
        ?>

        <?php if ($trimmed === '') : ?>
            <p class="text-warning">Please enter a search term to see results.</p>

        <?php elseif ($hasResults) : ?>
            <div class='table-container'>
                <table class='table table-bordered table-striped'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Profile Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) :
                            $imagePath = !empty($row['profile_image']) ? 'uploads/' . htmlspecialchars($row['profile_image']) : 'default.jpg';
                        ?>
                            <tr>
                                <td><?= $row["id"] ?></td>
                                <td><?= htmlspecialchars($row["name"]) ?></td>
                                <td><?= htmlspecialchars($row["address"]) ?></td>
                                <td><?= htmlspecialchars($row["phone"]) ?></td>
                                <td><?= htmlspecialchars($row["email"]) ?></td>
                                <td><?= htmlspecialchars($row["course"]) ?></td>
                                <td><img src="<?= $imagePath ?>" class="profile-img" alt="Client Image"></td>
                                <td>
                                    <a href='Crudupdate.php?id=<?= $row["id"] ?>' class='btn btn-warning btn-sm'>Update</a>
                                    <a href='?delete_id=<?= $row["id"] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Are you sure you want to delete this client?")'>Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="text-white">No results found for "<strong><?= htmlspecialchars($searchTerm) ?></strong>".</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function validateSearch() {
        const input = document.querySelector('input[name="search"]').value.trim();
        if (input === "") {
            alert("Please enter a search term.");
            return false;
        }
        return true;
    }
</script>
</body>
</html>

<?php $conn->close(); ?>
