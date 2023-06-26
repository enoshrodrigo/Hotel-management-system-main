<?php
 

if(isset($_POST['food_name']))
{
    $food_name=$_POST['food_name'];
    $conn=mysqli_connect("localhost","root","","hotel");
    $query="select * from food where food_name='$food_name'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "success";
    }
    else
    {
        echo "<span class='text-success'>Food Name Available</span>";
    }
    mysqli_close($conn);
}
else
{
    header("location:../index.php");
}
?>