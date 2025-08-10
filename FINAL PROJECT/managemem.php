<?php
session_start();

//if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  //  header("location: Adminlogin.php");
//    exit;
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Member</title>
  <link rel="stylesheet" href="dashstyle.css">
  <!-- No online fonts are used -->
  <style>
    /* Table styling for member management */
    .content-table {
      border-collapse: collapse;
      margin: 25px 0 25px 13px;
      font-size: 0.9em;
      min-width: 400px;
      border-radius: 5px 5px 0 0;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      background: rgba(255, 255, 255, 0.9);
    }
    .content-table thead tr {
      background-color: #121212;
      color: #ffffff;
      text-align: left;
      font-weight: 900;
    }
    .content-table th,
    .content-table td {
      padding: 15px;
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
    /* Buttons for table actions */
    .Table_btn {
      padding: 5px;
      background: #4fffbd;
      text-decoration: none;
      float: right;
      margin-top: -3px;
      margin-right: 40px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      color: black;
      transition: background 0.5s;
    }
    .Table_btn:hover {
      background: #19B3D3;
    }
    .Table_btn1 {
      padding: 8px;
      background: #4fffbd;
      text-decoration: none;
      float: left;
      margin-top: -1px;
      margin-left: 15px;
      margin-right: 40px;
      border-radius: 5px;
      font-size: 15px;
      font-weight: 600;
      color: black;
      transition: background 0.5s;

    }
    .Table_btn1:hover {
      background: #19B3D3;
    }
  </style>
</head>
<body style="background:#d8bfd8">

  <!-- Header area start -->
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
  <!-- Header area end -->
  <!-- Sidebar start -->
  <div class="sidebar" style="background:#121212">
    <center>
      <img src="profile.jpg" class="profile_image" alt="Admin Profile">
      <h4>Admin</h4>
    </center>
    <a href="managemem.php" class="active"><i class="fas fa-desktop"></i><span>Manage Members</span></a>
    <a href="addnotice.php"><i class="fas fa-bullhorn"></i><span>Add Notice</span></a>
    <a href="viewcomplaints.php"><i class="fas fa-envelope-open-text"></i><span>View Complaints</span></a>
    <a href="viewpayment.php"><i class="fas fa-file-invoice-dollar"></i><span>View Payments</span></a>
    <a href="photo.php"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>
  </div>
  <!-- Sidebar end -->
  <div class="content">
    <br><br><br><br><br><br>
    <a href="insertuser.php" class="Table_btn1">Add Member</a><br><br>
    <?php
    // Establish PostgreSQL connection using the specified parameters
    $connection = pg_connect("host=192.168.16.1 port=5432 dbname=tyb14 user=tyb14 password=746166");
    if (!$connection) {
      die("Connection failed: " . pg_last_error());
    }
    

    // Handle activation request using parameterized query
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['activate'])) {
    $id = $_POST['Id'];
    echo $id;
    echo "ssdf";
    
    $query = "UPDATE registration SET active = 1 WHERE id ='$id';";
    $result=pg_query($connection,$query);

    //$result = pg_query_params($connection, $query, array($id));
      
  
      if ($result) {
        echo "<script>alert('User activated successfully!'); window.location.href='managemem.php';</script>";
      }else{
        echo "<script>alert('Failed to update status!'); window.location.href='managemem.php';</iscript>";
      }
    }
  

    
    // Fetch all registration records
   $query1 = "SELECT * FROM registration;";
   $result1= pg_query($connection, $query1);
?>
    <table class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Flat No.</th>
           <th>Mobile No.</th>
          <th>No. of Family Members</th>
          <th>Update</th>
          <th>Delete</th>
          <th>Status</th>
        </tr>
      </thead>

<?php 
   if($result1){
	  
	   while ($row = pg_fetch_assoc($result1)) {
		echo " <tbody>
        <tr>
          <td>";      
   echo $row['id'];
   echo "</td>
          <td> ".$row['username']."</td>
          <td>". $row['email']."</td>
          <td>". $row['flatno'] ."</td>
          <td>". $row['mobileno'] ."</td>
          <td>". $row['nno of family members']." </td>";


echo '
<form action="updateuser.php" method="post">
            <input type="hidden" name="Id" value=" $row[`id`]">  
            <td><input type="submit" name="edit" class="Table_btn" value="Update"></td>
          </form>
';
echo '<form action="deleteuser.php" method="post">
	    <input type="hidden" name="Id" value="'
.$row["id"].'>
            <td><input type="submit" name="delete" class="Table_btn" value="Delete"></td>
          </form>';

echo "<td>";
if($row['active'] ==1) {
              echo '<button class="Table_btn" style="background-color: green; color: white;" disabled>Active</button>';
            } else {
              echo '<form action="" method="post">
                <input type="hidden" name="Id" value="'.$row["id"].'">
                <input type="submit" name="activate" class="Table_btn" style="background-color: red; color: white;" value="Activate">
              </form>';


	}
	   }
	   echo " </td>
        </tr>
      </tbody>
";
}
else {

  echo "<tr><td colspan='9'>No Record found</tr></td>;
      }";
    pg_close($connection);


   }
   /*   if($result1){ 
        while ($row = pg_fetch_assoc($result1)) {
     ?>
      <tbody>
        <tr>
          <td><?php echo $row['Id']; ?></td>
          <td><?php echo $row['Username']; ?></td>
          <td><?php echo $row['Email']; ?></td>
          <td><?php echo $row['Flatno']; ?></td>
          <td><?php echo $row['MobileNo']; ?></td>
          <td><?php echo $row['nno of family members']; ?></td>
          <form action="updateuser.php" method="post">
            <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">  
            <td><input type="submit" name="edit" class="Table_btn" value="Update"></td>
	  </form>

         <form action="deleteuser.php" method="post">
            <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">  
            <td><input type="submit" name="delete" class="Table_btn" value="Delete"></td>
          </form>
          <td>
            <?php if ($row['active'] ==1) { ?>
              <button class="Table_btn" style="background-color: green; color: white;" disabled>Active</button>
            <?php } else { ?>
              <form action="" method="post">
                <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">
                <input type="submit" name="activate" class="Table_btn" style="background-color: red; color: white;" value="Activate">
              </form>
            <?php } ?>
          </td>
        </tr>
      </tbody>
      <?php
        }
   } else {
	   echo <tr><td colspan='9'>No Record found</tr></td>;
      }
    pg_close($connection);
    */ ?>
    </table>
  </div>
</body>
</html>
