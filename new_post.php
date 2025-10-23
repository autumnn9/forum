<?php
include 'config.php';
if (!is_logged_in() || $_SERVER['REQUEST_METHOD'] != 'POST') header("Location: index.php");
$topic_id = $_POST['topic_id'];
$content = $_POST['content'];
$created_by = $_SESSION['user_id'];
$sql = "INSERT INTO posts (topic_id, content, created_by) VALUES ($topic_id, '$content', $created_by)";
if ($conn->query($sql) === TRUE) {
    header("Location: topic.php?id=$topic_id");
} else {
    echo "Błąd: " . $conn->error;
}
?>
