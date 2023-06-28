<!DOCTYPE html>
<html lang="en">
<?php

 

require_once('../dbConnection/connect.php');
session_start();
  if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  
    header('Location: ../login.html');
  
  }
 

// Check access level for this page
 

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
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');

 
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">
            <div class="row" id="row">
                <h3 class="text-dark mb-4">Rooms</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3" id="addcustomer"> 
                    <p class="text-primary m-0 fw-bold" id="addcustomer">Edit room details
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" href="./rooms.php"  style="float:right;" id="addcustomer">Back</a>
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
                                    <th >Room number</th>
                                    
                                    <th >Type</th>
                                    <th >Capacity</th>
                                    <th >Room floor</th>
                                    <th >Room status</th>
                                    <th >Room price</th>
                                    <th >Ac</th>
                                    <th >Tv</th>
                                    <th >Wifi</th>
                                    <th >Kitchen</th>
                                    <th >fridge</th>
                                    <!-- <th >Room description</th> -->
                                    <th >Check in(Last data)</th>
                                    <th >Check out(Last data)</th>
                                    <th >Booked by(Last booking)</th>
                                    <th >Save</th>


                                    <!-- <th>Email</th>
                                <th>DOB</th>
                                <th>Description</th> -->

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
                                $sql = "SELECT * FROM roomdetail ,room WHERE   roomdetail.roomtype=room.roomid  order by roomdetail.roomnumid asc LIMIT $start, $records_per_page";
                                $result = mysqli_query($conn, $sql); 
                                  $fieldLength=0;
                                  $rowcount=0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $roomnumid=$row['roomnumid']!==null?$row['roomnumid']:'--';
                                    $roomname=$row['roomname']!==null?$row['roomname']:'--';//room type =>single | double | family 
                                    $capacity=$row['capacity']!==null?$row['capacity']:'--';
                                    $roomfloor=$row['roomfloor']!==null?$row['roomfloor']:'--';
                                    $status=$row['status']=='0'? 'Booked':'Available';
                                    $price=$row['price']!==null?$row['price']:'--';
                                    $ac=$row['ac']!==null?$row['ac']:'--';
                                    $tv=$row['tv']!==null?$row['tv']:'--';
                                    $wifi=$row['wifi']!==null?$row['wifi']:'--';
                                    $kitchen=$row['kitchen']!==null?$row['kitchen']:'--';
                                    $fridge=$row['fridge']!==null?$row['fridge']:'--';
                                    $register_date=$row['register_date']!==null?$row['register_date']:'--';
                                    $givedate=$row['givedate']!==null?$row['givedate']:'--';
                                    $customerid=$row['customerid']!==null?$row['customerid']:'--';
                                    //get the cfname and clname from customer table using $customerid
                                    if($customerid!=='--'){
                                    $sql2 = "SELECT * FROM customer WHERE customerid='$customerid'";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $cfname=$row2['cfname']!==null?$row2['cfname']:'--';
                                    $clname=$row2['clname']!==null?$row2['clname']:'--';
                                    $customerid=$cfname.' '.$clname;
                                    }
 
                                     if($status!=="Available"){ 
                                        $book='background-color: red;color:white;';
                                     } else{
                                        $book=' ';
                                    }
                                  
                                  

                                    echo"
                                    
                                    <tr>
                                            
                                        <td><input type='text' class='form-control dynamic-field' value='" . $roomnumid . "' style='width: 5ch'; " . $fieldLength++ . " readonly></td>
                                        <td><input type='text' class='form-control dynamic-field' value='" . str_replace("Rooms", "", $roomname) . "' style='width: 9ch'; " . $fieldLength++ . " readonly></td>
                                        <td><input type='text' class='form-control dynamic-field' value='" . $capacity . "' style='width: 4ch'; " . $fieldLength++ . " readonly></td>
                                        <td><input type='text' class='form-control dynamic-field' value='" . $roomfloor . "' style='width: 4ch'; " . $fieldLength++ . " readonly></td>
                                        <td><input type='text' class='form-control dynamic-field' value='" . $status . "' style='width: 11ch;" . $book . "' " . $fieldLength++ . " readonly></td>
                                        <td><input type='number' step='any' min='0' name='price" . $rowcount . "' class='form-control price" . $rowcount . "' value='" . $price . "' id='" . $fieldLength . "' oninput='adjustLength(" . $fieldLength++ . ")'></td>
                                        <td>
                                            <select name='ac' class='form-control dynamic-field ac" . $rowcount . "' style='width: 6ch' id='" . $fieldLength++ . "'>
                                                <option value='1' " . ($ac == '1' ? 'selected' : '') . ">Yes</option>
                                                <option value='0' " . ($ac == '0' ? 'selected' : '') . ">No</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tv' class='form-control dynamic-field tv" . $rowcount . "' style='width: 6ch' id='" . $fieldLength++ . "'>
                                                <option value='1' " . ($tv == '1' ? 'selected' : '') . ">Yes</option>
                                                <option value='0' " . ($tv == '0' ? 'selected' : '') . ">No</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='wifi' class='form-control dynamic-field wifi" . $rowcount . "' style='width: 6ch' id='" . $fieldLength++ . "'>
                                                <option value='1' " . ($wifi == '1' ? 'selected' : '') . ">Yes</option>
                                                <option value='0' " . ($wifi == '0' ? 'selected' : '') . ">No</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='kitchen' class='form-control dynamic-field kitchen" . $rowcount . "' style='width: 6ch' id='" . $fieldLength++ . "'>
                                                <option value='1' " . ($kitchen == '1' ? 'selected' : '') . ">Yes</option>
                                                <option value='0' " . ($kitchen == '0' ? 'selected' : '') . ">No</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='fridge' class='form-control dynamic-field fridge" . $rowcount . "' style='width: 6ch' id='" . $fieldLength++ . "'>
                                                <option value='1' " . ($fridge == '1' ? 'selected' : '') . ">Yes</option>
                                <option value='0' " . ($fridge == '0' ? 'selected' : '') . ">No</option>
                                </select>
                                </td>
                                <td><input type='text' name='register_date" . $rowcount . "' class='form-control dynamic-field' value='" . $register_date . "' id='" . $fieldLength . "' oninput='adjustLength(" . $fieldLength++ . ")'readonly></td>
                                <td><input type='text' name='givedate" . $rowcount . "' class='form-control dynamic-field' value='" . $givedate . "' id='" . $fieldLength . "' oninput='adjustLength(" . $fieldLength++ . ")'readonly></td>
                                <td><input type='text' name='customerid" . $rowcount . "' class='form-control dynamic-field' value='" . $customerid . "' id='" . $fieldLength . "' oninput='adjustLength(" . $fieldLength++ . ")'readonly></td>
                                <td><button   class='btn btn-danger' id='submit$roomnumid'  onclick='editRoomsDetails$rowcount($roomnumid)'>Save</button></td>
                              
                                
                                 </tr>
                                    ";
                                    $rowcount++;
                                   
                                }
                                
                              
                             
                                $ddd=0;
                                while ($rowcount>=$ddd){
                                    
                                    $countPrice ='price' . $ddd;
                                    $countAc ='ac' . $ddd;
                                    $countTv ='tv' . $ddd;
                                    $countWifi ='wifi' . $ddd;
                                    $countKitchen ='kitchen' . $ddd;
                                    $countFridge ='fridge' . $ddd;

                                echo ("<script>
                                function editRoomsDetails$ddd(roomNumber) {
                                    ajaxToUpdateData(roomNumber,document.getElementsByClassName('$countPrice')[0].value,document.getElementsByClassName('$countAc')[0].value,document.getElementsByClassName('$countTv')[0].value,document.getElementsByClassName('$countWifi')[0].value,document.getElementsByClassName('$countKitchen')[0].value,document.getElementsByClassName('$countFridge')[0].value);
                                   
                                     

                                }
                             
                                
                                
                                </script>");
                                $ddd++;
                                }
                                ?>
                                <script>
                              function adjustLength(id){
                                    document.getElementById(id).style.width = ((document.getElementById(id).value.length + 6) * 1) + 'ch';
                              }
                              window.onload = function() {
                                let fieldLength = <?php echo $fieldLength-1; ?>;
                                while( fieldLength >= 0){
                                    adjustLength(fieldLength--);
                                   
                                }
                                
                              }
                              

                                


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