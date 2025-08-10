<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

include "db_conn.php"; // Ensure this connects correctly to PostgreSQL
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!--<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">-->
  <title>Amenities - Beverly Hills Society</title>
  <style>
    /* =================== DARK THEME COLOR PALETTE & GLOBAL STYLES =================== */
    :root {
      --primary-color: #E0E0E0;         /* Light grey for text */
      --secondary-color: #BB86FC;       /* Soft purple accent */
      --accent-color: #03DAC6;          /* Teal accent */
      --navbar-bg: rgba(18, 18, 18, 0.95);/* Almost black navbar */
      --hero-overlay: rgba(0, 0, 0, 0.6);
      --footer-bg: #121212;             /* Dark footer background */
    }
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    html, body {
      height: 100%;
    }
    body {
      font-family: Helvetica, Arial, sans-serif;
      background: #121212; /* fallback solid color */
      color: var(--primary-color);
      overflow-x: hidden;
    }
    /* =================== NAVBAR =================== */
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: var(--navbar-bg);
      padding: 20px 5%;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      backdrop-filter: blur(5px);
      animation: fadeInDown 1s ease-out;
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .nav-container {
      max-width: 1200px;
      width: 100%;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
    }
    .navbar .logo {
      display: flex;
      align-items: center;
    }
    .navbar .logo img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 2px solid var(--secondary-color);
      transition: transform 0.3s ease;
    }
    .navbar .logo img:hover {
      transform: scale(1.1);
    }
    .navbar h1 {
      font-size: 28px;
      color: var(--primary-color);
    }
    .navbar h1 span {
      font-family: Georgia, serif;
      color: var(--secondary-color);
    }
    .navbar nav ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }
    .navbar nav ul li a {
      text-decoration: none;
      font-size: 18px;
      color: var(--primary-color);
      transition: color 0.3s;
    }
    .navbar nav ul li a:hover {
      color: var(--accent-color);
    }
    /* User Login Button */
    .navbar a.btn {
      background: var(--primary-color);
      color: #000;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s;
      margin-left: 20px;
      font-weight: 600;
    }
    .navbar a.btn:hover {
      background: #444;
    }
    
    /* =================== HERO SECTION =================== */
    .hero {
      margin-top: 100px;
      padding: 100px 5%;
      text-align: center;
      background: url('amenities-banner.jpg') no-repeat center center/cover;
      position: relative;
      overflow: hidden;
    }
    .hero::after {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: var(--hero-overlay);
    }
    .hero h2 {
      position: relative;
      font-size: 48px;
      color: var(--primary-color);
      z-index: 1;
      animation: slideIn 1.5s ease-out;
    }
    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* =================== AMENITIES SECTION =================== */
    .amenities {
      padding: 60px 5%;
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }
    .amenity-card {
      background: #1E1E1E;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.7);
      transition: transform 0.3s, box-shadow 0.3s;
      animation: fadeInUp 1s ease-out;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .amenity-card:hover {
      transform: scale(1.03);
      box-shadow: 0 6px 20px rgba(0,0,0,0.9);
    }
    .amenity-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 0.3s;
    }
    .amenity-card:hover img {
      transform: scale(1.05);
    }
    .card-content {
      padding: 20px;
    }
    .card-content h3 {
      font-size: 22px;
      margin-bottom: 10px;
      color: var(--secondary-color);
    }
    .card-content p {
      font-size: 16px;
      line-height: 1.5;
    }
    
    /* =================== FOOTER =================== */
    footer {
      background: var(--footer-bg);
      color: var(--primary-color);
      padding: 20px;
      margin-top: 40px;
      text-align: center;
      font-size: 14px;
      animation: fadeInUp 1s ease-out;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .main-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      max-width: 1200px;
      margin: 0 auto;
      gap: 20px;
    }
    .box {
      flex: 1;
      margin: 10px;
      min-width: 250px;
    }
    .box h2 {
      font-size: 18px;
      font-weight: 600;
      text-transform: uppercase;
      margin-bottom: 10px;
    }
    .box ul {
      list-style: none;
      padding: 0;
    }
    .box ul li a {
      color: var(--primary-color);
      text-decoration: underline;
      font-size: 16px;
    }
    .right.box .content div {
      margin-bottom: 10px;
    }
    footer p {
      margin: 5px 0;
    }
    
    /* =================== RESPONSIVE DESIGN =================== */
    @media (max-width: 480px) {
      .navbar {
        flex-direction: column;
        padding: 10px;
      }
      .navbar nav ul {
        flex-direction: column;
        gap: 10px;
      }
      .navbar .logo h1 {
        font-size: 20px;
      }
      .amenities {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      }
      .hero h2 {
        font-size: 36px;
      }
    }
  </style>
</head>
<body>
    <!--  <div class="amenities-container">
        <?php
        $sql = "SELECT * FROM amenities ORDER BY id ASC";
        $result = pg_query($conn, $sql);
        if ($result && pg_num_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                echo '<div class="amenity-card">';
                if (!empty($row['image_url'])) {
                    echo '<img src="'.htmlspecialchars($row['image_url']).'" alt="'.htmlspecialchars($row['name']).'">';
                } else {
                    echo '<img src="1.jpg" alt="No Image Available">'; // Default image
                }
                echo '<h3>'.htmlspecialchars($row['name']).'</h3>';
                echo '<p>'.htmlspecialchars($row['description']).'</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No amenities available at the moment.</p>";
        }
        ?>
    </div>-->
  <!-- HEADER / NAVBAR -->
  <div class="navbar">
    <div class="nav-container">
      <div class="logo">
        <img src="8.jpg" alt="Logo">
        <h1>Beverly<span>Hills</span></h1>
      </div>
      <nav>
        <ul>
          <li><a href="login.html" class="active">Home</a></li>
          <li><a href="amenities.html">Amenities</a></li>
          <!--<li><a href="rules.html">Rules &amp; Regulations</a></li>-->
        </ul>
      </nav>
      <a href="login.html" class="btn">User Login</a>
    </div>
  </div>
  
  <!-- HERO SECTION -->
  <section class="hero">
    <h2>Our Premium Amenities</h2>
  </section>
  
  <!-- AMENITIES SECTION -->
  <section class="amenities">
    <!-- Amenity Card 1 -->
    <div class="amenity-card">
      <img src="img 2.jpeg" alt="Gym">
      <div class="card-content">
        <h3>State-of-the-Art Gym</h3>
        <p>Our fully-equipped gym features modern machines, free weights, and expert trainers to help you stay fit.</p>
      </div>
    </div>
    <!-- Amenity Card 2 -->
    <div class="amenity-card">
      <img src="img 3.jpeg" alt="Swimming Pool">
      <div class="card-content">
        <h3>Olympic Swimming Pool</h3>
        <p>Enjoy a refreshing swim in our temperature-controlled pool, perfect for exercise and relaxation.</p>
      </div>
    </div>
    <!-- Amenity Card 3 -->
    <div class="amenity-card">
      <img src="img 4.jpeg" alt="Club House">
      <div class="card-content">
        <h3>Luxury Club House</h3>
        <p>Relax and socialize in our elegant club house designed for gatherings, events, and leisure.</p>
      </div>
    </div>
    <!-- Amenity Card 4 -->
    <div class="amenity-card">
      <img src="img 5.jpg" alt="Garden">
      <div class="card-content">
        <h3>Serene Garden</h3>
        <p>Stroll through our beautifully landscaped garden and enjoy peaceful moments in nature.</p>
      </div>
    </div>
 <!-- Amenity Card 5 -->
    <div class="amenity-card">
      <img src="4.jpg" alt="Garden">
      <div class="card-content">
        <h3>Rooftop Deck</h3>
        <p>Ensuring compliance,safety, and functionality</p>
      </div>
    </div>
 <!-- Amenity Card 6 -->
    <div class="amenity-card">
      <img src="2.jpg" alt="Garden">
      <div class="card-content">
        <h3>Parking</h3>
        <p>Stroll through our beautifully landscaped garden and enjoy peaceful moments in nature.</p>
      </div>
    </div>
  </section>
  
  <!-- FOOTER -->
  <footer>
    <div class="main-content">
      <div class="left box">
        <h2>About Us</h2>
        <div class="content">
          <p>Beverly Hills is a web app where society members receive updates, notices, events, and community information. Members can also post complaints and access various services.</p>
        </div>
      </div>
      <div class="center box adjust">
        <div class="cen">
          <h2>Quick Links</h2>
          <ul>
            <li><a href="amenities.html">Amenities</a></li>
            <li><a href="rules.html">Rules &amp; Regulations</a></li>
          </ul>
        </div>
      </div>
      <div class="right box">
        <h2>Address</h2>
        <div class="content">
          <div class="place">
            <span class="text">Pune - 411048</span>
          </div>
          <div class="phone">
            <span class="text">+91 8779635278</span>
          </div>
          <div class="email">
            <span class="text">Beverlyhills@gmail.com</span>
          </div>
        </div>
      </div>
    </div>
    <p>&copy; 2025 Beverly Hills Society. All Rights Reserved.</p>
  </footer>
</body>
</html>
