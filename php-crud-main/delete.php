

<?php
if (isset($_GET['id'])) {
    include("connect.php");
    $id = $_GET['id'];
    
    $sql = "DELETE FROM books WHERE id=?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        session_start();
        $_SESSION["delete"] = "Book Deleted Successfully!";
        header("Location:index.php");
        exit(); 
    } else {
        die("Something went wrong");
    }
} else {
    echo "Book does not exist";
}
?>
