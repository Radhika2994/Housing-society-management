<?php
// db_conn.php – PostgreSQL connection configuration
$host = "192.168.16.1";
$port = "5432";
$dbname = "tyb14";
$user = "tyb14";
$password = "746166";

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Database connection failed: " . pg_last_error());
}
?>
