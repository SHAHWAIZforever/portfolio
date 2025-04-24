<?php
// Database connection settings
$host = "localhost";
$user = "root";          // Change if your DB uses a different user
$password = "";          // Your MySQL password
$dbname = "autoaudit";   // Database name

// Create connection
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
// if ($conn->query($sql) === TRUE) {
//     echo "✅ Database '$dbname' ready.<br>";
// } else {
//     die("❌ Error creating database: " . $conn->error);
// }

// Select the database
$conn->select_db($dbname);

// Create the table
$table = "vin_requests";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vin VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// if ($conn->query($sql) === TRUE) {
//     echo "✅ Table '$table' created successfully.";
// } else {
//     echo "❌ Error creating table: " . $conn->error;
// }

// Close connection
$conn->close();
?>

<?php
// Database connection
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

// SQL to create the table
$sql = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the query
// if ($conn->query($sql) === TRUE) {
//     echo "Table 'contact_messages' created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// Close connection
$conn->close();
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shahwaiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
  </head>
  <link rel="stylesheet" href="style.css">
  <body id="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

      <div class="container-fluid">
        
       
        <a class="navbar-brand" href="#">
          <img src="images/audit-logo.png" alt="Brand" width="120" height="50">
        </a>
    
       
        <button class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="d-lg-none">
          <a class="btn btn-outline-primary ms-2 navlast" href="#">View Pricing</a>
        </div>
    
        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
          <ul class="navbar-nav navbar-nav-center">
           

            <li class="nav-item mx-3"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item mx-3"><a class="nav-link"  href="#about" >About Us</a></li>
            <li class="nav-item mx-3"><a class="nav-link" href="#services">Our Services</a></li>
            <li class="nav-item mx-3"><a class="nav-link"  href="#package">Packages</a></li>
            <li class="nav-item mx-3"><a class="nav-link" href="#contact">Contact us</a></li>
          </ul>
          
          <ul class="navbar-nav d-none d-lg-flex ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
            <li class="nav-item">
              <a class="btn btn-lg navlast navlastt" href="#">View Pricing</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div class="container-fluid c1 ">
<div class="row">
    <div class="col-lg-6 yourDiv">
        <h1>
          <big>  Be Smart And Check In Advance.<span> AUDIT</span></big>
        </h1>
        <p>AUDIT is an international provider of vehicle histories with the goal of making the used car market more transparent and our roads safer worldwide.</p>
        <h3>Get A VIN Check With AUDIT.</h3>

        <div class="form-container">
            <form  action="submit.php" method="POST">
              <label for="vin">Enter VIN / HIN Number</label>
              <input type="text" id="vin" name="vin" placeholder="Enter VIN/HIN Number">
              
              <label for="phone">Enter Phone Number</label>
              <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number">
              
              <label for="email">Enter Email</label>
              <input type="email" id="email" name="email" placeholder="Enter Email">
              
              <button type="submit" class="navlast submit" ><big>VIN Check</big></button>
            </form>
          </div>

    </div>
    <div class="col-lg-6 hid">
        <div id="customCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
          
          <!-- Pagination indicators -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
      
          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="black-overlay"></div>
              <img src="images/car1.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
              <div class="black-overlay"></div>
              <img src="images/car2.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
              <div class="black-overlay"></div>
              <img src="images/car3.jpg" class="d-block w-100" alt="Image 3">
            </div>
          </div>
      
          <!-- Controls -->
          <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#customCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      
      
</div>
</div>

<!-- >>>>>>>>>>>> -->
<div class="container-fluid c2">
    <BR></BR>
    <div class="row fade-down">
        <center><h1>Trusted Worldwide</h1></center>
        <center><h5>Our vehicle history reports are available in countries around the globe
            </h5></center>
    </div>
    <BR></BR>
    <div class="row">
    
   
      <div class="scroll-container-wrapper">
        <div class="scroll-container">
          <!-- Original + Duplicated for looping -->
          <div class="country-card"><img src="https://flagcdn.com/w320/us.png" alt="USA" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/de.png" alt="Germany" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/cn.png" alt="China" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/in.png" alt="India" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/br.png" alt="Brazil" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/jp.png" alt="Japan" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/gb.png" alt="UK" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/ca.png" alt="Canada" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/mx.png" alt="Mexico" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/no.png" alt="Norway" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/fr.png" alt="France" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/it.png" alt="Italy" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/es.png" alt="Spain" /></div>
      
          <!-- Duplicated for seamless loop -->
          <div class="country-card"><img src="https://flagcdn.com/w320/us.png" alt="USA" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/de.png" alt="Germany" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/cn.png" alt="China" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/in.png" alt="India" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/br.png" alt="Brazil" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/jp.png" alt="Japan" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/gb.png" alt="UK" /></div>
          <div class="country-card"><img src="https://flagcdn.com/w320/ca.png" alt="Canada" /></div>
        </div>
      </div> 
      
      <div class="scroll-container-wrapper wrappernames">
        <div class="scroll-container">
          <!-- Original + Duplicated for looping -->
          <div class="country-card">USA</div>
          <div class="country-card">Germany</div>
          <div class="country-card">China</div>
          <div class="country-card">India</div>
          <div class="country-card">Brazil</div>
          <div class="country-card">Japan</div>
          <div class="country-card">UK</div>
          <div class="country-card">Canada</div>
          <div class="country-card">Mexico</div>
          <div class="country-card">Norway</div>
          <div class="country-card">France</div>
          <div class="country-card">Italy</div>
          <div class="country-card">Spain</div>
      
          <!-- Duplicated for seamless loop -->
          <div class="country-card">USA</div>
          <div class="country-card">Germany</div>
          <div class="country-card">China</div>
          <div class="country-card">India</div>
          <div class="country-card">Brazil</div>
          <div class="country-card">Japan</div>
          <div class="country-card">UK</div>
          <div class="country-card">Canada</div>
        </div>
      </div>
          </div>
          
          
</div>

<div class="container-fluid c2" id="about">
    <div class="row">
        <div class="col-lg-6 hid">
            <h1><big>About us</big></h1>
            <div class="underline"></div>
            <h4>At VIN Cario Pro, we specialize in delivering comprehensive vehicle history reports that empower our customers to make well-informed decisions. Whether you're buying, selling, or simply curious about your vehicle's past, our services provide the clarity and transparency you need. We understand the importance of knowing a vehicle's history, which is why we gather data from reliable and trusted sources globally. This ensures that you receive the most accurate and up-to-date information available.</h4>
            <BR></BR>
            <a href="">Read More <i class="fa-solid fa-arrow-right"></i></a>
            
        </div>
        <div class="col-lg-6 hid">
            
            <img src="images/car2.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <BR></BR>
</div>
<!-- >>>>>>>>>>>>>>> -->
 <div class="container-fluid c3 c3border">
    <section class="stats-section">
        <div class="stat-box fade-up-1">
            <h2>15</h2>
            <p>Years of Experience</p>
        </div>
        <div class="stat-box fade-up-2">
            <h2>1,500</h2>
            <p>Active Partners</p>
        </div>
        <div class="stat-box fade-up-3">
            <h2>50,000</h2>
            <p>Reports Sold</p>
        </div>
        <div class="stat-box fade-up-4">
            <h2>10,000</h2>
            <p>Historical Records</p>
        </div>
    </section>
  
 </div>
<!-- .>>>>>>>>>>>>>>> -->

<div class="container-fluid c4" id="services">
    <BR></BR>
    <div class="row fade-down">
        <center><h1><big>Our Services</big></h1></center>
        <center><h5>Comprehensive history reports for all types of vehicles</h5></center>
        <center><div class="underline"></div></center>
    </div>

</div>

<!-- .>>>>>>>>>>>> -->
<div class="container-fluid c3 fade-up">
    <div class="row g-4">
      <!-- First Row -->
      <div class="col-md-4">
        <div class="history-card">
          <div class="icon-wrapper">🚗</div>
          <img src="images/service car.png.jpg" alt="Car" class="vehicle-img">
          <h3 class="vehicle-title">CAR HISTORY REPORT</h3>
          <a href="#" class="purchase-link">PURCHASE NOW</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="history-card">
          <div class="icon-wrapper">🏍️</div>
          <img src="images/service car.png.jpg" alt="Bike"
            class="vehicle-img">
          <h3 class="vehicle-title">BIKE HISTORY REPORT</h3>
          <a href="#" class="purchase-link">PURCHASE NOW</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="history-card">
          <div class="icon-wrapper">🚚</div>
          <img src="images/service car.png.jpg" alt="Truck"
            class="vehicle-img">
          <h3 class="vehicle-title">TRUCK HISTORY REPORT</h3>
          <a href="#" class="purchase-link">PURCHASE NOW</a>
        </div>
      </div>
    </div>
  <br>
    <div class="row g-4 ">
      <!-- Second Row -->
      <div class="col-md-4">
        <div class="history-card">
          <div class="icon-wrapper">🚐</div>
          <img src="images/service car.png.jpg" alt="Van"
            class="vehicle-img">
          <h3 class="vehicle-title">VAN HISTORY REPORT</h3>
          <a href="#" class="purchase-link">PURCHASE NOW</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="history-card">
          <div class="icon-wrapper">🚎</div>
          <img src="images/service car.png.jpg" alt="RV"
            class="vehicle-img">
          <h3 class="vehicle-title">RV HISTORY REPORT</h3>
          <a href="#" class="purchase-link">PURCHASE NOW</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="history-card">
          <div class="icon-wrapper">🚢</div>
          <img src="images/service car.png.jpg" alt="Boat"
            class="vehicle-img">
          <h3 class="vehicle-title">BOAT HISTORY REPORT</h3>
          <a href="#" class="purchase-link">PURCHASE NOW</a>
        </div>
      </div>
    </div>
  </div>
<!-- >>>>>>>>>>>>>>> -->

<div class="container-fluid c4" id="package" >
    <BR></BR>
    <div class="row fade-down">
        <center><h1><big>Choose Your Packages</big></h1></center>
        <center><h5>Select the vehicle history report package that best fits your needs</h5></center>
        <center><div class="underline"></div></center>
    </div>

</div>
<!-- .>>>>>>>>>>>> -->

<div class="container-fluid c6">
    <div class="row justify-content-between">
      <center><div class="note">⚠️ NOTE: Once you order the report, the payment is non-refundable.</div></center>
      <!-- First Card -->
      <div class="col-lg-4">
        <div class="card fade-up-1">
          <h4>Silver Plan</h4>
          <big><h1>$50</h1></big>
          <p>Basic vehicle history report with essential information</p>
          <ul class="tick-list list-unstyled gradient-text">
            <li>Instant Report</li>
            <li>Vehicle Overview</li>
            <li>Market Value</li>
            <li>Vehicle Specifications</li>
            <li>Sales Listing</li>
            <li>Accident Record</li>
            <li>Salvage</li>
            <li>Theft Record</li>
            <li>Title Record</li>
          </ul>
          <button class="btn custom-btn mt-3">Add to Cart</button>

        </div>
      </div>
  
      <!-- Middle Card -->
      <div class="col-lg-4">
        <div class="card mid-card fade-up-2">
          <div class="most-popular">Most Popular</div>
          <h4>Gold Plan</h4>
          <big><h1>$80</h1></big>
          <p>Comprehensive report with additional vehicle details</p>
          <ul class="tick-list list-unstyled gradient-text">
            <li>Instant Report</li>
  <li>Vehicle Specifications</li>
  <li>Sales Listing</li>
  <li>Accident Record</li>
  <li>Salvage</li>
  <li>Theft Record</li>
  <li>Title Record</li>
  <li>Impounds</li>
  <li>Exports</li>
  <li>Open Recalls</li>
  <li>Installed Options and Packages</li>
          </ul>
          <button class="btn btn-primary mt-3">Add to Cart</button>

        </div>
      </div>
  
      <!-- Third Card -->
      <div class="col-lg-4">
        <div class="card fade-up-3">
          <h4>Platinum Package</h4>
          <big><h1>$100</h1></big>
          <p>Complete vehicle history with premium features and benefits</p>
          <ul class="tick-list list-unstyled gradient-text">
            <li>Instant Report</li>
            <li>Vehicle Overview</li>
            <li>Market Value</li>
            <li>Vehicle Specifications</li>
            <li>Sales Listing</li>
            <li>Accident Record</li>
            <li>Salvage</li>
            <li>Theft Record</li>
            <li>Title Record</li>
            <li>Impounds</li>
            <li>Exports</li>
            <li>Open Recalls</li>
            <li>Installed Options and Packages</li>
            <li>Active/Expire Warranty</li>
            <li>2 Buyers Numbers from our Directory</li>
            <li>Buy One Get Another Report Free for Lifetime</li>
            <li>HQ Car Images</li>
          </ul>
          <button class="btn custom-btn mt-3">Add to Cart</button>

        </div>
      </div>
  
    </div>
  </div>
  <!-- >>>>>>>>>>>>>>>>>>>>>>>> -->
   
  <div class="container-fluid c4">
    <BR></BR>
    <div class="row fade-down">
        <center><h1><big>Our Commitment to You</big></h1></center>
        <center><h5>We're dedicated to providing accurate, comprehensive vehicle history reports that help you <br> make informed decisions with confidence.</h5></center>
        <center><div class="underline"></div></center>
    </div>

</div>

<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
<div class="container-fluid py-5 c7">
    <div class="row g-4">
      <!-- Column 1 -->
      <div class="col-12 col-md-6 col-lg-4 fade-up-1">
        <div class="p-4 border rounded hover-border">
          <img src="https://via.placeholder.com/40" alt="Icon 1" class="icon-img">
          <h1 class="h4">Information You Can Trust</h1>
          <p>Our writers and editors exclusively use reputable, data-driven sources such as articles from established vehicle publications, government reports, and other trusted vehicle associations.</p>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="col-12 col-md-6 col-lg-4 fade-up-2">
        <div class="p-4 border rounded hover-border">
          <img src="https://via.placeholder.com/40" alt="Icon 2" class="icon-img">
          <h1 class="h4">Real Owner Reviews</h1>
          <p>Hundreds of thousands of reviews from verified vehicle owners help you better understand how vehicles perform in the real world.</p>
        </div>
      </div>

      <!-- Column 3 -->
      <div class="col-12 col-md-6 col-lg-4 fade-up-3">
        <div class="p-4 border rounded hover-border">
          <img src="https://via.placeholder.com/40" alt="Icon 3" class="icon-img">
          <h1 class="h4">Comprehensive and Informative</h1>
          <p>Our team researches and road tests hundreds of vehicles each year, then works to distill down only the most important information, specifically for used vehicle buyers.</p>
        </div>
      </div>

    </div>
    <BR></BR>
  </div>
<!-- .>>>>>>>>>>>>>> -->
<div class="container-fluid c8">
    <br><br>
    <div class="row">
        <div class="col-lg-6 hid">
            <img src="images/handshake..jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 fitcc fade-up">
            <br><br>
            <h5>Our Network</h5>
            <big><h1 id="small">Global Vehicle Data <br> Partners</h1></big>
            <h4>We work with leading vehicle data providers around the world to ensure comprehensive and reliable information.</h4>
        </div>
    </div>
          
</div>
<div class="full-width-banner">
    <ul class="list-unstyled">
      <li>Automotive Alliance</li>
      <li>Vehicle Data Corp</li>
      <li>Global Motors</li>
      <li>Auto Registry Inc</li>
      <li>CarTrack Systems</li>
      <li>VehicleInfo Pro</li>
      <li>MotorData Group</li>
    </ul>
  </div>
<!-- .>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div class="container-fluid c4" id="contact">
    <BR></BR>
    <div class="row fade-down">
        <center><h1><big>Contact Us</big></h1></center>
        <center><h5>Have questions about our vehicle history reports? Get in touch with our team.</h5></center>
        <center><div class="underline"></div></center>
    </div>
<div class="container-fluid c9">
<div class="row fade-up">
    <center>
        <form class="form-2" action="submit_contact.php" method="post">
            <h2>Send Us a Message</h2>
        
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
        
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
        
            <button type="submit" class="navlast">Send Message <i class="fa-brands fa-telegram"></i></button>
          </form>
          <BR></BR>
    </center>
</div>
</div>

<!-- .>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div class="container-fluid c10">
    <div class="row">
        <div class="col-lg-3 fade-up-1">
            <img src="images/audit-logo.png" alt="">
            <h5>International provider of vehicle histories making the used car market more transparent and our roads safer worldwide.</h5>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                  <i class="fab fa-instagram"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
                  <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://youtube.com" target="_blank" aria-label="YouTube">
                  <i class="fab fa-youtube"></i>
                </a>
              </div>
        </div>
      
        <div class="col-lg-3 fade-up-2">
          <h2>Quick Links</h2>
          <div class="underline"></div>
          <ul class="arrow-list">
              <li><a href="home.html" target="_blank" class="link-button">Home</a></li>
              <li><a href="about-us.html" target="_blank" class="link-button">About Us</a></li>
              <li><a href="services.html" target="_blank" class="link-button">Services</a></li>
              <li><a href="pricing.html" target="_blank" class="link-button">Pricing</a></li>
              <li><a href="contact-us.html" target="_blank" class="link-button">Contact Us</a></li>
          </ul>          
      </div>
      <div class="col-lg-3 fade-up-3">
          <h2>Our Services</h2>
          <div class="underline"></div>
          <ul class="arrow-list">
              <li><a href="car-history-report.html" target="_blank" class="link-button">Car History Report</a></li>
              <li><a href="bike-history-report.html" target="_blank" class="link-button">Bike History Report</a></li>
              <li><a href="truck-history-report.html" target="_blank" class="link-button">Truck History Report</a></li>
              <li><a href="van-history-report.html" target="_blank" class="link-button">Van History Report</a></li>
              <li><a href="rv-history-report.html" target="_blank" class="link-button">RV History Report</a></li>
              <li><a href="boat-history-report.html" target="_blank" class="link-button">Boat History Report</a></li>
          </ul>
      </div>
      
      
      
      
        <div class="col-lg-3 fade-up-4">
            <h2>Get in Touch</h2>
            <div class="underline"></div>
            <h5 id="h52">International provider of vehicle histories making the used car market more transparent and our roads safer worldwide.</h5>
            <div class="social-links">
                <a style="height: 60px;width: 60px; color: cyan;" href="mailto:autioaudit58@gmail.com" target="_blank" aria-label="Email">
                    <i class="fas fa-envelope"></i>
                     </a>
                     <button class="email-button" onclick="window.location.href='mailto:autioaudit58@gmail.com'">
                        autioaudit58@gmail.com
                      </button>
                       </div>
                       <br>
                       <a href="" class="navlast">Contact Us <i class="fa-solid fa-square-arrow-up-right"></i></a>
              
        </div>
    </div>
</div>
<!-- >>>>>>>>>>>>>>>> -->

<footer>
    <p>© 2025 AUDIT. All rights reserved.</p>
      
    <ul>
        <li><a href="/privacy-policy">Privacy Policy</a></li>
        <li><a href="/terms-of-service">Terms of Service</a></li>
        <li><a href="/cookie-policy">Cookie Policy</a></li>
      </ul>

  </footer>

  <div class="chat-bubble" id="chat-widget">
    <div class="chat-text"><h4>Chat with us 👋</h4></div>
    <div class="chat-icon">
      💬
      <div class="chat-notification">1</div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
   <script src="javascript.js"></script>
  </body>
</html>
