<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pay</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
</head>
<body>
  

<?php
 
require_once('../dbConnection/connect.php');
session_start();
  if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  
    header('Location: ../login.html');
  
  }
 
if(isset($_GET['roomid'])){
$roomid = $_GET['roomid'];
// $customerid = $_GET['customerid'];
$checkOngoingorders="SELECT * FROM placedorder WHERE order_roomnumid=$roomid AND order_status=0";
$ongoingorders = mysqli_query($conn, $checkOngoingorders);
 
if(mysqli_num_rows($ongoingorders) > 0){
  echo "<script>alert('You have ongoing orders in this room. Please complete them first.')</script>";
  echo "<script>window.location.href='bookedrooms.php'</script>";
  exit();
}else{
$roomstatus = 1;
$sqlcustomerhistory = "SELECT * FROM `roomdetail` WHERE `roomnumid` = $roomid";
$result = mysqli_query($conn, $sqlcustomerhistory);
$row = mysqli_fetch_assoc($result);
$customerid = $row['customerid'];
$roomnumid = $row['roomnumid'];
$register_date = $row['register_date'];
// $givedate = $row['givedate'];
// $givedate = date('Y-m-d', strtotime($row['givedate'] . ' + 1 days'));

$price = $row['price'];
$bookedroomTotal="SELECT * FROM bookedrooms WHERE roomid=$roomnumid";
$bookedroomTotal = mysqli_query($conn, $bookedroomTotal);
$bookedroomTotal = mysqli_fetch_assoc($bookedroomTotal);

$bookedroomTotal = $bookedroomTotal['total'];

$sqlinsert = "INSERT INTO `history` (`historycustomerid`, `historyroomid`, `historyrigisterdate`,`historypayement`) VALUES ('$customerid', '$roomnumid', '$register_date','$bookedroomTotal')";
mysqli_query($conn, $sqlinsert);

$sql = "UPDATE `roomdetail` SET `status` = ? WHERE `roomdetail`.`roomnumid` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $roomstatus, $roomid);
$sqlhistory = "INSERT INTO `history` (`roomid`, `roomstatus`) VALUES (?, ?)";
if (mysqli_stmt_execute($stmt) && mysqli_query($conn, "DELETE FROM `bookedrooms` WHERE `bookedrooms`.`roomid` = $roomid") ) {
  
  echo "<script>
  swal.fire({
    title: 'Room Payed',
    text: 'Room Payed Successfully',
    icon: 'success',
    confirmButtonText: 'OK'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href='bookedrooms.php';
    } else {
      window.location.href='bookedrooms.php';
    }
  });
  </script>";
  

} else {
  echo "Error updating record: " . mysqli_error($conn);

}
}
}

?>
</body>
</html>