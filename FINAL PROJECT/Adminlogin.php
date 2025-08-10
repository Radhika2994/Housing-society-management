<!DOCTYPE html>
<html lang="en">
<head>
  <!--<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">-->
  <title>Beverly Hills Society – Admin Login &amp; Rules</title>
  <style>
    /* =================== DARK THEME COLOR PALETTE & GLOBAL STYLES =================== */
    :root {
      --primary-color: #E0E0E0;         /* Light grey for text */
      --secondary-color: #BB86FC;       /* Soft purple accent */
      --accent-color: #03DAC6;          /* Teal accent */
      --navbar-bg: rgba(18, 18, 18, 0.95);/* Almost black navbar */
      --admin-bg: linear-gradient(135deg, #292929, #1a1a1a); /* Dark gradient for admin login */
      --form-bg: rgba(33, 33, 33, 0.9);   /* Dark grey form background */
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
      background: #FFFDD0 url('img1.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
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
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      width: 100%;
    }
    .navbar img.logo {
      height: 50px;
      width: 50px;
      border-radius: 50%;
      border: 2px solid var(--secondary-color);
      transition: transform 0.3s ease;
    }
    .navbar img.logo:hover {
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
      position: relative;
      transition: color 0.3s ease;
    }
    .navbar nav ul li a:hover::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -5px;
      height: 3px;
      width: 100%;
      background: var(--accent-color);
    }
    /* User Login Button */
    .navbar a.btn {
      background: var(--primary-color);
      color: #000;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s ease;
      margin-left: 20px;
      font-weight: 600;
    }
    .navbar a.btn:hover {
      background: #444;
    }
    
    /* =================== ADMIN LOGIN CONTAINER =================== */
    .page {
      margin-top: 120px;
      padding: 0 5%;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 30px;
      z-index: 1;
      position: relative;
      animation: fadeInUp 1s ease-out;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .admin-login-container {
      background: var(--admin-bg);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(0,0,0,0.7);
      max-width: 500px;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .admin-login-container:hover {
      transform: scale(1.03);
      box-shadow: 0 0 40px rgba(0,0,0,0.9);
    }
    .admin-form {
      width: 100%;
      text-align: center;
      color: var(--primary-color);
    }
    .admin-form h1 {
      font-size: 32px;
      margin-bottom: 20px;
      color: var(--secondary-color);
    }
    .admin-form form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .admin-form form input {
      padding: 12px;
      font-size: 16px;
      border: 1px solid #444;
      border-radius: 5px;
      background: #333;
      color: var(--primary-color);
      transition: border 0.3s ease, box-shadow 0.3s ease;
    }
    .admin-form form input:focus {
      border-color: var(--secondary-color);
      box-shadow: 0 0 10px var(--secondary-color);
    }
    .admin-form form button {
      padding: 12px;
      background: var(--secondary-color);
      color: #000;
      border: none;
      border-radius: 30px;
      font-size: 18px;
      cursor: pointer;
      transition: background 0.3s ease;
      font-weight: 600;
    }
    .admin-form form button:hover {
      background: var(--accent-color);
    }
    
    /* =================== RULES & REGULATIONS SECTION =================== */
    #rules {
      background: #1E1E1E;
      margin: 40px auto;
      padding: 20px;
      border-radius: 10px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 20px;
      max-width: 1200px;
      animation: fadeIn 1s ease-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .rules-image {
      flex: 1;
      min-width: 200px;
    }
    .rules-image img {
      width: 100%;
      border-radius: 10px;
      transition: transform 0.5s ease;
    }
    .rules-image img:hover {
      transform: scale(1.05);
    }
    .rules-text {
      flex: 2;
      min-width: 250px;
      color: var(--primary-color);
    }
    .rules-text h1 {
      text-align: center;
      color: var(--secondary-color);
      background: #121212;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
    }
    .rules-text ul {
      margin: 0;
      padding: 0 20px;
      list-style: disc;
      font-family: Cambria, Georgia, serif;
      font-size: 18px;
      font-weight: bold;
      line-height: 1.6;
      color: var(--primary-color);
    }
    .rules-text li {
      margin: 15px 0;
    }
    
    /* =================== AUTOMATIC IMAGE SLIDER =================== */
    .slider {
      position: relative;
      width: 300px;  /* Fixed square */
      height: 300px;
      margin: 0 auto;
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.7);
    }
    .slider input[type="radio"] {
      display: none;
    }
    .slides {
      display: flex;
      width: 300%; /* 3 slides */
      height: 100%;
      transition: transform 0.6s ease;
      animation: slideAuto 18s infinite;
    }
    @keyframes slideAuto {
      0% { transform: translateX(0%); }
      33% { transform: translateX(0%); }
      38% { transform: translateX(-33.333%); }
      71% { transform: translateX(-33.333%); }
      76% { transform: translateX(-66.666%); }
      100% { transform: translateX(-66.666%); }
    }
    .slide {
      width: 100%;
      height: 100%;
      flex-shrink: 0;
    }
    .slide img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
    .slider-nav {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
    }
    .nav-dot {
      display: inline-block;
      width: 12px;
      height: 12px;
      margin: 0 5px;
      background: var(--accent-color);
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.3s;
    }
    .nav-dot:hover {
      background: var(--secondary-color);
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
      .admin-login-container {
        padding: 20px;
      }
      .slider {
        width: 250px;
        height: 250px;
      }
    }
  </style>
</head>
<body>
  <!-- HEADER / NAVBAR -->
  <div class="navbar">
    <div class="nav-container">
      <img src="8.jpg" class="logo" alt="Logo">
      <h1>Beverly<span>Hills</span></h1>
      <nav>
        <ul>
          <li><a href="#" class="active">Home</a></li>
          <li><a href="#rules">Rules &amp; Regulations</a></li>
        </ul>
      </nav>
      <!-- User Login Button Added -->
      <a href="login.html" class="btn">User Login</a>
    </div>
  </div>
  
  <!-- MAIN CONTENT: ADMIN LOGIN -->
  <div class="page">
    <div class="admin-login-container">
      <div class="admin-form">
        <h1>Admin Login</h1>
        <form action="managemem.php" method="POST">
          <input type="text" placeholder="Username" name="username" required>
          <input type="password" placeholder="Admin Code" name="admincode" required>
          <button type="submit" name="logina">Login</button>
        </form>
      </div>
    </div>
  </div>
  
  <!-- RULES & REGULATIONS SECTION -->
  <div id="rules">
    <div class="rules-image">
      <div class="slider">
        <input type="radio" name="slider" id="slide1" checked>
        <input type="radio" name="slider" id="slide2">
        <input type="radio" name="slider" id="slide3">
        <div class="slides">
          <div class="slide"><img src="8.jpg" alt="Slide 1"></div>
          <div class="slide"><img src="img1.jpg" alt="Slide 2"></div>
          <div class="slide"><img src="12.jpg" alt="Slide 3"></div>
        </div>
        <div class="slider-nav">
          <label for="slide1" class="nav-dot"></label>
          <label for="slide2" class="nav-dot"></label>
          <label for="slide3" class="nav-dot"></label>
        </div>
      </div>
    </div>
    <div class="rules-text">
      <h1>Rules and Regulations</h1>
      <hr>
      <ul>
        <li>Keep your flats/homes and nearby premises clean and habitable.</li>
        <li>Maintain proper cleanliness in common areas and parking lots.</li>
        <li>Members must pay maintenance charges and other dues on time.</li>
        <li>Pets allowed only with required NOC; disruptive pets are not allowed.</li>
        <li>Park only in your designated parking spaces.</li>
        <li>Clean up after using community halls; no damages allowed.</li>
        <li>No personal use of common areas near front doors, corridors, or passages.</li>
        <li>Salesmen and vendors are not permitted on the premises.</li>
        <li>Water wastage and over usage are not allowed.</li>
        <li>No smoking in lobbies or passageways; penalties apply for violations.</li>
      </ul>
    </div>
  </div>
  
  <!-- FOOTER -->
  <footer>
    <div class="main-content">
      <div class="left box">
        <h2>About Us</h2>
        <div class="content">
          <p>Beverly Hills is a web app where society members get updates, notices, events, and community information. Members can also post complaints and access various services.</p>
        </div>
      </div>
      <div class="center box adjust">
        <div class="cen">
          <h2>Quick Links</h2>
          <ul>
            <li><a href="#rules">Rules and Regulations</a></li>
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
<?php
	 if(isset($_POST['logina']))
	 {
	 $user=$_POST['username'];
	 $adcode=$_POST['admincode'];
	 if($user=="Admin" && $adcode== "100")
	 {
	 echo"<script>alert('welcome');
	 window.location.href='managemem.php';
	 </script>";
	 }
	 else
	 {
	 echo"<script>alert('sorry');
	 </script>";
	 }
	 }
	 ?>
