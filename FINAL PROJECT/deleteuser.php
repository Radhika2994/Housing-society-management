<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: Adminlogin.php");
    exit;
}
require_once 'db_conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM registration WHERE id = $1";
    $result = pg_query_params($conn, $sql, array($id));
    if ($result) {
        echo "<script>alert('User deleted successfully.'); window.location.href='managemem.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to delete user.'); window.location.href='managemem.php';</script>";
        exit();
    }
} else {
    header("Location: managemem.php");
    exit();
}
?>
