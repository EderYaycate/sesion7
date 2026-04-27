<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo       = $_POST['titulo'];
    $autor        = $_POST['autor'];
    $anio         = $_POST['anio'];
    $url          = $_POST['url'];
    $especialidad = $_POST['especialidad'];
    $editorial    = $_POST['editorial'];

    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, anio, url, especialidad, editorial) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $titulo, $autor, $anio, $url, $especialidad, $editorial);

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
    <title>Add Book</title>
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

        button:hover { background: #1558b0; }
    </style>
</head>
<body>

<h1> Add New Book</h1>
<a href="index.php" class="back">← Back to list</a>

<form method="POST">
    <label>Title:</label>
    <input type="text" name="titulo" required>

    <label>Author:</label>
    <input type="text" name="autor" required>

    <label>Year:</label>
    <input type="number" name="anio" required>

    <label>URL:</label>
    <input type="url" name="url" required>

    <label>Specialty:</label>
    <input type="text" name="especialidad" required>

    <label>Publisher:</label>
    <input type="text" name="editorial" required>

    <button type="submit">Save Book</button>
</form>

</body>
</html>