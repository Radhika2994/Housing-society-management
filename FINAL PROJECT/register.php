<!--<!DOCTYPE HTML>
<HTML>
<head>
<style>
*{
background-color:#e6e6fa;
}
</style>
</head>
<body>
</body>-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Username  = $_POST['username'];
    $email     = $_POST['email'];
    $flatno    = $_POST['flatno'];
    $mobileno  = $_POST['mobno'];
    $familymem = $_POST['fammem'];
    $Password  = $_POST['password'];
}

require_once 'db_conn.php';

$sql = "INSERT INTO registration (Username, Email, Flatno, MobileNo, \"nno of family members\", Password, active) 
        VALUES ($1, $2, $3, $4, $5, $6, 0)";
$params = array($Username, $email, $flatno, $mobileno, $familymem, $Password);
$result = pg_query_params($conn, $sql, $params);

if ($result) {
    echo "<script>
            alert('Registration successful...you can login after admin approval.');
            window.location.href = 'login.html';
          </script>";
    exit(); 
} else {
    echo "<script>
            alert('Registration failed...Please try again.');
            window.location.href = 'login.html';
          </script>";
    exit();
}
?>
