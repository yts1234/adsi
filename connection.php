<?php
//This config file is used for database connection to mysql

//Edit this code only!
$severname = "localhost";//Your local or remote database url or FQDN
$username = "root";//Username
$password = "";//Password
$dbname = "test";//Database name
//End of configuration file

//Be careful to modify below this!
try {
    $conn = new PDO("mysql:host=$severname;dbname=$dbname",
    $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, 
    PDO::ERRMODE_EXCEPTION);
    echo("Connected successfully");
} catch (PDOException $e) {
    echo("Connection failed: ".$e->getMessage());
}

?>