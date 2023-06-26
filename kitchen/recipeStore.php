<?php
  require_once('..\..\dbConnection\connect.php');

if(isset($_POST['submit'])){

    $recipeName = $_POST['recipeName'];//Name
    $Messure = $_POST['Messure'];//pramanaya
    $select_size = $_POST['select_size'];//g,mg,ml
    $select_food = $_POST['select_food'];//food id ,food name
    $price = $_POST['price'];//price
    $realCost = $_POST['total_price'];//real cost
    // $ff = $_POST['select_food'];
    // echo$ff;
    $recipeArray = array();
    $foodName;
    $cc=0;
    foreach( $Messure as $c){
        $sql ="SELECT food_name FROM food WHERE food_id =$select_food[$cc]";
        $result = mysqli_query($conn, $sql);
       $Fname = mysqli_fetch_assoc($result);
       $foodName = $Fname['food_name'];

      $recipeArray[] = array("FoodId"=>$select_food[$cc],"FoodName"=>$foodName,"MessureValue"=> $c,"Messure"=>$select_size[$cc] );
     $cc++;
    }
    $addRecipe = "INSERT INTO `recipe` (`recipe_name`,`recipe_ingredients`,`recipe_price`,`realCost`) VALUES('$recipeName','".json_encode($recipeArray)."','$price','$realCost')";
    $addRecipeResult = mysqli_query($conn, $addRecipe);
    if($addRecipeResult){
        echo "<script>window.location='recipe.php'; </script>";
    }
    else{
        echo"Some thing wrong";
    }
//    echo json_encode($recipeArray); 
//    echo count($recipeArray); 


}
else{
     
}
?>
