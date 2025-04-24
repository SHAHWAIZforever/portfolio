<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $username = 'admin';
    $password = '123';

    if ($user == $username && $pass == $password) {
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $pass;

        header('Location: index.php');
        exit;
    } else {
        echo "<div class='error'>Invalid username or password!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
        * {
        box-sizing: border-box;
    }

    body {
        background: #111;
        color: #fff;
        font-family: 'Arial', sans-serif;
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
    }

    h1 {
        font-size: 2rem;
        color: #00cc99;
        margin-bottom: 20px;
        text-align: center;
    }

    form {
        width: 100%;
        max-width: 360px;
        background: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 204, 153, 0.2);
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    input {
        background: #222;
        border: 1px solid #00cc99;
        padding: 10px;
        color: #fff;
        border-radius: 8px;
        font-size: 1rem;
    }

    input:focus {
        outline: none;
        border-color: #00cc99;
        background: #2b2b2b;
    }

    button {
        background: #00cc99;
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #009977;
    }

    .error {
        color: #ff4444;
        font-size: 1rem;
        text-align: center;
    }

    @media (max-width: 500px) {
        h1 {
            font-size: 1.5rem;
        }

        form {
            padding: 15px;
            width: 100%;
        }

        input,
        button {
            font-size: 1rem;
            padding: 10px;
        }
    }
    </style>
</head>
<body>

<script>
    alert('Username: admin    Password: 123')
</script>

    <h1>Login</h1>

    <form method="POST" action="" class="box">
        <input type="text" name="username" required placeholder="Enter Username">
        <input type="password" name="password" required placeholder="Enter Password">
        <button type="submit">Login</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            gsap.set(".box", { rotation: 540, x: -1500 });
            gsap.to(".box", { rotation: 0, x: 0, duration: 2.5 });
        });
    </script>
</body>
</html>
