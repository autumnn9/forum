<?php include 'config.php'; 
if (!isset($_GET['id'])) die("Brak ID");
$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$row = $conn->query($sql)->fetch_assoc();
if (!can_edit_delete($row['created_by'])) header("Location: index.php");
$topic_id = $row['topic_id'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edytuj post</h1>
    <form method="POST">
        <textarea name="content" required><?php echo $row['content']; ?></textarea>
        <button type="submit">Zapisz</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $content = $_POST['content'];
        $sql = "UPDATE posts SET content='$content' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: topic.php?id=$topic_id");
        } else {
            echo "Błąd: " . $conn->error;
        }
    }
    ?>
</body>
</html>
