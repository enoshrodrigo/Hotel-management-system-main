<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Kitchen - Admin</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
  

<?php
require_once('../dbConnection/connect.php');
session_start();
  if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  
    header('Location: ../login.html');
  
  }
 
if (isset($_POST['submit'])) {
  // $roomname = $_POST['roomname'];
 
  $roomtype = $_POST['roomtype'];
  $roomnumber = $_POST['roomnumber'];
  $roomdcustomer = $_POST['roomcustomer'];
  $givedate = $_POST['checkin'];
  $todayDateAndTime = date("Y-m-d H:i:s");
  $roomstatus = 0;

  $sql = "UPDATE `roomdetail` SET `givedate` = ?, `customerid` = ?, `status` = ?,`register_date`='$todayDateAndTime' WHERE `roomdetail`.`roomnumid` = ?";
  // var_dump($bookedrooms);
  // var_dump($result);
 
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssii", $givedate, $roomdcustomer, $roomstatus, $roomnumber);
  if (mysqli_stmt_execute($stmt)) {
    //executing roomdetail updated data
    $roomdetailsSql = "SELECT * FROM `roomdetail` WHERE `roomnumid` = " . $_POST['roomnumber'] . "";
    $results = mysqli_query($conn, $roomdetailsSql);

    $rows = mysqli_fetch_assoc($results);
    $price = $rows['price'];

    $date1 = new DateTime($rows['register_date']);
    $date2 = new DateTime($rows['givedate']);
    // var_dump($date1);
    // var_dump($date2);

    $diff = $date1->diff($date2);
    $days = $diff->days;
    $price = $rows['price'] * $days;
    // echo($price);
    // echo($rows['price']);
    // echo($days);
    // echo($price);
    //if date is less than 0 then price is $rows['price']
    if ($price < $rows['price']) {
      $price = $rows['price'];
    } 

    if($results){
    //inserting booked room data 
    $bookedrooms = "INSERT INTO bookedrooms (roomid, total) VALUES ($roomnumber, $price)";
    $result = mysqli_query($conn, $bookedrooms);
    if ($result) {
      echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Room Booked Successfully',
        showConfirmButton: false,
        timer: 1500
      }).then(function() {
        window.location.href='rooms.php';
      });
      </script>";
       
    } else {
      echo "<script>alert('Error updating record: " . mysqli_error($conn) . "')</script>";
    }
   
    }
    
  } else {
    echo "<Script>alert('Error updating record: " . mysqli_error($conn) . "')</script>";
  }
}
?>
</body>
</html>