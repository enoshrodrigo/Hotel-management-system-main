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
                    <p class="text-primary m-0 fw-bold" id="addrecipe">Make orders
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" href="ongoingOrders.php" role="button" style="float:right;" id="add_recipe">Ongoing Orders</a>
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">


                    <?php
                    $sql = "SELECT * FROM placedorder,recipe WHERE order_status = 0 AND placedorder.order_recipe_id = recipe.recipe_id ORDER BY order_id DESC";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck == 0) {
                        echo '
                      <div class="card-body text-center shadow">
                      <div class="alert alert-danger" role="alert">
                        No Orders Found
                      </div>
                      <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="../assets/img/food/Notcooking.gif" alt="cooking" style="width:21rem; />
                      </div>';
                    }
                    echo '<div class="row">';
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($i == 3) {
                            $i = 0;
                        }
                        echo '
                    
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center shadow">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="../assets/img/food/cooking' . $i++ . '.gif" alt="...">
                                    <h4 class="text-dark mb-0">' . $row['recipe_name'] . '</h4>
                                    <p  class="text-dark mb-0">
                                    
                                    Ordered By :<div class="text-dark mb-0" id="55"> ' . $row['order_customerName'] . '</div>
                                    
                                    </p>
                                  
                                    <p class="text-dark mb-0">Price : Rs.' . $row['order_total'] . '</p>

                                    <p class="text-dark mb-0">Quantity  :' . $row['order_quantity'] . '</p>
                                    <p class="text-dark mb-0">Status    :' . $row['order_status'] . '</p>

                                    <p class="text-dark mb-0">Ordered Room : ' . $row['order_roomnumid'] . '</p>

                                    <p class="text-dark mb-0">Ordered ID : ' . $row['order_id'] . '</p>
                                    
                                    <p class="text-dark mb-0">Order Placed By :<b> ' . $row['order_placedBy'] . '</b></p>
                               
                                    <p class="text-dark mb-0">Ordered Time : ' . $row['order_time'] . '</p>

                                    <br>
                                    <button class="btn btn-danger btn-sm" onclick="deleteFoodOrder()">Delete</button>
                                    <a class="btn btn-primary btn-sm" href="orderConfirm.php?order_id=' . $row['order_id'] . '" role="button">Confirm order</a>

                                </div>
                            </div>
                        </div>

               
                    ';
                    }
                    echo '</div>';
                    ?>


                </div>

                <script>
                    
                </script>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>


    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <s-cript src="../assets/js/bs-init.js"></script>
        <script src="https://kit.fontawesome.com/c480a67077.js" crossorigin="anonymous"></script>

        <script src="../assets/js/theme.js"></script>
        <!-- <script src="../assets/js/javas.js"></script> -->
        <!-- <script src="../assets/js/ajax.js"></script> -->
        <!-- <script src="./js/rooms.js"></script> -->
        <!-- <script src="./js/foodCheck.js"></script> -->
        <script src="./js/orders.js"></script>

</body>

</html>