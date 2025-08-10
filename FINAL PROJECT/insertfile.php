<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Username  = $_POST['username'];
    $email     = $_POST['email'];
    $flatno    = $_POST['flatno'];
    $mobileno  = $_POST['mobno'];
    $familymem = $_POST['fammem'];
    $Password  = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password
}

// PostgreSQL connection parameters
$host     = "192.168.16.1";
$port     = "5432";
$dbname   = "tyb14"; // Changed to the correct database name
$user     = "tyb14";
$password = "746166"; // If password is needed

// Establish connection to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Sorry, we failed to connect: " . pg_last_error());
}

// Parameterized query using pg_query_params()
$sql = "INSERT INTO registration (Username, Email, Flatno, MobileNo, \"nno of family members\", Password, active) 
        VALUES ($1, $2, $3, $4, $5, $6, '1')";

$params = [$Username, $email, $flatno, $mobileno, $familymem, $Password];

$result = pg_query_params($conn, $sql, $params);

if ($result) {
    echo "<script>
            alert('Member added Successfully..!!');
            window.location.href = 'managemem.php';
          </script>";
} else {
    echo "<script>
            alert('Not Saved...Please try again. Error: " . pg_last_error($conn) . "');
            window.location.href = 'insertuser.php';
          </script>";
}

pg_close($conn);
?>
