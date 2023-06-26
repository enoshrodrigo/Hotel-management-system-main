<?php

// if(isset($_POST['food_name']))
// {
//     $food_name=$_POST['food_name'];
//     $conn=mysqli_connect("localhost","root","","hotel");
//     $query="select * from food where food_name='$food_name'";
//     $result=mysqli_query($conn,$query);
//     if(mysqli_num_rows($result)>0)
//     {
//         echo "<span class='text-danger'>Food Name Already Exist</span>";
//     }
//     else
//     {
//         echo "<span class='text-success'>Food Name Available</span>";
//     }
//     mysqli_close($conn);
// }
// else
// {
//     header("location:../index.php");
// }
if(isset($_POST['recipe_name_check'])){
    $recipe_name_check = $_POST['recipe_name_check'];
    $conn=mysqli_connect("localhost","root","","hotel");
    $query="select * from recipe where recipe_name='$recipe_name_check'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "<span class='text-danger'>Recipe Name Already Exist</span> <script>
        
    $('#submit_food').attr('disabled',true);
    //hide submit button
    $('#submit_food').hide();

      //enabel non_submit_food button
        $('#non_submit_food').attr('disabled',false);
        //show non_submit_food button
        $('#non_submit_food').show();
    //crusoer disabel
    $('#non_submit_food').css('cursor','not-allowed');
      
        </script>";
    }
    else
    {
        echo "<span class='text-success'>Recipe Name Available</span> <script>
        
        $('#submit_food').attr('disabled',false);
        //show submit button
        $('#submit_food').show();
    
          //enabel non_submit_food button
            $('#non_submit_food').attr('disabled',true);
            //hide non_submit_food button
            $('#non_submit_food').hide();
        //crusoer disabel
        $('#non_submit_food').css('cursor','not-allowed');
        

        </script>
         ";
    }
    mysqli_close($conn);


}
else
{
    header("location:../index.php");
}
?>