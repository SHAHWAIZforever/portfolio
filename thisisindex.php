<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Shahwaiz Portfolio</title>
  <link href="https://fonts.googleapis.com/css2?family=Baumans&display=swap" rel="stylesheet">

 <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>

  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>

  <link rel="stylesheet" href="style.css">

</head>
<body id="home">
  
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container-fluid px-2 px-lg-0">
    <a class="navbar-brand" href="#">Reciprocal-Guy</a>

    <!-- Small screen button as link -->
    <a class="btn btn-primary rounded-pill text-dark me-2 d-lg-none cyancolor" id="smallaction" href="#projects" style="color: black !important;">
      <b>Projects</b>
    </a>

    <button class="navbar-toggler navtogg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item mx-1"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#about">About</a></li>
        
        <!-- Your custom dropdown -->
        <li class="nav-item mx-1 dropdown">
          <div class="dropdown">
            <a href="#">Soon</a>
            <div class="dropdown-content">
              <a href="#">Link 1</a>
              <a href="#">Link 2</a>
              <a href="#">Link 3</a>
            </div>
          </div>
        </li>

        <li class="nav-item mx-1"><a class="nav-link" href="#comment">Comment</a></li>

        <!-- Button on large screens -->
        <li class="nav-item mx-1 d-none d-lg-block">
          <a class="btn rounded-pill px-4 cyancolor nav-link" href="#projects" style="color: black !important;">
            <b>Projects</b>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>







<div class="container-fluid c1">
  <div class="row">
    <!-- Left Section -->
    <div class="col-lg-6">
      <h1>Hi, Its </h1>
      <h1 style="color:red;" class="name "><b>SHAHWAIZ</b></h1>
      <h2 class="autotype " id="autotype">I'm a Web Developer</h2>
      <div class="cursor"></div>
      <!-- <h6>A web developer creates and maintains websites. They build how a site looks (front-end) and works (back-end), ensuring it's fast, functional, and easy to use.</h6> -->
      <!-- Social Links -->
      <div class="social-links mt-3">
        <a href="https://wa.me/03134574191" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.instagram.com/shahwaiz_loves_tigershroff/profilecard/?igsh=aGhnb2lkdzVrOGpm" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="mailto:shahwaiztiger12@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
        <a href="https://www.linkedin.com/in/muhammed-shahwaiz-62952b35a/" target="_blank" title="LinkedIn">
  <i class="fab fa-linkedin"></i>
</a>
      </div>

      <h3><a href="#comment" class="nav-link mobilecomment fade-up">Comment</a></h3>
    </div>

    <!-- Right Section -->
    <div class="col-lg-6 d-flex justify-content-center">
      <div id="proimg" class="box">
        <img src="images/user.jpg" alt="Profile Image">
      </div>
    </div>
  </div>
</div>



<br id="about">
  <div class="container-fluid c2 ">
 <h1 class="fade-down"> <b>About</b></h1>
 <BR></BR>
 <div class="scroll-container-wrapper fade-up">
        <div class="scroll-container">
          <!-- Original + Duplicated for looping -->
          <div class="country-card"><img src="images/html.png" alt="" /></div>
          <div class="country-card"><img src="images/css.png" /></div>
          <div class="country-card"><img src="images/bootstrap.png" /></div>
          <div class="country-card"><img src="images/js.png" /></div>
          <div class="country-card"><img src="images/gsap.jpeg" /></div>
          <div class="country-card"><img src="images/php.png" /></div>
          <div class="country-card"><img src="images/mysql.png" /></div>
        
          <div class="country-card"><img src="images/html.png" alt="" /></div>
          <div class="country-card"><img src="images/css.png" /></div>
          <div class="country-card"><img src="images/bootstrap.png" /></div>
          <div class="country-card"><img src="images/js.png" /></div>
          <div class="country-card"><img src="images/gsap.jpeg" /></div>
          <div class="country-card"><img src="images/php.png" /></div>
          <div class="country-card"><img src="images/mysql.png" /></div>

          <div class="country-card"><img src="images/html.png" alt="" /></div>
          <div class="country-card"><img src="images/css.png" /></div>
          <div class="country-card"><img src="images/bootstrap.png" /></div>
          <div class="country-card"><img src="images/js.png" /></div>
          <div class="country-card"><img src="images/gsap.jpeg" /></div>
          <div class="country-card"><img src="images/php.png" /></div>
          <div class="country-card"><img src="images/mysql.png" /></div>
      
          <!-- Duplicated for seamless loop -->
          <div class="country-card"><img src="images/html.png" alt="" /></div>
          <div class="country-card"><img src="images/css.png" /></div>
          <div class="country-card"><img src="images/bootstrap.png" /></div>
          <div class="country-card"><img src="images/js.png" /></div>
          <div class="country-card"><img src="images/gsap.jpeg" /></div>
          <div class="country-card"><img src="images/php.png" /></div>
          <div class="country-card"><img src="images/mysql.png" /></div>
        </div>
      </div> 
      
      <div class="scroll-container-wrapper wrappernames">
        <div class="scroll-container">
          <!-- Original + Duplicated for looping -->
          <div class="country-card">HTML</div>
          <div class="country-card">CSS</div>
          <div class="country-card">Bootstrap</div>
          <div class="country-card">JavaScript</div>
          <div class="country-card">GSAP</div>
          <div class="country-card">PHP</div>
          <div class="country-card">MySQL</div>
         
          <div class="country-card">HTML</div>
          <div class="country-card">CSS</div>
          <div class="country-card">Bootstrap</div>
          <div class="country-card">JavaScript</div>
          <div class="country-card">GSAP</div>
          <div class="country-card">PHP</div>
          <div class="country-card">MySQL</div>

          <div class="country-card">HTML</div>
          <div class="country-card">CSS</div>
          <div class="country-card">Bootstrap</div>
          <div class="country-card">JavaScript</div>
          <div class="country-card">GSAP</div>
          <div class="country-card">PHP</div>
          <div class="country-card">MySQL</div>
      
          <!-- Duplicated for seamless loop -->
          <div class="country-card">HTML</div>
          <div class="country-card">CSS</div>
          <div class="country-card">Bootstrap</div>
          <div class="country-card">JavaScript</div>
          <div class="country-card">GSAP</div>
          <div class="country-card">PHP</div>
          <div class="country-card">MySQL</div>
        </div>
      </div>
      </div>    





   
 
  </div>

  <div class="container-fluid c3" id="projects">
    <div class="row">
      <div class="col-lg-8 bg-dark fade-down "><BR></BR>
        <h1>Projects</h1>
        <BR></BR></div>
        <div class="col-lg-4 bg-dark d-flex justify-content-center fade-right">
          <img src="images/cog-512.gif" alt="">

        </div>
    </div>
    

    <div class="row">
      <div class="col-lg-8 fade-up">
        <a href="crud/index.php" target="_blank"><h1>Crud-Project</h1></a>
      </div>
      <div class="col-lg-4 fade-up-slow">
        <a href="Car/index.php" target="_blank"><h1>Automobile-Site</h1></a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 fade-left">
        <a href="ecom/index.php" target="_blank"><h2>E-commerce Module (Cart)</h2></a>
      </div>
      <div class="col-lg-4 fade-up">
        <a href="pizza/index.php" target="_blank"><h2>Pizza-Order-Site</h2></a>
      </div>
      <div class="col-lg-4 fade-right">
        <a href="https://shahwaizforever.github.io/goku-site/" target="_blank"><h2>Anime-Site</h2></a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 fade-left">
        <a href="https://shahwaizforever.github.io/Dr.Cafe-Official/" target="_blank"><h2>Whatsapp-Based-Restraun-Site</h2> <br>
      
    <br>With Auto-Invoice</a>
      </div>
      <div class="col-lg-4 fade-right">
        <a href=""><h2>Soon</h2></a>
      </div>
    </div>
  </div>



<div class="container-fluid c4 fade-left" id="comment">
  <h2>Suggestion / Opinion / Anything</h2>
  <BR></BR>
    <form action="" method="POST">
        <label for="name">Your Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Your Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Your Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Submit" style="background-color: #ff0800;">
    </form>

</div>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection silently
if ($conn->connect_error) {
    exit;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data safely
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Insert data into the message table
    $sql = "INSERT INTO message (name, email, message) VALUES ('$name', '$email', '$message')";
    $conn->query($sql); // Run query silently
}

// Close the connection
$conn->close();
?>



<script src="javascript.js"></script>
  <!-- Bootstrap JS and Popper.js (for dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
