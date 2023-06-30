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


    <!-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>   -->

    <!-- <link rel="stylesheet" href="sb-admin.css"> -->
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
                <div class="card-header py-3" id="addcustomer">
                    <p class="text-primary m-0 fw-bold" id="addcustomer">Food Manage(ingriednts)
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;margin-left: 14px;" id="add_food">Add Foods</a>
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" href="./edit-kitchen.php" style="float:right;" id="edit_food">Edit ingriednts</a>


                    <h1 id="demo"></h1>
                    </p>  
                </div>
                <div class="card-body">
                    <!-- <div class="row justify-content-center"> -->
                    <!-- <div class="col-md-6"> -->

                    <div id="formContainer">
                        <form method="POST" class="form-control" id="add_food_form" action="kitchen-food-process.php">
                            <div id="wrap_form">
                                <div class="row">
                                <!-- <h5 class="text-decoration-underline" style="color: red;">Add food detail</h5> -->


                                    <div class="col-md-6">
                                        <label for="food_name">Food name:(ingriednt name)</label>
                                        <input type="text" name="food_name[]"  id="Foodname1";autocomplete="off" autocomplete="off" class="form-control" required>
                                        <span id="food_name_status"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="food_quntity">Quantity:</label>
                                        <input type="number" step="1" name="food_quntity[]" min="1" autocomplete="off" class="form-control" required>
                                    </div>
                                     
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="food_unit_price">Unit price:</label>
                                        <input type="number" step="any" name="food_unit_price[]" autocomplete="off" min="1" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="food_weight">Total Weight: (quantity*1pack weight)</label>
                                        <input type="number" step="any" name="food_weight[]"min="1" autocomplete="off" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="food_messure"></label> 
                                        <select name="food_messure[]" id="food_messure"class="form-control" required>
                                            <option value="kg">Kg (Kilo gram)</option>
                                            <option value="g">G (Gram)</option>
                                            <option value="l">L (Liter)</option>
                                            <option value="ml">Ml (Mili leter)</option>
                                            <script>
                                           


                                            </script>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                   
                                    <input type="reset" name="Reset" class="btn btn-primary">
                                    <input type="submit" name="foodsubmit" class="btn btn-primary" id="foodsubmit">
                                </div>
                            </div>
                        </form>
                        <script>
                               var idAuto=2;
                            document.getElementById("add_food").addEventListener("click", function() {
                             
                                var div = document.createElement("div");
                                div.setAttribute("class","row");

                                var div2 = document.createElement("div");
                                div2.setAttribute("class","row");
                                div.innerHTML = ` 
                               
                                <div class="divider m-4"></div>
                             
                                <div class="col-md-6">
                                    <label for="food_name">Food name:(ingrident name)</label>
                                    <input type="text" name="food_name[]" id="Foodname${idAuto}" autocomplete="off" class="form-control">
                                    
                                </div>
                                <div class="col-md-6">
                                    <label for="food_quntity">Quantity:</label>
                                    <input type="number" step="1" name="food_quntity[]" id="Quantity" autocomplete="off" class="form-control">
                                </div>`;
                               
                                div2.innerHTML =` <div class="col-md-6">
                                    <label for="food_unit_price">Unit price:</label>
                                    <input type="number" step="any" name="food_unit_price[]" autocomplete="off" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="food_weight">Weight:</label>
                                    <input type="number" step="any" name="food_weight[]"  autocomplete="off" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="food_messure"></label>
                                    <select name="food_messure[]" id="food_messure" class="form-control">
                                        <option value="kg">Kg (Kilo gram)</option>
                                        <option value="g">G (Gram)</option>
                                        <option value="l">L (Liter)</option>
                                        <option value="ml">Ml (Mili leter)</option>
                                    </select>
                                </div>`;
                                    idAuto++;
                                document.getElementById("wrap_form").appendChild(div);
                                document.getElementById("wrap_form").appendChild(div2);

                            });
 
                            document.getElementById("wrap_form").addEventListener("change", function() {
            var selector = document.querySelectorAll("[name='food_name[]']");
            var food
            
                     //loop through them
             selector.forEach(function(elem) {
      
                //  document.getElementById(elem.id.replace("Food_name", "newid")).innerHTML = elem.value
                
                $.ajax({
                    url: "./verifyKitchen/food_name_check.php",
                    type: "POST",
                    data: {
                        food_name: elem.value,
                        food_id: elem.id
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data != "success") {

                            document.getElementById(elem.id).style.border = "2px solid green";
                            //
                           
                            
                            
                        } else {
                            document.getElementById(elem.id).style.border = "2px solid red";
                            //make warning
                            
                             
                             
                             
                        }
                    }


                })
             
             
                
                 
  })
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
    <script src="./js/rooms.js"></script>
</body>

</html>