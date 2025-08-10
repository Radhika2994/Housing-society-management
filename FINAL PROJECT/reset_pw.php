<?php
require 'db_conn.php';

if (!isset($_GET['token'])) {
    die("Invalid request.");
}

$token = $_GET['token'];

// Validate token
$result = pg_query_params($conn, "SELECT * FROM password_resets WHERE token = $1 AND expires_at > NOW()", array($token));

if (pg_num_rows($result) == 0) {
    die("Invalid or expired token.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="update_password.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="password" name="new_password" placeholder="Enter new password" required>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
