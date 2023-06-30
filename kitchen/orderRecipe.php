<!DOCTYPE html>
<html lang="en">
<?php
require_once('../dbConnection/connect.php');
?>

<head>


    </style>

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
                    <p class="text-primary m-0 fw-bold" id="addrecipe">Place order
                        <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;" id="add_recipe">Add Recipes</a> -->
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">

                    <!-- <div class="row justify-content-center"> -->
                    <!-- <div class="col-md-6"> -->

                    <?php
                    $recipeID = "";

                    if (isset($_POST['submit'])) {
                        echo "<script>console.log('" . $_POST['recipe_id'] . "')</script>";
                        try {
                            $recipeID = $_POST['recipe_id'];
                            $sql = "SELECT * from recipe  where recipe_id = $recipeID";
                            try {
                                $result = mysqli_query($conn, $sql);
                                if (!$result) {
                                    echo "<script>location.href='orders.php'</script>";
                                }
                            } catch (Exception $e) {
                                echo "<script>location.href='orders.php'</script>";
                            }
                            $recipe = mysqli_fetch_assoc($result);


                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount == 0) {
                                echo "<script>location.href='orders.php'</script>";
                            }


                            $RoomBookedCustomers = "SELECT * FROM `roomdetail`,customer WHERE `status` = 0 AND `roomdetail`.`customerid` = `customer`.`customerid`";
                            $RoomBookedCustomersResult = mysqli_query($conn, $RoomBookedCustomers);
                            $RoomBookedCustomersResultCount = mysqli_num_rows($RoomBookedCustomersResult);
                            // $RoomBookedCustomersResultArray = mysqli_fetch_assoc($RoomBookedCustomersResult);

                            $recipeName = $recipe['recipe_name'];
                            // echo $_GET['oredrID'];
                        } catch (Exception $e) {
                            echo "<script>location.href='orders.php'</script>";
                        }
                    } else {

                        echo "<script>location.href='orders.php'</script>";
                    }



                    ?>

                    <form id="orderForm" action="orderRecipe.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <h2><?php echo @$recipeName;  ?></h2>
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price" id="price" value="<?php echo @$recipe['recipe_price']; ?>" readonly>
                                    <br>
                                    <label for="quantity">Quantity</label>
                                    <input type="number" step="1" min="1" max="20" class="form-control" onchange="quantityChange()" name="quantity" id="quantity" placeholder="Quantity" required>
                                    <br>
                                    <label for="total">Total(RS)</label>
                                    <input type="text" class="form-control" name="total" id="total" value="<?php echo @$recipe['recipe_price']; ?>" readonly>
                                    <br>
                                    <input type="text" style="display: none;" class="form-control" id="recipeName" name="recipeNameId" value="<?php echo $recipeID; ?>" placeholder="<?php echo $recipeName;  ?>" readonly>
                                    <div id="nonCustomerDiv">
                                        <label for="noncustomer">Customer</label>
                                        <select name="roomNo" id="roomNo" onchange=noncustomers() placeholder="Select" class="form-control" required>
                                            <!-- <option value="nan">Select Room No</option> -->
                                            <!-- <option value="0">NanCustomer </option> -->

                                            <?php
                                            for ($i = 1; $i <= $RoomBookedCustomersResultCount; $i++) {
                                                $RoomBookedCustomersResultArray = mysqli_fetch_assoc($RoomBookedCustomersResult);
                                                $CustomerfName = $RoomBookedCustomersResultArray['cfname'];
                                                $CustomerlName = $RoomBookedCustomersResultArray['clname'];
                                                $roomNo = $RoomBookedCustomersResultArray['roomnumid'];
                                                echo "<option value='$roomNo|$CustomerfName'>Room No : $roomNo Name : $CustomerfName  $CustomerlName </option>";
                                            }
                                            ?>
                                        </select>

                                        <br>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="makeOrder" id="makeOrder">Make order</button>

                                </div>

                                <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </form>
                    <?php

                    $CustomerName = null;
                    if (isset($_POST['makeOrder'])) {
                        // $updateFoodAvalibility="UPDATE `food` SET `food_weight`=`recipe_quantity`-1 WHERE `recipe_id`=$recipeID";
                        $Recid = $_POST['recipeNameId'];
                        $recipeIngredients = "SELECT * FROM `recipe` WHERE `recipe_id`= $Recid";
                        $recipeIngredientsResult = mysqli_query($conn, $recipeIngredients);
                        while ($recUpdate = mysqli_fetch_assoc($recipeIngredientsResult)) {
                            $json = $recUpdate['recipe_ingredients'];
                            $json = json_decode($json, true);
                            foreach ($json as $key => $values) {
                                $foodID = $values['FoodId'];
                                $MessureValue = $values['MessureValue']*$_POST['quantity'];
                                $FoodWeight = "SELECT `food_weight` FROM `food` WHERE `food_id`=$foodID";
                                $FoodWeightResult = mysqli_query($conn, $FoodWeight);
                                $FoodWeightResultArray = mysqli_fetch_assoc($FoodWeightResult);
                                $currentWeight = $FoodWeightResultArray['food_weight'] - $MessureValue;
                                // $foodQuantity=$values['food_quantity'];

                                $updateFoodAvalibility = "UPDATE `food` SET `food_weight`=$currentWeight WHERE `food_id`=$foodID";
                                $updateFoodAvalibilityResult = mysqli_query($conn, $updateFoodAvalibility);
                                if (!($updateFoodAvalibilityResult)) {
                                    echo  "<script>Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<a href>Why do I have this issue?</a>'
                                  })</script>";
                                }
                            }
                        };
                        // $recipeIngredientsResultArrayCount = mysqli_num_rows($recipeIngredientsResult);


                        $roomNo = $_POST['roomNo'];
                        $roomNOArray = explode("|", $roomNo);
                        $roomNo = $roomNOArray[0];
                        $recipeID = $_POST['recipeNameId'];
                        $quantity = $_POST['quantity'];
                        $total = $_POST['total'];
                        if ($roomNo != 0) {
                            $CustomerName = $roomNOArray[1];
                        } else {
                            @$CustomerName = $_POST['noncustomer'];
                        }

                        $order = "INSERT INTO `placedorder`(`order_roomnumid`, `order_recipe_id`, `order_status`,`order_customerName`,`order_quantity`,`order_total`,`order_placedBy`) VALUES ($roomNo,$recipeID,0,'$CustomerName',$quantity,$total,'Admin')";
                        $bookedroomOrder = "UPDATE `bookedrooms` SET `total`=`total`+$total WHERE `roomid`=$roomNo";

                        $bookedroomOrderResult = mysqli_query($conn, $bookedroomOrder);

                        $result = mysqli_query($conn, $order);
                        if ($result && $bookedroomOrderResult) {
                            echo "<script>Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Order Added',
                                showConfirmButton: false,
                                timer: 1500
                              }
                              ).then(() => {
                                window.location.href = '';
                              });</script>";
                        } else {
                            echo "<script>Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Order Not Added',
                                showConfirmButton: false,
                                timer: 15000
                              }).then(() => {
                                window.location.href = 'orders.php';
                              });</script>";
                        }
                    }
                    ?>
                </div>
                <script>
                    function noncustomers() {
                        var roomNo = document.getElementById('roomNo').value;
                        if (roomNo == 0) {
                            var input = document.createElement("input");
                            input.type = "text";
                            input.name = "noncustomer";
                            input.id = "noncustomer";
                            input.placeholder = "Enter Customer Name";
                            input.className = "form-control";
                            input.required = true;
                            var div = document.getElementById("nonCustomerDiv");
                            div.appendChild(input);
                        } else {

                            var div = document.getElementById("noncustomer");
                            div.remove();
                        }
                    }

                    function quantityChange() {
                        var quantity = document.getElementById('quantity').value;
                        var price = document.getElementById('price').value;
                        var total = quantity * price;
                        document.getElementById('total').value = total;
                    }
                </script>
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