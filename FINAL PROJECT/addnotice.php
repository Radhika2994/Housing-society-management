<?php
session_start();
/*if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
	die("session error not logged in");
	echo"session error:not logged in.debug info:";
	print_r($_SESSION);	
	header("location: Adminlogin.php");
	exit();
 exit;
}*/
require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // $noticeTitle   = $_POST['title'];
   // $noticeContent = $_POST['content'];
	//echo $noticeTitle." ".$noticeContent."<br>"; 
	$name=$_POST['name'];
	$type=$_POST['type'];
	$date=$_POST['date'];
	$message=$_POST['message'];  
	echo $name;
		echo $type;
	echo $date;
	echo $message;
if(!empty($type) && !empty($name) && !empty($message) && !empty($date) ){
    $sql = "INSERT INTO notices (name,type,noticedate,message) VALUES ($1, $2,$3,$4);";
    $result = pg_query_params($conn, $sql, array($name,$type,$date, $message));

    if ($result) {
         echo "<script>alert('Notice added successfully.'); window.location.href='managemem.php';</script>";
    } else {
         die("error ninserting notice".pg_last_error($conn));
       
    }
    }
    else{
	    echo"<script>alert('all fields are required!');window.location.href='addnotice.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Notice</title>
    <link rel="stylesheet" href="dashstyle.css">
    <style>
      .form-container {
         background: #fff;
         width: 500px;
         padding: 20px;
         margin: 100px auto;
         box-shadow: 0 4px 10px rgba(0,0,0,0.15);
         border-radius: 10px;
         text-align: center;
      }
      .form-container input[type="text"],
      .form-container textarea {
         width: 90%;
         padding: 10px;
         margin: 10px 0;
         border: 1px solid #ccc;
         border-radius: 5px;
      }
      .form-container button {
         padding: 10px 20px;
         background: #19B3D3;
         border: none;
         border-radius: 5px;
         color: #fff;
         cursor: pointer;
         transition: background 0.3s ease;
      }
      .form-container button:hover {
         background: #0B87A6;
      }
    </style>
</head>
<body style="background:#d8bfd8">

  <header style="background:#121212">
     <label for="check">
         <i class="fas fa-bars" id="sidebar_btn"></i>
     </label>
     <div class="left_area">
         <h1>BEVERLY HILLS </h1>
     </div>
     <div class="right_area">
         <a href="logout.php" class="logout_btn">Logout</a>
     </div>
  </header>
  <div class="sidebar" style="background:#121212">
    <center>
      <img src="profile.jpg" class="profile_image" alt="">
      <h4>Admin</h4>
    </center>
    <a href="managemem.php"><i class="fas fa-desktop"></i><span>Manage Members</span></a>
    <a href="addnotice.php" class="active"><i class="fas fa-bullhorn"></i><span>Add Notice</span></a>
    <a href="viewcomplaints.php"><i class="fas fa-envelope-open-text"></i><span>View Complaints</span></a>
    <a href="viewpayment.php"><i class="fas fa-file-invoice-dollar"></i><span>View Payments</span></a>
    <a href="amenities.php"><i class="fas fa-camera-retro"></i><span>Amenties</span></a>
  </div>
  <div class="content">
     <h1>Add Notice</h1>
     <div class="form-container" style="background:#121212">
       <form action="addnotice.php" method="POST">
           <!--<input type="text" name="title" placeholder="Notice Title" required>
           <textarea name="content" placeholder="Notice Content" rows="5" required></textarea>
-->

<label style="color:white">Title </label> &nbsp;<input type="text" name="name" placeholder="title of notice">
<label style="color:white">Type</label>&nbsp; <input type="radio" name="type" value="Event" >&nbsp;<label style="color:white">Event&nbsp;</label>
<input type="radio" name="type" value="Announcement" > <label style="color:white">Announcement</label>
<br><label style="color:white">Date</label>&nbsp; <input type="text" name="date" placeholder="yyyy-mm-dd"><br><label style="color:white">
Message </label><input type="text" name="message">           
<button type="submit" style="background:#4fffbd ;color:black">Add Notice</button>
       </form>
     </div>
  </div>
</body>
</html>
