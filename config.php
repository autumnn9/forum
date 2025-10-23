<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return is_logged_in() && $_SESSION['role'] === 'admin';
}

function can_edit_delete($created_by) {
    return is_logged_in() && ($_SESSION['user_id'] == $created_by || is_admin());
}
?>
