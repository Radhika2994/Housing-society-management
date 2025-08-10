<?php
require 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Get email from token
    $result = pg_query_params($conn, "SELECT email FROM password_resets WHERE token = $1", array($token));
    
    if (pg_num_rows($result) == 0) {
        die("Invalid or expired token.");
    }

    $row = pg_fetch_assoc($result);
    $email = $row['email'];

    // Update password in users table
    pg_query_params($conn, "UPDATE users SET password = $1 WHERE email = $2", array($hashed_password, $email));

    // Delete used token
    pg_query_params($conn, "DELETE FROM password_resets WHERE email = $1", array($email));

    echo "Password has been reset. <a href='login.html'>Login</a>";
}
?>
