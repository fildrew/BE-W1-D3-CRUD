<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Book Details</title>
<link rel="stylesheet" href="../main.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="wallpaper">
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1 class="fw-bold">Book Details</h1>
            <div>
            <a href="index.php" class="btn btn-primary shadow rounded-pill">Back</a>
            </div>
        </header>
        <div class="book-details p-5 my-4 shadow hover">
            <?php
            include("connect.php");

            $id = $_GET['id'];

            if ($id) {
                $sql = "SELECT * FROM books WHERE id = ?";//or id=$id
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
                $row = $stmt->fetch();

               
                if ($row) {    
                 ?>
                 <h3>Title:</h3>
                 <p class="font-monospace"><?php echo $row["title"]; ?></p>
                 <h3>Description:</h3>
                 <p class="font-monospace"><?php echo $row["description"]; ?></p>
                 <h3>Author:</h3>
                 <p class="font-monospace"><?php echo $row["author"]; ?></p>
                 <h3>Type:</h3>
                 <p class="font-monospace"><?php echo $row["type"]; ?></p>
                
                 <?php
                
                }else{
                    echo "<h3>No books found</h3>";
                }
            } else {
                echo "<h3>No book ID provided</h3>";
            }
            ?>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>