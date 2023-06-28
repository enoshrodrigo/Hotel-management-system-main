<?php
 

$servername = "localhost";
$username = "root";
$password = "";
$dbname="hotel";
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$cvalue = $_POST['cvalue'];
try {
   $cconn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   // set the PDO error mode to exception
   $cconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $cstmt = $cconn->prepare("SELECT customerid  FROM customer WHERE customerid = :value"); 
   // $cvalue = intval($cvalue);
   $cstmt->bindParam(':value', $cvalue);
   if(!$cstmt->execute()){
      echo "Error:Duplicate entry
      " ;
   }else{

   if($cstmt->rowCount() > 0){

      echo "already exists user.";
    
   }else{
      echo "Value does not exist in the database.";
   }
   }
}
catch(PDOException $e)
{
   echo "Error: " . $e->getMessage();
}
$cconn = null;