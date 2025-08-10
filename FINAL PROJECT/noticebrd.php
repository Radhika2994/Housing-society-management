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
  <title>Notice Board</title>
  <link rel="stylesheet" href="dashstyle.css">
<!--  <script src="https://kit.fontawesome.com/2edfbc5391.js" crossorigin="anonymous"></script>-->
  <style>
    .content-table {
      border-collapse: collapse;
      margin: 25px 19px;
      margin-left: 13px;
      font-size: 0.9em;
      min-width: 400px;
      border-radius: 5px 5px 0 0;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .content-table thead tr {
      background-color: black;
      color: #ffffff;
      text-align: left;
      font-weight: 900;
    }

    .content-table th,
    .content-table td {
      padding: 15px 15px;
    }

    .content-table tbody tr {
      border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
      border-bottom: 2px solid #82abc7;
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
  <div class="sidebar"style="background:#121212">
    <center>
      <img src="profile.jpg" class="profile_image" alt="">
      <h4> <?php echo $_SESSION['username']; ?> </h4>
    </center>
    <a href="Welcome.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
    <a href="noticebrd.php" class="active"><i class="fas fa-bullhorn"></i><span>Notice Board</span></a>
    <a href="complaint.php"><i class="fas fa-envelope-open-text"></i><span>Register Complaint</span></a>
    <a href="payment.php"><i class="fas fa-file-invoice-dollar"></i><span>Maintenance Payment</span></a>
    <a href="amenities.php"><i class="fas fa-camera-retro"></i><span>Amenites</span></a>
    <!-- Additional sidebar links can be added here -->
  </div>
  <!--sidebar end-->
  <div class="content"><br><br><br><br>
    <?php
      // Establish PostgreSQL connection using the specified parameters
      $connection = pg_connect("host=192.168.16.1 port=5432 dbname=tyb14 user=tyb14 password=746166");
      if (!$connection) {
          die("Connection failed: " . pg_last_error());
      }

      // Query to select all notices
      $query = "SELECT * FROM notices";
      $query_run = pg_query($connection, $query);
      if(!$query_run)
      {
	      die("query failed:".pg_last_error($connection));
      }

    ?>
    <table class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Notice Name</th>
          <th>Notice Type</th>
          <th>Date</th>
          <th>Message</th>
        </tr>
      </thead>
      <?php
      if ($query_run) {
        while ($row = pg_fetch_assoc($query_run)) {
          // Adjust the array keys as needed.
          ?>
          <tbody>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['type']; ?></td>
              <td><?php echo $row['noticedate']; ?></td>
              <td><?php echo $row['message']; ?></td>
            </tr>
          </tbody>
          <?php
        }
      } else {
          echo "No Record found";
      }
      ?>
    </table>   
  </div>
</body>
</html>
