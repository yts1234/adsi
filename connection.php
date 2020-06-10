<?php
/*
Please be carefull when you want to modify below syntax.
If you want to change the servername, username, password, or database name
please modify the configuration.php
*/
require 'configuration.php';

//Below are syntax for DB connection using PDO
try {
    $conn = new PDO("mysql:host=$severname;dbname=$dbname",
    $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, 
    PDO::ERRMODE_EXCEPTION);
    //echo("Connected successfully");
} catch (PDOException $e) {
    echo("Connection failed: ".$e->getMessage());
}

?>