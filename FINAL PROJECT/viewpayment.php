<?php
session_start();
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
//     header("location: Adminlogin.php");
//     exit;
// }
require_once 'db_conn.php';

$query = "SELECT * FROM payrecords";
$query_run = pg_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Payments</title>
  <link rel="stylesheet" href="dashstyle.css">
  <style>
    .content-table {
      border-collapse: collapse;
      margin: 25px auto;
      font-size: 1em;
      min-width: 400px;
      width: 90%;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.15);
      background: #fff;
    }
    .content-table thead tr {
      background-color: #4fffbd;
      color: black;
      text-align: left;
      font-weight: bold;
    }
    .content-table th, .content-table td {
      padding: 15px;
      text-align: left;
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
    .no-records {
      text-align: center;
      font-size: 18px;
      color: #555;
      padding: 20px;
    }
  </style>
</head>
<body style="background:#d8bfd8">
 
  <header style="background:#121212">
    <label for="check">
      <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      <h1>Beverly Hills</h1>
    </div>
    <div class="right_area">
      <a href="logout.php" class="logout_btn">Logout</a>
    </div>
  </header>
  <div class="sidebar" style="background:#121212">
    <center>
      <img src="profile.jpg" class="profile_image" alt="Admin Profile">
      <h4>Admin</h4>
    </center>
    <a href="managemem.php"><i class="fas fa-users"></i><span>Manage Members</span></a>
    <a href="addnotice.php"><i class="fas fa-bullhorn"></i><span>Add Notice</span></a>
    <a href="viewcomplaints.php"><i class="fas fa-envelope-open-text"></i><span>View Complaints</span></a>
    <a href="viewpayment.php" class="active"><i class="fas fa-file-invoice-dollar"></i><span>View Payments</span></a>
    <a href="photo.php"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>
  </div>
  <div class="content">
    <h2 style="text-align: center; margin-top: 20px;">Payment Records</h2>
    <table class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Flat No.</th>
          <th>Amount</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($query_run && pg_num_rows($query_run) > 0) {
          while ($row = pg_fetch_assoc($query_run)) {
            ?>
            <tr>
              <td><?php echo htmlspecialchars($row['id']); ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['flatno']); ?></td>
              <td><?php echo htmlspecialchars($row['amount']); ?></td>
              <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='5' class='no-records'>No payment records found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
