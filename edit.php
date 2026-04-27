<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM libros WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo       = $_POST['titulo'];
    $autor        = $_POST['autor'];
    $anio         = $_POST['anio'];
    $url          = $_POST['url'];
    $especialidad = $_POST['especialidad'];
    $editorial    = $_POST['editorial'];

    $stmt = $conn->prepare("UPDATE libros 
                            SET titulo=?, autor=?, anio=?, url=?, especialidad=?, editorial=? 
                            WHERE id=?");
    $stmt->bind_param("ssisssi", $titulo, $autor, $anio, $url, $especialidad, $editorial, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        h1 { color: #333; margin-bottom: 5px; }

        a.back {
            color: #1a73e8;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        a.back:hover { text-decoration: underline; }

        form {
            background: white;
            padding: 25px;
            border-radius: 8px;
            max-width: 500px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 100%;
            padding: 9px 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #1a73e8;
        }

        button {
            background: #1a73e8;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            width: 100%;
        }

        button:hover { background: #06afd9; }
    </style>
</head>
<body>

<h1> Edit Book</h1>
<a href="index.php" class="back">← Back to list</a>

<form method="POST">
    <label>Title:</label>
    <input type="text" name="titulo" value="<?= htmlspecialchars($book['titulo']) ?>" required>

    <label>Author:</label>
    <input type="text" name="autor" value="<?= htmlspecialchars($book['autor']) ?>" required>

    <label>Year:</label>
    <input type="number" name="anio" value="<?= $book['anio'] ?>" required>

    <label>URL:</label>
    <input type="url" name="url" value="<?= htmlspecialchars($book['url']) ?>" required>

    <label>Specialty:</label>
    <input type="text" name="especialidad" value="<?= htmlspecialchars($book['especialidad']) ?>" required>

    <label>Publisher:</label>
    <input type="text" name="editorial" value="<?= htmlspecialchars($book['editorial']) ?>" required>

    <button type="submit">Update Book</button>
</form>

</body>
</html>