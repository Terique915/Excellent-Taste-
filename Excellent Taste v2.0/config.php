<?php

$servername = "localhost";
$usernaam = "root";
$pass = "";
$dbname = "examen";

try {
    $conn = new PDO("mysql:host=$servername; port=3308; dbname=$dbname", $usernaam, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}