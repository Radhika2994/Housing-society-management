<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Username = $_POST['username'];
    $flatno   = $_POST['flatno'];
    $Password = $_POST['password'];
    /*$phone=$_POST['phone'];
    $phone=trim($phone);
    $phone=preg_replace('/\D/','',$phone);
}
 if strlen($phone) !== 10)
 {
	 echo"<script> 
		 alert ('sorry invalid credentials!!');
window.location.href='login.html';
</script>";
exit();
 }*/

$host     = "192.168.16.1";
$port     = "5432";
$dbname   = "tyb14";
$user     = "tyb14";
$password = ""; // Set password if required


$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}


$query  = "SELECT * FROM registration WHERE username = $1 AND flatno = $2";
$result = pg_query_params($conn, $query, [$Username, $flatno]);
$num    = pg_num_rows($result);

if ($num == 1) {
    $row = pg_fetch_assoc($result);

    if ($row['active'] == 1) { // Only allow login if active = 1
        $_SESSION['loggedin'] = true;
	$_SESSION['username'] = $Username;
/*	if(preg_match('/^\d{10}$/',$phone))
	{
		echo "valid phone number";
	}
	else
	{
		echo "invalid phone number.please enter exactly 10 digits.";
	}*/
    }

        echo "<script>
                alert('Welcome, You are logged in...!');
                window.location.href = 'Welcome.php';
              </script>";
        exit();
    } else { // If active = 0, show message
        echo "<script>
                alert('Your account is pending admin approval.');
                window.location.href = 'login.html';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Sorry, Invalid credentials...!');
            window.location.href = 'login.html';
          </script>";
    exit();
}
?>
