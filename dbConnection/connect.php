<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName="hotel";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbName);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//pdo connection


// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname="eradmin";
// $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


// echo "Connected successfully";
?>