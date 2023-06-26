<?php


$value = $_POST['value'];
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="hotel";
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt = $conn->prepare("SELECT nic  FROM staff WHERE nic = :value"); 
   // $value = intval($value);
   $stmt->bindParam(':value', $value);
   $stmt->execute();

   if($stmt->rowCount() > 0){
      echo "already exists user.";
      // echo "<i class='fas fa-spinner fa-spin'></i>";
   }else{
    //   echo "Value does not exist in the database.";
   }



}
catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
}
$conn = null;
