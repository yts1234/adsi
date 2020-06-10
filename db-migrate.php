<?php
//This script is used for automate creating database scheme for storing the transaction data
require 'configuration.php';
//Create DB
try{
    $conn = new PDO("mysql:host=$severname",
    $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, 
    PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($sql);
    echo"DB ".$dbname." is created successfully\n";
}catch(PDOException $e){
    echo $sql."<br>". $e->getMessage();
}

//Create Table structure
try {
    $conn = new PDO("mysql:host=$severname;dbname=$dbname",
    $username, $password);
    $sql = "CREATE TABLE transaction (
        rec INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ID INT NOT NULL,
        amount FLOAT NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        bank_code VARCHAR(5) NOT NULL,
        account_number INT NOT NULL,
        beneficiary_name VARCHAR(25) NOT NULL,
        remark TEXT DEFAULT NULL,
        receipt TEXT DEFAULT NULL,
        time_served TIMESTAMP NULL DEFAULT NULL,
        fee FLOAT NOT NULL
        )";
    $conn->exec($sql);
    echo "Table transaction is created successfully\n";
} catch (PDOException $e) {
    echo $sql."\n".$e->getMessage();
}
$conn = null;//close the connection
?>