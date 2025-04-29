<?php

    // put all the delete student logic

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

    // data from the delete form (id)
    $list_id = $_POST["list_id"];

    // 3. delete the student from the students table using the student_id
    // 3.1 - SQL command(recipe)
    $sql = "DELETE FROM todos WHERE id = :id";
    // 3.2 - prepare SQL query (prepare your material)
    $query = $database->prepare( $sql );
    // 3.3 - execute the SQL query (cook it)
    $query->execute([
        "id" => $list_id
    ]);

    // 4. redirect the user back to the index.php
    header("Location: e1-todolistapp.php");
    exit;