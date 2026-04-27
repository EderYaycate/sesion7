<?php
include 'db.php';
$result = $conn->query("SELECT * FROM libros");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        h1 { color: #333; margin-bottom: 15px; }

        a.add-btn {
            background: #1a73e8;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 15px;
        }

        th {
            background: #1a73e8;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td { padding: 10px 12px; border-bottom: 1px solid #ddd; }

        tr:hover { background: #f0f4ff; }

        a { text-decoration: none; margin-right: 8px; }
        .read   { color: #1a73e8; }
        .edit   { color: #f59e0b; }
        .delete { color: #ef4444; }
    </style>
</head>
<body>

<h1> Digital Library — TECSUP</h1>
<a href="add.php" class="add-btn">+ Add Book</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Specialty</th>
            <th>Publisher</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['titulo'] ?></td>
            <td><?= $row['autor'] ?></td>
            <td><?= $row['anio'] ?></td>
            <td><?= $row['especialidad'] ?></td>
            <td><?= $row['editorial'] ?></td>
            <td>
              <a href="<?= htmlspecialchars($row['url']) ?>" target="_blank" class="read"> Read</a>
                <a href="edit.php?id=<?= $row['id'] ?>" class="edit"> Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="delete"
                   onclick="return confirm('Delete this book?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>