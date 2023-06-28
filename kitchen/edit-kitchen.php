<!DOCTYPE html>
<html lang="en">
<?php

session_start();

require_once('../dbConnection/connect.php');

?>

<head>

<style>
 
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add rooms - Admin</title>
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
            <div class="row" id="row">
                <h3 class="text-dark mb-4">Edit ingridents</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3" id="addcustomer"> 
                    <p class="text-primary m-0 fw-bold" id="addcustomer">Edit ingridents details
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" href="./edit-kitchen.php"  style="float:right;" id="addcustomer">Back</a>
                        <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                             
                        </div>
                    </div>


                    <div class="table-responsive">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
                            </div>

                        </div>

                        <table class="table table-striped table-bordered table-auto">
                            <thead>
                                <tr>
                                    <th>Ingriedent name</th>
                                    <th>Quntity</th>
                                    <th>Weight</th>
                                    <th>food_unit_price</th>
                                    <th>register_date</th>
                                    <th>food_total</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $records_per_page = 30;
                                $page = 0;
                                if (isset($_GET['page'])) {
                                    $page = intval($_GET['page']) - 1;
                                }
                                $start = $page * $records_per_page;
                                $sql = "SELECT * FROM food ORDER BY food_resgister_date asc LIMIT $start, $records_per_page";
                                $result = mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_assoc($result)){
                                    echo"
                                    <tr>
                                    <td>$row[food_name]</td>
                                    <td>$row[food_quntity]</td>
                                    <td>$row[food_weight] $row[food_measurement]</td>
                                    <td>Rs.$row[food_unit_price]</td>
                                    <td>$row[food_resgister_date]</td>
                                    <td>$row[food_total]</td>
                                    <td><a href='update-ing.php?update=$row[food_id]'  class='btn btn-danger'>Edit</a ></td>
                                    <td><a href='edit-kitchen.php?del=$row[food_id]'  class='btn btn-danger'>Delete</a ></td>
                                    

                                    </tr>
                                    ";
                                }
                                
                            if(isset($_GET['del'])){
                               $sqldel="DELETE FROM FOOD WHERE food_id='".$_GET['del']."';";
                               $delresult=mysqli_query($conn,$sqldel);
                               if($delresult){
                                echo"<script>alert('Deleted');window.location.href='edit-kitchen.php'</script>";
                               }else{
                                echo"<script>alert('not Deleted')</script>";

                               }


                            }
                            ?>

                                <script>
                                    $(document).ready(function() {
                                        // Search functionality
                                        $('#searchInput').on('input', function() {
                                            var input = $('#searchInput').val().toLowerCase();
                                            $('table tbody tr ').filter(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1)
                                            });
                                        });
                                        // Sort functionality
                                      
                                    });
                                </script>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                            $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM roomdetail"));
                            $total_pages = ceil($total_records / $records_per_page);
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item ' . ($page == $i - 1 ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>





    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Rico shadow 2023</span></div>
        </div>
    </footer>
    <div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
    <!-- <script src="../assets/js/ajax.js"></script> -->
    <script src="./js/ajaxEdit-rooms.js"></script>

    <script src="./verify/javas.js"></script>      


    <!-- ---------------------- -->


</body>

</html>