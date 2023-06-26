<?php
require_once('../dbConnection/connect.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen')
    {
    
        header('Location: ../login.html');
    }
    if(isset($_POST['foodsubmit'])){
$food_name = $_POST['food_name'];
$food_quntity = $_POST['food_quntity'];
$food_unit_price = $_POST['food_unit_price'];
$food_weight = $_POST['food_weight'];
$food_messure = $_POST['food_messure'];

$count=0;
foreach($food_quntity as $value ){
    if($food_messure[$count] == "kg"){
        $food_messure[$count] = "g";
        $food_weight[$count] = $food_weight[$count] * 1000;
    }else if($food_messure[$count] == "l"){
        $food_messure[$count] = "ml";
        $food_weight[$count] = $food_weight[$count] * 1000;
    }
    $food_total = $value * $food_unit_price[$count];
    $sql = "INSERT INTO `food`(`food_name`, `food_quntity`, `food_weight`, `food_measurement`, `food_unit_price`, `food_total`) 
    VALUES ('$food_name[$count]','$value','$food_weight[$count]','$food_messure[$count]','$food_unit_price[$count]', '$food_total')";
    // $total = "UPDATE food SET total = food_quntity * food_unit_price";
    $result = mysqli_query($conn,$sql);
    // $result1 = mysqli_query($conn,$total);

    $count++;
}
if($result){
    echo "<script>window.location='kitchen.php'; </script>";
    }else{
        echo "not inserted";
    }
}
?>
</body>
</html>

