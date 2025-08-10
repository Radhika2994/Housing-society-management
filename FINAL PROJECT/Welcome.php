<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome dashboard</title>
  <link rel="stylesheet" href="dashstyle.css">
 <!-- <script src="https://kit.fontawesome.com/2edfbc5391.js" crossorigin="anonymous"></script>-->
  <style>
     
    .far {
      color: #E0E0E0;
      padding-left: 20px;
    }
    .col-div-3 .box p {
      font-size: 25px;
      color:#5D3FD3
    }
    .box .fas {
      color: #5D3FD3;
      position: absolute;
      padding-top: 50px;
    }
    .box .fas .fa-home {
      color: #E0E0E0;
      padding-left: 20px;
    }
  </style>
</head>
<body style="background:#e0e0fa">
  <!--<input type="checkbox" id="check">-->
  <!--header area start-->
  <header style="background:#121212">
    <label for="check">
      <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      <h1>BEVERLY HILLS</h1>
    </div>
    <div class="right_area">
      <a href="logout.php" class="logout_btn">Logout</a>
    </div>
  </header>
  <!--header area end-->
  <!--sidebar start-->
  <div class="sidebar" style="background:#121212">
    <center>
      <img src="profile.jpg" class="profile_image" alt="">
      <h4><?php echo $_SESSION['username']; ?></h4>
    </center>
    <a href="Welcome.php" class="active"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
    <a href="noticebrd.php"><i class="fas fa-bullhorn"></i><span>Notice Board</span></a>
    <a href="complaint.php"><i class="fas fa-envelope-open-text"></i><span>Register Complaint</span></a>
    <a href="payment.php"><i class="fas fa-file-invoice-dollar"></i><span>Maintenance Payment</span></a>
    <!--<a href="userphoto.php"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>-->
    <a href="amenities.php"><i class="fas fa-camera-retro"></i><span>Amenities</span></a>

  </div>
  <!--sidebar end-->
  <div class="content">
    <h1>Welcome to Dashboard</h1>
    <?php 
      // Connect to PostgreSQL using your specified parameters
      $conn = pg_connect("host=192.168.16.1 port=5432 dbname=tyb14 user=tyb14 password=746166");
      if (!$conn) {
          die("Connection failed: " . pg_last_error());
      }
      
      $user_name = $_SESSION['username'];
      
      // If your table was created with quoted column names, preserve the case:
      $sql = "SELECT \"username\", \"flatno\" FROM registration WHERE \"username\" = $1";
      // If not, you might use: "SELECT username, flatno FROM registration WHERE username = $1"
      $result = pg_query($conn, $sql, array($user_name));
      
      if (pg_num_rows($result) > 0) {
          while ($row = pg_fetch_assoc($result)) {
              echo '<div class="col-div-3">
                      <div class="box">
                        <p>' . $row['Username'] . '<br><span>Your Username</span></p>
                        <i class="far fa-user fa-2x"></i>
                      </div>
                    </div>
                    <div class="col-div-3">
                      <div class="box">
                        <p>' . $row['Flatno'] . '<br><span>Your Flat No.</span></p>
                        <i class="fas fa-home fa-2x"></i>
                      </div>
                    </div>
                    <div class="col-div-3">
                      <div class="box">
                        <p>Fergusson<br><span>Society Secretary</span></p>
                        <i class="fas fa-user-tie fa-2x"></i>
                      </div>
                    </div>';
          }
      } else {
          echo "No records found!";
      }
    ?>
  </div>
</body>
</html>
