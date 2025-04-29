<?php

    // put all the update student logic

    // Connect to Database
    // 1. database info
    $host = "127.0.0.1";
    $database_name = "todolist_app"; // connecting to which database
    $database_user = "root";
    $database_password = "";

    // 2. connect PHP with the MySQL database
    // PDO (PHP Database Object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name", // host and db name 
        $database_user, // username
        $database_password // password
    );

    $list_id = $_POST["list_id"];
    $list_completed = $_POST["list_completed"];

    if ( $list_completed == 0 ) {
        $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
    } else {
        $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
    }
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $list_id
    ]);
    
    header("Location: e1-todolistapp.php");
    exit;