<?php
    $dsn = 'mysql:host=localhost;dbname=youtube_db';
    $username = 'root';
    try {
        $db = new PDO($dsn, $username);
    } catch (PDOException $e) {
        $error_message = "Database Error: ";
        $error_message .= $e->getMessage();
        include('../error.php');
        exit();
    }
?>