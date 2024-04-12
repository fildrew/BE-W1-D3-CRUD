<?php
    include('connect.php');

    if (isset($_POST["create"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $type = $_POST["type"];
        $description = $_POST["description"];

        $sqlInsert = "INSERT INTO books (title, author, type, description) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sqlInsert);
        if ($stmt->execute([$title, $author, $type, $description])) {
            session_start();
            $_SESSION["create"] = "Book added successfully!";
            header("Location:index.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }

    if (isset($_POST["edit"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $type = $_POST["type"];
        $description = $_POST["description"];
        $id = $_POST["id"];

        $sqlUpdate = "UPDATE books SET title = ?, type = ?, author = ?, description = ? WHERE id = ?";
        $stmt = $pdo->prepare($sqlUpdate);
        if ($stmt->execute([$title, $type, $author, $description, $id])) {
            session_start();
            $_SESSION["update"] = "Book updated successfully!";
            header("Location:index.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }
?>