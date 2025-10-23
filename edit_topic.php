<?php include 'config.php'; 
if (!isset($_GET['id'])) die("Brak ID");
$id = $_GET['id'];
$sql = "SELECT * FROM topics WHERE id=$id";
$row = $conn->query($sql)->fetch_assoc();
if (!can_edit_delete($row['created_by'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj temat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edytuj temat</h1>
    <form method="POST">
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required>
        <button type="submit">Zapisz</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $sql = "UPDATE topics SET title='$title' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Błąd: " . $conn->error;
        }
    }
    ?>
</body>
</html>
