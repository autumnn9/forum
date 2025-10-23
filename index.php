<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Forum Dyskusyjne</h1>
    <?php if (is_logged_in()): ?>
        <p>Witaj, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Wyloguj</a></p>
        <a href="new_topic.php">Nowy temat</a>
    <?php else: ?>
        <a href="login.php">Zaloguj</a> | <a href="register.php">Zarejestruj</a>
    <?php endif; ?>

    <h2>Lista tematów</h2>
    <?php
    $sql = "SELECT topics.*, users.username FROM topics JOIN users ON topics.created_by = users.id ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='topic'>";
            echo "<h3><a href='topic.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
            echo "<p>Autor: " . $row['username'] . " | Data: " . $row['created_at'] . "</p>";
            if (can_edit_delete($row['created_by'])) {
                echo "<a href='edit_topic.php?id=" . $row['id'] . "'>Edytuj</a> | <a href='delete_topic.php?id=" . $row['id'] . "' onclick='return confirm(\"Na pewno?\")'>Usuń</a>";
            }
            echo "</div>";
        }
    } else {
        echo "Brak tematów.";
    }
    ?>
</body>
</html>
