<!DOCTYPE html>
<html lang="en">
<?php
require_once('../dbConnection/connect.php');
session_start();

?>

<head>


    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Staff - Admin</title>
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
        if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen')
        {
        
            header('Location: ../login.html');
        }
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">


            <div class="card shadow">
                <div class="card-header py-3" id="addrecipe">
                    <p class="text-primary m-0 fw-bold" id="addrecipe">Recipes
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;" id="add_recipe">Add Recipes</a>
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body" id="card">
                    <!-- <div class="row justify-content-center"> -->
                    <!-- <div class="col-md-6"> -->
                    <form method="post" action="recipeStore.php">
                        <div class="row" id="wrap">
                            <div class="col-md-4">

                                <label for="recipeName">Recipe Name</label>
                                <input type="text" name="recipeName" class="form-control" id="recipe_name" required>
                                <div id="recipe_name_check"></div>
                            </div>
                            <?php
                            $sql = "SELECT * FROM food ";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            
                                <div class="col-md-2" id="messure">
                                    <label for="recipeName">Measure</label>
                                    <input type="number" name="Messure[]" class="form-control" id="Messure0" step="any" min="1" required>

                                </div>
                                <div class="col-md-1" id="size">
                                    <label for="size">Size</label>
                                    <input type="text" name="select_size[]" class="form-control" id="size0" value=<?php echo $row['food_measurement']; ?> readonly>

                                </div>
                                <div class="col-md-3" id="selectDiv">
                                    <label for="recipeName">Name</label>
                                    <select name="select_food[]" onchange="change(select_food0,size0)" class="form-control" id="select_food0" required>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo " <option value= " . $row['food_id'] . ">" . $row['food_name'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="m-2">
                                    <a role="button" class="btn btn-primary" name="add_food" id="add_option" style="float: right; margin-right: 24px;">Add food</a>
                                </div>
                                <div class="col-md-3">
                                
                                    <label for="price">Price RS</label>
                                    <input type="number" name="price" step="any" class="form-control" id="price" min="1" required>
                               <div id="price_check"> </div>
                            <div id="warningCost"></div>
                            </div>
                    <input type="hidden"   id="total_price" name="total_price" value="0">


                                <div class="m-2">
                                    <input class="btn btn-primary" name="submit" type="submit" id="submit_food">

                                </div>

                        </div>
                    <?php break;
                            } ?>
                    </form>
                    <input class="btn btn-primary" style="display: none;" type="submit" id="non_submit_food">
                    <!-- //making hiiden input field to get the total price -->


                    <script>
                        //if the recipeName is empty hide the recipe_name_check div
                        $(document).ready(function() {
                            $("#recipe_name").keyup(function() {
                                var recipe_name_check = $("#recipe_name").val();
                                if (recipe_name_check == "") {
                                    $("#recipe_name_check").hide();
                                }
                            });
                        });
                        //if the recipeName is not empty show the recipe_name_check div
                        $(document).ready(function() {
                            $("#recipe_name").keyup(function() {
                                var recipe_name_check = $("#recipe_name").val();
                                if (recipe_name_check != "") {
                                    $("#recipe_name_check").show();
                                }
                            });
                        });

                        $(document).ready(function() {
                            $("#recipe_name").keyup(function() {
                                var recipe_name_check = $("#recipe_name").val();
                                $.ajax({
                                    url: "./verifyKitchen/recipe_name_check.php",
                                    method: "POST",
                                    data: {
                                        recipe_name_check: recipe_name_check
                                    },
                                    success: function(data) {
                                        $("#recipe_name_check").html(data);
                                    }
                                });
                            });
                        });

                        //there is a function when i enter the messure then it check with selection food name and get the price for the entered messure then it display the price it calculate with every messuer price according to given price

                    document.getElementById("wrap").addEventListener("change", function() {
                        var selector = document.querySelectorAll("[name='Messure[]']");
                        var food = document.querySelectorAll("[name='select_food[]']");
                        var size = document.querySelectorAll("[name='select_size[]']");
                        var price = document.getElementById("price");
                        var total = 0;
                        var total_price = 0;
                        var total = 0;
                        //loop through them
                        selector.forEach(function(elem) {
                            //  document.getElementById(elem.id.replace("Food_name", "newid")).innerHTML = elem.value
                            var food_id = food[elem.id.replace("Messure", "")].value;
                            var food_size = size[elem.id.replace("Messure", "")].value;
                            var food_messure = elem.value;
                            var price = document.getElementById("price");
                            
                           
                          
                            // console.log(food_messure);
                            $.ajax({
                                url: "./verifyKitchen/food_price_check.php",
                                type: "POST",
                                data: {
                                    food_id: food_id,
                                    food_size: food_size,
                                    food_messure: food_messure
                                },
                                success: function(data) {
                                    // console.log("should be"+data);
                                    total  = total + parseFloat(data);
                                    document.getElementById("price_check").innerHTML = total;
                                    document.getElementById("total_price").value = total;
                                     
                                }
                            })
                        })
                    })

                    //get the enterd price then check the total given by data base and show the warning price should me more than total price
                    document.getElementById("card").addEventListener("mousemove", function() {
                        console.log("scrolling");
                       
                        var enterd_price = parseFloat(document.getElementById("price").value);
                         if(document.getElementById("price").value==null || document.getElementById("price").value==""){
                            document.getElementById("warningCost").innerHTML = "";
                        }else if(enterd_price<parseFloat(document.getElementById("total_price").value)){
                            
                            document.getElementById("warningCost").innerHTML = "Price should be more than total price";
                            //warning
                            document.getElementById("warningCost").style.color = "red";
   }
                        else{
                            document.getElementById("warningCost").innerHTML = "";
                             
                        }
                    })
                        


 
                    </script>

                </div>

                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>

    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
    <!-- <script src="../assets/js/javas.js"></script> -->
    <!-- <script src="../assets/js/ajax.js"></script> -->
    <!-- <script src="./js/rooms.js"></script> -->
    <script src="./js/foodCheck.js"></script>
</body>

</html>