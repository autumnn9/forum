<?php include 'config.php'; 
if (!isset($_GET['id'])) die("Brak ID tematu");
$topic_id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Temat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Powrót</a>
    <?php
    $sql = "SELECT topics.title FROM topics WHERE id=$topic_id";
    $topic = $conn->query($sql)->fetch_assoc();
    echo "<h1>" . $topic['title'] . "</h1>";

    if (is_logged_in()) {
        echo "<form method='POST' action='new_post.php'>";
        echo "<input type='hidden' name='topic_id' value='$topic_id'>";
        echo "<textarea name='content' placeholder='Dodaj post' required></textarea>";
        echo "<button type='submit'>Dodaj</button>";
        echo "</form>";
    }

    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.created_by = users.id WHERE topic_id=$topic_id ORDER BY created_at ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<p>Autor: " . $row['username'] . " | Data: " . $row['created_at'] . "</p>";
            if (can_edit_delete($row['created_by'])) {
                echo "<a href='edit_post.php?id=" . $row['id'] . "'>Edytuj</a> | <a href='delete_post.php?id=" . $row['id'] . "' onclick='return confirm(\"Na pewno?\")'>Usuń</a>";
            }
            echo "</div>";
        }
    } else {
        echo "Brak postów.";
    }
    ?>
</body>
</html>
