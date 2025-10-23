<?php include 'config.php'; 
if (!is_logged_in()) header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Nowy temat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Nowy temat</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Tytuł" required>
        <button type="submit">Utwórz</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $created_by = $_SESSION['user_id'];
        $sql = "INSERT INTO topics (title, created_by) VALUES ('$title', $created_by)";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Błąd: " . $conn->error;
        }
    }
    ?>
</body>
</html>
