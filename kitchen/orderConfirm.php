

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
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen')
{

    header('Location: ../login.html');
}
// Path: kitchen\orderConfirm.php

if(isset($_GET['order_id'])){

require_once('../dbConnection/connect.php');
$order_id = $_GET['order_id'];
$sql = "UPDATE `placedorder` SET `order_status` = '1' WHERE `placedorder`.`order_id` = $order_id";
$result = mysqli_query($conn, $sql);
  
if($result){
 
    echo "<script>
        swal.fire({
            title: 'Order Confirmed',
            text: 'Order Confirmed Successfully',
            icon: 'success',
            button: 'Ok',
        }).then(function() {
            window.location.href='ongoingOrders.php';
        });   
    </script>";
}
else{
    echo "<script>
        swal.fire({
            title: 'Error',
            text: 'Something went wrong',
            icon: 'error',
            button: 'Ok',
        }).then(function() {
            window.location.href='ongoingOrders.php';
        });
        </script>";

}
}
else{
    echo "<script>
        swal.fire({
            title: 'Error',
            text: 'Something went wrong',
            icon: 'error',
            button: 'Ok',
        }).then(function() {
            window.location.href='ongoingOrders.php';
        });
        </script>";

}
 
?> 
</body>
</html>