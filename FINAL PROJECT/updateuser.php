<?php
session_start();
require_once 'db_conn.php';

$Id = $_POST['Id'] ?? null;

if (!$Id) {
    echo "<script>alert('No Record Found'); window.location.href='managemem.php';</script>";
    exit();
}

$query = "SELECT * FROM registration WHERE id = $1";
$query_run = pg_query_params($conn, $query, array($Id));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Member</title>
  <style>
    .Add_btn {
      padding: 5px 10px;
      background: #0B87A6;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      color: #fff;
      transition: background 0.5s;
      cursor: pointer;
    }
    .Add_btn:hover {
      background: #19B3D3;
    }
    .container {
      background: #b7f7d7;
      width: 550px;
      padding: 20px;
      margin: 90px auto;
      text-align: center;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    .container form {
      max-width: 400px;
      margin: 20px auto;
    }
    form input {
      width: 100%;
      height: 40px;
      margin-bottom: 10px;
      padding: 0 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <?php
  if ($query_run && pg_num_rows($query_run) > 0) {
      while ($row = pg_fetch_assoc($query_run)) {
          ?>
          <div class="container">
              <h1>Update Member</h1>
              <form action="" method="POST">
                  <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">
                  <input type="text" placeholder="Username" name="username" value="<?php echo $row['username']; ?>" required>
                  <input type="email" placeholder="E-mail" name="email" value="<?php echo $row['email']; ?>" required>
                  <input type="text" placeholder="Flat-No." name="flatno" value="<?php echo $row['flatno']; ?>" required>
                  <input type="tel" placeholder="Mobile Number" name="mobno" value="<?php echo $row['mobileno']; ?>" required>
                  <button type="submit" name="update" class="Add_btn">Update Data</button>
              </form>
              <?php
              if (isset($_POST['update'])) {
                  $updateId = $_POST['Id'];
                  $Username = $_POST['username'];
                  $email = $_POST['email'];
                  $flatno = $_POST['flatno'];
                  $mobileno = $_POST['mobno'];
                  
                  $update_query = "UPDATE registration SET Username = $1, Email = $2, Flatno = $3, MobileNo = $4 WHERE id = $5";
                  $update_params = array($Username, $email, $flatno, $mobileno, $updateId);
                  $update_result = pg_query_params($conn, $update_query, $update_params);
                  
                  if ($update_result) {
                      echo "<script>
                              alert('Updated Successfully!');
                              window.location.href = 'managemem.php';
                            </script>";
                  } else {
                      echo "<script>
                              alert('Update failed. Please try again.');
                              window.location.href = 'updateuser.php';
                            </script>";
                  }
              }
              ?>
          </div>
          <?php
      }
  } else {
      echo "<script>alert('No Record Found'); window.location.href='managemem.php';</script>";
  }
  ?>
</body>
</html>
