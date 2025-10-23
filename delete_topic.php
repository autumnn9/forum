<?php
include 'config.php';
if (!isset($_GET['id'])) die("Brak ID");
$id = $_GET['id'];
$sql = "SELECT created_by FROM topics WHERE id=$id";
$row = $conn->query($sql)->fetch_assoc();
if (!can_edit_delete($row['created_by'])) header("Location: index.php");

$conn->query("DELETE FROM posts WHERE topic_id=$id");
$conn->query("DELETE FROM topics WHERE id=$id");
header("Location: index.php");
?>
