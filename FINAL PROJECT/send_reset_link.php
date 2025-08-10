<?php
require 'db_conn.php'; // Include your PostgreSQL connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    // Check if email exists
    $result = pg_query_params($conn, "SELECT * FROM users WHERE email = $1", array($email));
    
    if (pg_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Store token in database
        pg_query_params($conn, "INSERT INTO password_resets (email, token, expires_at) VALUES ($1, $2, $3)", 
            array($email, $token, $expires_at));

        // Send email (assuming email sending is configured on the server)
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click this link to reset your password: $reset_link";
        $headers = "From: support@yourwebsite.com";

        mail($email, $subject, $message, $headers);

        echo "A password reset link has been sent to your email.";
    } else {
        echo "Email not found.";
    }
}
?>
