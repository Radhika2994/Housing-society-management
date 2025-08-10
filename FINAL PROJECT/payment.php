<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">-->
  <title>Make Payment - Beverly Hills Society</title>
  <style>
    /* =================== BASE STYLES & COLOR PALETTE =================== */
    :root {
      --primary-color: #333;           /* Dark text */
      --secondary-color: #007B8F;        /* Deep teal-blue */
      --accent-color: #0B87A6;           /* Slightly darker teal */
      --light-bg: #FFFDD0;              /* Cream background */
      --card-bg: #ffffff;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Helvetica, Arial, sans-serif;
      background:#e0e0fa;
      background-size: cover;
      color: var(--primary-color);
      overflow-x: hidden;
    }
    
    /* =================== HEADER & SIDEBAR (SIMILAR TO DASHBOARD) =================== */
    /* Minimal header & sidebar for navigation consistency */
    header {
      background: var(--secondary-color);
      padding: 20px 5%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      animation: fadeInDown 1s ease;
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .left_area h3 {
      font-size: 28px;
      color: #fff;
    }
    .left_area h3 span {
      font-family: Georgia, serif;
      color: #fff;
    }
    .right_area a {
      background: #fff;
      color: var(--primary-color);
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 600;
      margin-left: 10px;
      transition: background 0.3s;
    }
    .right_area a:hover {
      background: #ddd;
    }
    .sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 250px;
      height: calc(100% - 70px);
      background: #121212;
      padding: 20px;
      overflow-y: auto;
      animation: fadeInLeft 1s ease;
    }
    @keyframes fadeInLeft {
      from { opacity: 0; transform: translateX(-20px); }
      to { opacity: 1; transform: translateX(0); }
    }
    .sidebar center {
      margin-bottom: 20px;
    }
    .sidebar .profile_image {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      transition: transform 0.3s;
    }
    .sidebar .profile_image:hover {
      transform: scale(1.1);
    }
    .sidebar h4 {
      margin-top: 10px;
      color: #fff;
      text-align: center;
    }
    .sidebar a {
      display: block;
      color: #fff;
      padding: 10px;
      margin: 5px 0;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .sidebar a.active, .sidebar a:hover {
      background: var(--accent-color);
      color: #000;
    }
    
    /* =================== PAYMENT FORM CONTAINER =================== */
    .content {
      margin-left: 270px;
      padding: 120px 5% 20px;
      animation: fadeInUp 1s ease;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .contact-box {
      max-width: 750px;
      margin: 40px auto;
      background: var(--card-bg);
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
      animation: scaleIn 0.8s ease;
    }
    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
    .contact-box h2 {
      text-align: center;
      font-size: 32px;
      color: var(--secondary-color);
      margin-bottom: 20px;
    }
    .paycontainer {
      padding: 20px;
      background: #E3F2FD;
      border-radius: 8px;
      animation: fadeInUp 0.8s ease;
    }
    .paycontent {
      text-align: center;
      margin-bottom: 15px;
    }
    .paycontent h3 {
      color: var(--secondary-color);
      font-size: 22px;
    }
    .payform {
      text-align: center;
    }
    .field {
      width: 80%;
      padding: 12px;
      font-size: 1rem;
      border: 2px solid #ccc;
      border-radius: 5px;
      margin-bottom: 15px;
      transition: border 0.3s ease, box-shadow 0.3s ease;
    }
    .field:focus {
      border: 2px solid var(--secondary-color);
      box-shadow: 0 0 10px var(--accent-color);
    }
    .btn-pay {
      width: 50%;
      padding: 12px;
      background: var(--secondary-color);
      color: white;
      font-size: 1.2rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    .btn-pay:hover {
      background: var(--accent-color);
      transform: scale(1.05);
    }
    .payment-images {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 15px;
      animation: fadeInUp 1s ease;
    }
    .payment-images img {
      width: 70px;
      transition: transform 0.3s ease;
    }
    .payment-images img:hover {
      transform: scale(1.1);
    }
    
    /* =================== RESPONSIVE DESIGN =================== */
    @media screen and (max-width: 768px) {
      .contact-box {
        width: 90%;
        padding: 20px;
      }
      .field {
        width: 100%;
      }
      .btn-pay {
        width: 70%;
      }
      .content {
        margin-left: 0;
        padding-top: 100px;
      }
      .sidebar {
        display: none;
      }
    }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header style="background:#121212">
    <div class="left_area">
      <h3>BEVERLY HILLS</h3>
    </div>
    <div class="right_area">
      <a href="logout.php" class="logout_btn">Logout</a>
      <a href="login.html" class="btn">User Login</a>
    </div>
  </header>
  
  <!-- SIDEBAR -->
  <div class="sidebar">
    <center>
      <img src="profile.jpg" class="profile_image" alt="Profile Image">
      <h4>USER</h4>
    </center>
    <a href="Welcome.php" class="active">Dashboard</a>
    <a href="noticebrd.php">Notice Board</a>
    <a href="complaint.php">Register Complaint</a>
    <a href="payment.php">Maintenance Payment</a>
    <a href="amenities.php">Amenities</a>
  </div>
  
  <!-- PAYMENT FORM -->
  <div class="content">
    <div class="contact-box" style="background:#121212">
      <h2>Make Your Maintenance Payment</h2>
      <div class="paycontainer">
        <div class="paycontent">
          <h3>Payment Details</h3>
        </div>
        <form action="#" method="POST">
          <div class="payform">
            <p>Accepted Cards</p>
            <div class="payment-images">
              <img src="card1.jpeg" alt="Visa">
              <img src="casrd2.jpeg" alt="Mastercard">
            </div>
            <input type="text" class="field" name="ptitle" placeholder="Enter Your Name" required>
            <input type="text" class="field" name="pflat" placeholder="Enter Your Flat No." required>
            <input type="number" class="field" name="pamount" placeholder="Enter Your Amount" required min="1">
            <br>
            <button type="submit" class="btn-pay" name="ppayment">Confirm Payment</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<?php
if(isset($_POST['ppayment'])) {
    // Establish PostgreSQL connection
    $connection = pg_connect("host=192.168.16.1 port=5432 dbname=tyb14 user=tyb14 password=746166");
    if(!$connection) {
        die("Connection failed: " . pg_last_error());
    }

    // Insert query using parameterized statements
    $query = "INSERT INTO payrecords (name, flat_no, amount, status) VALUES ($1, $2, $3, 'Success')";
    $params = [$_POST['ptitle'], $_POST['pflat'], $_POST['pamount']];
    $result = pg_query_params($connection, $query, $params);

    if ($result) {
        echo "<script>
                alert('Payment Received...!!');
                window.location.href = 'Welcome.php';
              </script>";
    } else {
        echo "<script>
                alert('Payment Failed. Please try again.');
                window.location.href = 'payment.php';
              </script>";
    }

    pg_close($connection);
}
?>
