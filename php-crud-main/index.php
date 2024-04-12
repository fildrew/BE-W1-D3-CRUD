<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>4</title>
<link rel="stylesheet" href="../main.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="wallpaper">
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1 class="fw-bold">Book List</h1>
            <div>
                <a href="create.php" class="btn btn-primary shadow rounded-pill">Add New Book</a>
            </div>
        </header>
     
        <form class="d-flex" action="search.php" method="GET">
            <div class="input-group mb-3 shadow">
                <input type="search" name="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-primary shadow" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["create"];
            ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>
         <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["update"];
            ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["delete"];
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
        ?>
        <?php
        if (isset($_SESSION["search"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["search"];
            ?>
        </div>
        <?php
        unset($_SESSION["search"]);
        }
        ?>
        
        <table class="table table-bordered opacity-75 shadow p-3 mb-5 bg-body rounded table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
        include('./connect.php');
        $sqlSelect = "SELECT * FROM books";
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($books as $data) {
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['title']; ?></td>
                <td><?php echo $data['author']; ?></td>
                <td><?php echo $data['type']; ?></td>
                <td>
                    <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-info shadow rounded-pill">Read More</a>
                    <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning shadow rounded-pill">Edit</a>
                    <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger shadow rounded-pill">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>

        <?php
            include("connect.php");

            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                
                // Prepare the SQL statement with placeholders
                $sqlSelect = "SELECT * FROM books WHERE title LIKE ? OR description LIKE ? OR author LIKE ? OR type LIKE ?";
                
                // Prepare and execute the statement with wildcard search parameters
                $stmt = $pdo->prepare($sqlSelect);
                $stmt->execute(["%$search%", "%$search%", "%$search%", "%$search%"]);
                
                // Fetch the results
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if ($books) {
                    foreach ($books as $data) {
                        ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['title']; ?></td>
                            <td><?php echo $data['author']; ?></td>
                            <td><?php echo $data['type']; ?></td>
                        </tr>
                        
                    <?php
                    }
                } else {
                    echo "<h3>No books found</h3>";
                }
            }
        ?> 

        </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>

                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>

                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>