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
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Staff - Admin</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <!-- <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <script src="https://kit.fontawesome.com/c480a67077.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php

        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');
        ?>
        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Admin Dashboard</h3> </div>
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">

                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span class="h6">Earnings (Weekly)</span></div>

                                    <div class="text-dark fw-bold h5 mb-0"><span>Rs.         <?php 
//get the total earnings of the this week from the database history tabel total of historypayement  and display it 
                                    $sql = "SELECT SUM(historyPayement) AS total FROM history WHERE historyrigisterdate BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    echo $sum;
                                    ?></span> </div>
                                </div>
                       
                                <div class="col-auto"><i class="fas fa-dollar-sign fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1"><span class="h6">Earnings (Year)</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>Rs. <?php 
                                    //get the total earnings of the this year from the database history tabel total of historypayement  and display it
                                    $sql = "SELECT SUM(historyPayement) AS total FROM history WHERE historyrigisterdate BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW()";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    echo $sum;
                                    ?></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar-week fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-3 mb-4">
                    <a href="../kitchen/ongoingOrders.php" class="text-decoration-none">
                    <div class="card shadow border-start-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span class="h6">Pending Food orders</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php
                                    //get the pending food orders from the database placedorder tabel total of foodorders  and display it
                                    $sql = "SELECT COUNT(*) AS total FROM placedorder WHERE order_status=0";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    echo $sum; 
                                    ?></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-hamburger fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                
                <div class="col-md-6 col-xl-3 mb-4">
                    <a href="bookedrooms.php" class="text-decoration-none">

                    <div class="card shadow border-start-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1"><span class="h6">Current bookings</span></div>
                                    <div class="row g-0 align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h5 mb-0 me-3"><span><?php
                                        //get the current bookings from bookedrooms table and display the count
                                        $sql = "SELECT COUNT(*) AS total FROM bookedrooms";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $sum = $row['total'];
                                        echo $sum;
                                        ?></span></div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                                //get the current bookings from bookedrooms table and display the count in progress bar as a percentage of total rooms
                                                $sql = "SELECT COUNT(*) AS total FROM bookedrooms";
                                                $totalRooms = "SELECT COUNT(*) AS totalRooms FROM roomdetail";
                                                $result = mysqli_query($conn, $sql);
                                                $result2 = mysqli_query($conn, $totalRooms);
                                                $row = mysqli_fetch_assoc($result);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $sum = $row['total'];
                                                $sum2 = $row2['totalRooms'];
                                                $percentage = ($sum/$sum2)*100;
                                                echo $percentage."%"; 
                                                 ?>;"><span class="visually-hidden"> </span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-bed fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
          
            </div>
            <div class="row">
                <div class="col-lg-7 col-xl-8">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Earnings Overview(<?php if(isset($_GET['year'])){ echo $_GET['year'];}else{echo date('Y');}  ?>)</h6>
                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                  <?php echo'  <p class="text-center dropdown-header">Years:</p>';
                                  //if i select year it will display the earnings of year in a line chart
                                    $sql = "SELECT DISTINCT YEAR(historyrigisterdate) AS year FROM history";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<a class="dropdown-item" href="index.php?year='.$row['year'].'">&nbsp;'.$row['year'].'</a>';
                                    }

                                  ?>

                                    <!-- <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp; </a> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                           <?php 
                            //if i select year it will display the earnings of year in a line chart
                            if(isset($_GET['year'])){
                                $year = $_GET['year'];
                            }else
                            {
                            $year = 'YEAR(NOW())';
                            }
                            //get the total earnings of every month (only jan1-jan31,feb1-feb28,29 mar1-31 days in month) from the database history tabel total of historypayement  and display it in a line chart
                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 1 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofJAN = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 2 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofFEB = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 3 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofMAR = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 4 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofAPR = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 5 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofMAY = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 6 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofJUN = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 7 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofJUL = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 8 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofAUG = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 9 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumofSEP = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 10 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumoOCT = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 11 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumoNOV = $row['total'];

                            $sql ="SELECT SUM(historyPayement) AS total
                            FROM history
                            WHERE MONTH(historyrigisterdate) = 12 AND YEAR(historyrigisterdate) =  $year";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $sumoDEC = $row['total'];
                           
                           echo '<div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;,&quot;Sep&quot;,&quot;Oct&quot;,&quot;Nov&quot;,&quot;Dec&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;'.$sumofJAN.'&quot;,&quot;'.$sumofFEB.'&quot;,&quot;'.$sumofMAR.'&quot;,&quot;'.$sumofAPR.'&quot;,&quot;'.$sumofMAY.'&quot;,&quot;'.$sumofJUN.'&quot;,&quot;'.$sumofJUL.'&quot;,&quot;'.$sumofAUG.'&quot;,&quot;'.$sumofSEP.'&quot;,&quot;'.$sumoOCT.'&quot;,&quot;'.$sumoNOV.'&quot;,&quot;'.$sumoDEC.'&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>';
                           ?>
                        </div>
                         
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Top 3 sale foods(<?php if(isset($_GET['year'])){ echo $_GET['year'];}else{echo date('Y');}  ?>)</h6>
                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="chart-area-round">
                            <?php 
                            //get the top 3 foods from the database placedorder tabel total of foodorders  and display the total and food name from recipe tabel it in a doughnut chart
                            if(isset($_GET['year'])){
                                $year = $_GET['year'];
                            }else
                            {
                            $year = 'YEAR(NOW())';
                            }
                          
                            $sql ="SELECT SUM(order_quantity) as total ,recipe_name as name FROM placedorder,recipe WHERE recipe.recipe_id=placedorder.order_recipe_id 
                            AND YEAR(order_time) =  $year GROUP BY recipe_name ORDER BY COUNT(order_recipe_id) DESC LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                           
                            //row count
                            if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                                @$sumof1 = $row['total'];
                                @$name1 = $row['name'];
                                
                            @$row = mysqli_fetch_assoc($result);
                            @$sumof2 = $row['total'];
                            @$name2 = $row['name'];

                            @$row = mysqli_fetch_assoc($result);
                            @$sumof3 = $row['total'];
                            @$name3 = $row['name'];
                            }else{
                                @$sumof1 = 0;
                                @$name1 = "No orders";
                                @$sumof2 = 0;
                                @$name2 = "No orders";
                                @$sumof3 = 0;
                                @$name3 = "No orders";
                                echo "<script> 
                                document.getElementById('chart-area-round').innerHTML = '<h2>no data for  $year</h2>';
                                </script>";
                                                         
                            }

                         
                             


                            

                          echo'  <div class="chart-area" ><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;
                            :{&quot;labels&quot;:[&quot;'.$name1.'&quot;,&quot;'.$name2.'&quot;,&quot;'.$name3.'&quot;],&quot;datasets&quot;
                                :[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;
                                    ,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;
                                    ,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;'.$sumof1.'&quot;,&quot;'.$sumof2.'&quot;,&quot;'.$sumof3.'&quot;]}]}
                                    ,&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;
                                    :{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;
                                    :{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas></div>
                            <div class="text-center small mt-4"><span class="me-2"><i class="fas fa-circle text-primary"></i>&nbsp;'.$name1.'</span>
                            <span class="me-2"><i class="fas fa-circle text-success"></i>&nbsp;'.$name2.'</span><span class="me-2">
                            <i class="fas fa-circle text-info"></i>&nbsp;'.$name3.'</span></div>
                        </div>';
                        ?>
                    </div>
                </div>
            </div>
             
        </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Admin Rico shadow 2023</span></div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>

</html>