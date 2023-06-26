<?php
//get the price of the food and calculate the total cost for the food in given quantit
//get the price of the food and calculate the total cost for the food in given quantit
//food_messure is the volume of of the food(ingridient) in the food
//food_id is the id of the food
//size is the weight standard (gram or ml) of the food
 if(isset($_POST['food_id']))
 {
        $food_id=$_POST['food_id'];
        $size=$_POST['food_size'];
        $food_messure=floatval($_POST['food_messure']);
        $conn=mysqli_connect("localhost","root","","hotel");
        $query="select * from food where food_id='$food_id'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0)
        {
            $row=mysqli_fetch_assoc($result);
            // $price=$row['food_price'];
            $gramMLPrice=1000/$row['food_unit_price'];
            $total_cost=($gramMLPrice*$food_messure);
            echo $total_cost;
        }
        else
        {
            echo "error";
        }
        mysqli_close($conn);

 }
 else
 {
     header("location:../index.php");
 }

?>