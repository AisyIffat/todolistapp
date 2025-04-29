<?php

    //  put the backend code for processing data

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

    // data from the input in index.php
    $list_label = $_POST["list_label"];

    // check if the student_name is empty or not
    if ( empty($list_label) ) {
        echo "Please fill up the student name";
    } else {
        // 3. add the student name to students table
        // 3.1 SQL command (recipe)
        $sql = "INSERT INTO todos (`label`) VALUES (:label)";
        // 3.2 prepare your SQL query (prepare your material)
        $query = $database->prepare( $sql );
        // 3.3 execute the SQL query (cook it)
        $query->execute([
            "label" => $list_label
        ]);

        // 4. redirect the user back to the index.php
        header("Location: e1-todolistapp.php");
        exit;
    }