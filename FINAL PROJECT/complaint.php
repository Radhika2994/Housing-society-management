<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.html");
    exit;
}

// Include database connection
require_once 'db_conn.php';  // Ensure this file sets $conn correctly

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $complaint = htmlspecialchars(trim($_POST['complaint']));

    // Validate inputs
    if (empty($title) || empty($complaint)) {
        echo "<script>alert('Please fill in all fields'); window.history.back();</script>";
        exit;
    }

    // Check database connection
    if (!$conn) {
        die("Database connection failed: " . pg_last_error());
    }

    // Insert complaint
    $sql = "INSERT INTO combox (title, complaint) VALUES ($1 ,$2)";
    $result = pg_query_params($conn, $sql, array($title, $complaint));

    if ($result) {
        echo "<script>alert('Complaint registered successfully.'); window.location.href='complaint.php';</script>";
    } else {
        $error = pg_last_error($conn);
        echo "<script>alert('Error: " . addslashes($error) . "'); window.location.href='complaint.php';</script>";
    }
    exit();
    if(!result){
	    die("query failed:".pg_last_error($conn));
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Complaint</title>
    <link rel="stylesheet" href="dashstyle.css">
    <style>
      /* General Page Styling */
      body {
         font-family: Arial, sans-serif;
         background: #f4f4f4;
         margin: 0;
         padding: 0;
      }

      /* Complaint Container */
      .complaint-container {
         background: white;
         width: 500px;
         padding: 20px;
         margin: 100px auto;
         box-shadow: 0 4px 10px rgba(0,0,0,0.15);
         border-radius: 10px;
         text-align: center;
      }

      /* Input Fields */
      .complaint-container input[type="text"],
      .complaint-container textarea {
         width: 90%;
         padding: 12px;
         margin: 10px 0;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
         background: #fafafa;
      }

      /* Button */
      .complaint-container button {
         padding: 12px 20px;
         background: #19B3D3;
         border: none;
         border-radius: 5px;
         color: #fff;
         font-size: 16px;
         cursor: pointer;
         transition: background 0.3s ease;
      }

      .complaint-container button:hover {
         background: #0B87A6;
      }

      /* Sidebar & Header Styling */
      .sidebar {
         position: fixed;
         width: 250px;
         height: 100%;
         background: #121212;
         padding-top: 20px;
      }

      .sidebar a {
         display: block;
         color: white;
         padding: 12px;
         text-decoration: none;
         transition: 0.3s;
      }

      .sidebar a:hover {
         background: #1abc9c;
      }

      .sidebar .active {
         background: #19B3D3;
         font-weight: bold;
      }

      /* Header */
      header {
         background: #34495e;
         color: white;
         padding: 15px;
         
         font-size: 22px;
         font-weight: bold;
      }

      .logout_btn {
         float: right;
         padding: 10px 20px;
         background: #e74c3c;
         color: white;
         border-radius: 5px;
         text-decoration: none;
         margin-right: 20px;
      }

      .logout_btn:hover {
         background: #c0392b;
      }

      /* Page Content */
      .content {
         margin-left: 270px;
         padding: 20px;
      }

      .content h1 {
         color: #333;
         text-align: center;
         font-size: 28px;
         margin-bottom: 20px;
      }
    </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <center>
      <img src="profile.jpg" class="profile_image" alt="User Profile">
      <h4><?php echo htmlspecialchars($_SESSION['username']); ?></h4>
    </center>
    <a href="Welcome.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
    <a href="noticebrd.php"><i class="fas fa-bullhorn"></i><span>Notice Board</span></a>
    <a href="complaint.php" class="active"><i class="fas fa-envelope-open-text"></i><span>Register Complaint</span></a>
    <a href="payment.php"><i class="fas fa-file-invoice-dollar"></i><span>Maintenance Payment</span></a>
    <a href="amenities.php"><i class="fas fa-camera-retro"></i><span>Amenities</span></a>
  </div>

  <!-- Page Header -->
  <header style="background:#121212">
     <marquee style="font-size:50px"> Beverly Hills</marquee>
     <a href="logout.php" class="logout_btn">Logout</a>
  </header>

  <!-- Main Content -->
  <div class="content">
     <h1>Register Complaint</h1>
     <div class="complaint-container"style="background:#121212">
       <form action="complaint.php" method="POST">
           <input type="text" name="title" placeholder="Complaint Title" required maxlength="100">
           <textarea name="complaint" placeholder="Describe your complaint" rows="5" required maxlength="500"></textarea>
           <button type="submit" style="background:#c0392b">Submit Complaint</button>
       </form>
     </div>
  </div>

</body>
</html>
