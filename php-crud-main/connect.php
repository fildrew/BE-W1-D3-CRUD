<?php
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'crud';


    $dsn = "mysql:host=$dbHost;dbname=$dbName";
    
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    try {
        $pdo = new PDO($dsn,$dbUser, $dbPass,$options);

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>
