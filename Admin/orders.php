<!DOCTYPE html>
<html lang="en">
<?php
require_once('../dbConnection/connect.php');
session_start();
  if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  
    header('Location: ../login.html');
  
  }
?>

<head>


    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Room - Admin</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');
   
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">


            <div class="card shadow">
                <div class="card-header py-3" id="addrecipe">
                    <p class="text-primary m-0 fw-bold" id="addrecipe">Make orders
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" href="ongoingOrders.php" role="button" style="float:right;" id="add_recipe">Ongoing Orders</a>
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">





                    <!-- <div class="row justify-content-center"> -->
                    <!-- <div class="col-md-6"> -->
                    <?php
                    $sql = "SELECT * from recipe";
                    $result = mysqli_query($conn, $sql);
                    $recipe = 0;
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo '
                     <form  method="POST" action="./orderRecipe.php" id="recipeForm' . $recipe . '">
                         
                            <div class="col-md-auto">
                          
                                <div class="form-control" type="text" data-bs-toggle="collapse" data-bs-target="#collapseRecipe' . $recipe . '" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
                                <label for="recipeName">' . $row['recipe_name'] . '</label>
                              </div>
                             <br>
                            </div>
                            <div class="collapse dropdown"  id="collapseRecipe' . $recipe++ . '">
                            <div class="card-body">
                            <table class=" table table-striped table-bordered" id="toogelTabel">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>Volume</th>
                                
                   

                                </tr>
                            </thead>
                            <tbody>
                           
                        ';
                        $json_con = $row['recipe_ingredients'];
                        $json =  json_decode($json_con, true);
                        $button = 0;
                        foreach ($json as $key => $values) {
                            $checkFoodAvalibility = "SELECT * FROM food WHERE food_id =" . $values['FoodId'] . "";
                            $resultCheckFoodAvalibility = mysqli_query($conn, $checkFoodAvalibility);
                            $rowCheckFoodAvalibility = mysqli_fetch_assoc($resultCheckFoodAvalibility);
                            if ($rowCheckFoodAvalibility['food_weight'] < $values['MessureValue']) {
                                $bgcolor = "#ff3c03d9";
                                $color = "black";
                                $button++;
                            } else {
                                $bgcolor = false;
                                $color = false;
                            }

                            echo  "  <tr >
                            
                      <td  colspan='1'>
                             " . $values["FoodName"] . "
                            </td>
                            <td style='background-color:" . $bgcolor . "; color:" . $color . ";'colspan='1'>
                            " . $values["MessureValue"] . "" . $values["Messure"] . "
                            </td>
                            
                            </tr>


                        
                            ";
                        }
                        if ($button > 0) {
                            $button = " ";
                            $cursor = "no-drop";
                            $recipe_id = 0;
                        } else {
                            $button = " ";
                            $cursor = "pointer";
                            $recipe_id = $row['recipe_id'];
                        }
                        echo
                        '<tr>
                        <td colspan="1">
                        Price</td>
                        <td colspan="1"><b>
                        Rs.'.$row['recipe_price'].'</b></td>
                    </tr>
                        <tr>
                        <td colspan="2">
                        Descripton</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <button   type="submit" ' . $button . 'class="col-md-2 btn btn-danger btn-sm" onclick="clickRecipeID(' . $recipe_id . ')" name="submit" style="float:right;cursor:' . $cursor . '" value="' . $recipe_id . '"  id="' . $recipe_id . '">
                        Order</button>
                        </td>
                    </tr>
                        </table>
                        </div>
                        </div> 
                        <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                        </form>';
                    }
                    ?>





                    <script>

                    </script>

                </div>

                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>

    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <s-cript src="../assets/js/bs-init.js"></script>
        <script src="../assets/js/theme.js"></script>
        <!-- <script src="../assets/js/javas.js"></script> -->
        <!-- <script src="../assets/js/ajax.js"></script> -->
        <!-- <script src="./js/rooms.js"></script> -->
        <!-- <script src="./js/foodCheck.js"></script> -->
        <script src="./js/orders.js"></script>

</body>

</html>