
 
<?php
 

$servername = "localhost";
$username = "root";
$password = "";
$dbname="hotel";
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$roomnumid = $_POST['Aroomnumber'];
$ac = $_POST['Aac'];
$tv = $_POST['Atv'];
$fridge = $_POST['Afridge'];
$wifi = $_POST['Awifi'];
$price = $_POST['Aprice'];
$kitchen = $_POST['Akitchen'];
try {
   $cconn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
   // set the PDO error mode to exception
   $cconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $cstmt = $cconn->prepare("UPDATE roomdetail SET ac = :ac, tv = :tv, fridge = :fridge, wifi = :wifi, price = :price, kitchen = :kitchen WHERE roomnumid = :roomnumid"); 
   // $cvalue = intval($cvalue);
    $cstmt->bindParam(':roomnumid', $roomnumid);
    $cstmt->bindParam(':ac', $ac);
    $cstmt->bindParam(':tv', $tv);
    $cstmt->bindParam(':fridge', $fridge);
    $cstmt->bindParam(':wifi', $wifi);
    $cstmt->bindParam(':price', $price);
    $cstmt->bindParam(':kitchen', $kitchen);

   $result=$cstmt->execute();

   if($result){
      echo "updated";
    
   }else{
    //   echo "Value does not exist in the database.";
   }

}
catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
}
$cconn = null;