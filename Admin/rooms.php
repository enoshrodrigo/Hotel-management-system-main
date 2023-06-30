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

    <style>
        #card1:hover,
        #card2:hover,
        #card3:hover,
        #card4:hover {

            transform: translateY(15px);
            transition: 0.5s;

        }

        #card1,
        #card2,
        #card3,
        #card4 {
            transition: 0.5s;
            cursor: pointer;
        }

        #row {
            margin-top: 30px;
        }
    </style>

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


    <!-- <link rel="stylesheet" href="sb-admin.css"> -->
</head>

<body id="page-top">
    <div id="wrapper">


        <?php
        
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');
 ;
  
  
 
      ?>
        <!-- ---------------------- -->
        <div class="container-fluid" id="kkkk">
<!-- get the currently booking rooms and availbel rooms in each category -->

            <?php
            $sql = "SELECT * FROM roomdetail WHERE status = 0";
            $result = mysqli_query($conn, $sql);
            $single = 0;
            $double = 0;
            $family = 0;
            $deluxe = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['roomtype'] == 1) {
                    $single++;
                } else if ($row['roomtype'] == 2) {
                    $double++;
                } else if ($row['roomtype'] == 3) {
                    $family++;
                } else if ($row['roomtype'] == 4) {
                    $deluxe++;
                }
            }
            $sql = "SELECT * FROM roomdetail;";
            $result = mysqli_query($conn, $sql);
            $single1 = 0;
            $double1 = 0;
            $family1 = 0;
            $deluxe1 = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['roomtype'] == 1) {
                    $single1++;
                } else if ($row['roomtype'] == 2) {
                    $double1++;
                } else if ($row['roomtype'] == 3) {
                    $family1++;
                } else if ($row['roomtype'] == 4) {
                    $deluxe1++;
                }
            }
            ?>

            <script>
            

                   </script>
            <!-- ---------------------- -->
           



            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Dashboard</h3>
                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="index.php"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
            </div>
            
            <div class="row" id="row">
                <!-- <a href="#spec"> -->
                <div class="col-md-6 col-xl-3 mb-4" id="card1" value="1">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xl mb-1"><span>Single Rooms</span></div>
                                    <div class="text-dark fw-bold h4 mb-0"><span><?php echo $single; ?>/<?php echo $single1; ?></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-male fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </a> -->
                <div class="col-md-6 col-xl-3 mb-4" id="card2">
                    <div class="card shadow border-start-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-success fw-bold text-xl mb-1"><span>Double Rooms</span></div>
                                    <div class="text-dark fw-bold h4 mb-0"><span><?php echo $double; ?>/<?php echo $double1; ?></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-male fa-3x"></i><i class="fas fa-male fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4" id="card3">
                    <div class="card shadow border-start-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xl mb-1"><span>Family Rooms</span></div>
                                    <div class="row g-0 align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h4 mb-0 me-3"><span><?php echo $family; ?>/<?php echo $family1; ?></span></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-house fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4" id="card4">
                    <div class="card shadow border-start-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-warning fw-bold text-xl mb-1"><span>Deluxe Rooms</span></div>
                                    <div class="text-dark fw-bold h4 mb-0"><span><?php echo $deluxe; ?>/<?php echo $deluxe1; ?></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-house-signal fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var toggel = true;



                document.getElementById("card1").addEventListener("click", function click() {
                    if (toggel) {
                        document.getElementById("addr").style.display = "block";
                        document.getElementById("roomtype").value = "1";
                        var event = new Event("input");
                        document.getElementById("roomtype").dispatchEvent(event);
                    } else {
                        document.getElementById("addr").style.display = "none";
                    }
                    toggel = !toggel;

                });

                document.getElementById("card2").addEventListener("click", function click() {

                    if (toggel) {
                        document.getElementById("addr").style.display = "block";
                        document.getElementById("roomtype").value = "2";
                        var event = new Event("input");
                        document.getElementById("roomtype").dispatchEvent(event);
                    } else {
                        document.getElementById("addr").style.display = "none";
                    }
                    toggel = !toggel;
                });

                document.getElementById("card3").addEventListener("click", function click() {
                    if (toggel) {
                        document.getElementById("addr").style.display = "block";
                        document.getElementById("roomtype").value = "3";
                        var event = new Event("input");
                        document.getElementById("roomtype").dispatchEvent(event);
                    } else {
                        document.getElementById("addr").style.display = "none";
                    }
                    toggel = !toggel;
                });

                document.getElementById("card4").addEventListener("click", function click() {
                    if (toggel) {
                        document.getElementById("addr").style.display = "block";
                        document.getElementById("roomtype").value = "4";
                        var event = new Event("input");
                        document.getElementById("roomtype").dispatchEvent(event);
                    } else {
                        document.getElementById("addr").style.display = "none";
                    }
                    toggel = !toggel;
                });
            </script>
            <button class="btn btn-primary btn-sm d-none d-sm-inline-block" type="button" style="float:right;" onclick="window.location.href='bookedrooms.php'">Check booked rooms</button>
            <h3 class="text-dark mb-4">Rooms</h3>
            <div class="card shadow">
                <div class="card-header py-3" id="addroom">


                    <p class="text-primary m-0 fw-bold">Room history
                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" href="./edit-rooms.php" style="float:right; margin-left:14px;">Edit room details</a>
                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;">Reservation room</a>

                    </p>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form method="POST" id="addr" style="display: none;" action="roomregister.php">
                                Room type: <div><select class="form-control" id="roomtype" name="roomtype" required>
                                        <option value="">Select Room Type</option>
                                        <option value=1>Single</option>
                                        <option value=2>Double</option>
                                        <option value=3>Family</option>
                                        <option value=4>Deluxe</option>
                                    </select>
                                    <div style="color: red;" id="ddd"></div>
                                </div>
                                Room number: <div><select class="form-control" id="roomnumber" name="roomnumber" onchange=hi(); required>

                                        <option value="">default</option>

                                    </select>
                                    <div> price: <input type="number" name="price" class="form-control" id="price" readonly placeholder="no val"></div>
                                    <div> customer: <select class="form-control" id="roomcustomer" name="roomcustomer">
                                            <?php
                                            $sql = "SELECT * FROM customer";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value=" . $row['customerid'] . ">" . $row['cfname'] . " " . $row['clname'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="checkin">Check in</label>
                                        <input type="datetime-local" value="<?php echo(date("Y-m-d\TH:i"));?>"     class="form-control"  readonly>
                                    </div>

                                    <div>
                                        <label for="checkin">Check out</label>
                                        <input type="datetime-local" min="<?php echo(date("Y-m-d\TH:i"));?>" name="checkin" class="form-control" id="checkin" required>
                                    </div>

                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultac" name="ac">
                                        <label class="form-check-label">
                                            Ac
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultwifi" name="wifi">
                                        <label class="form-check-label">
                                            WIFI
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaulttv" name="tv">
                                        <label class="form-check-label">
                                            Tv
                                        </label>
                                    </div>



                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultkitchen" name="kitchen">
                                        <label class="form-check-label">
                                            Kitchen
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultfridge" name="fridge">
                                        <label class="form-check-label">
                                            Fridge
                                        </label>
                                    </div>


                                    <br>
                                    <div style=" margin-bottom:14px">
                                        <input type="reset" name="Reset" class="btn btn-primary">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Book" style="float:right;" id="addstaff">
                                    </div>
                                </div>


                            </form>


                        </div>
                        <script>
                            var addroom = true;
                            document.getElementById("addroom").addEventListener("click", function click() {
                                if (addroom) {
                                    document.getElementById("addr").style.display = "block";
                                } else {
                                    document.getElementById("addr").style.display = "none";
                                }
                                addroom = !addroom;
                            });
                        </script>

                    </div>


                    <div class="table-responsive">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
                        
                            </div>
                          
                        </div>

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer name</th>
                                    <th>Room name</th>
                                    <th>Room number</th>
                                    <th>Checked in</th>
                                    <th>Checked out</th>
                                    <th>Price</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $records_per_page = 20;
                                $page = 0;
                                if (isset($_GET['page'])) {
                                    $page = intval($_GET['page']) - 1;
                                }
                                $start = $page * $records_per_page;
                                $query = "SELECT * FROM history , roomdetail, customer ,room  WHERE history.historycustomerid = customer.customerid 
                                AND roomdetail.roomnumid = history.historyroomid AND room.roomid = roomdetail.roomtype ORDER BY historygivendate DESC LIMIT $start, $records_per_page ";
                                // $result = mysqli_query($conn, $query);
                                $result = $conn->query($query);

                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['cfname'] . " " . $row['clname'] . '</td>';
                                    echo '<td>' . $row['roomname'] . '</td>';
                                    echo '<td>' . $row['roomnumid'] . '</td>';
                                    echo '<td>' . $row['historyrigisterdate'] . '</td>';
                                    echo '<td>' . $row['historygivendate'] . '</td>';
                                    echo '<td> RS.' . $row['historypayement'] . '</td>';
                                    echo '<td><a href="#" class="btn btn-danger btn-sm" onclick="deleteCustomer(' . $row['historyid'] . ')">Delete</a></td>';
                                    echo '</tr>';
                                }
                                if (isset($_GET['delid'])) {
                                    $delid = $_GET['delid'];
                                    $delquery = "DELETE FROM history WHERE historyid = '$delid'";
                                    $delresult = $conn->query($delquery);
                                    if ($delresult) {
                                        echo "<script>window.location.href='rooms.php';</script>";
                                    } else {
                                        echo "Error: " . $delquery . "<br>" . $conn->error;
                                    }
                                }
                                ?>
                                <script>
                                    function deleteCustomer(id) {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "You won't be able to revert this!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, delete it!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'rooms.php?delid=' + id;
                                            }
                                        })
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
                            $total_records = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM history" ));
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
    <script src="../assets/js/jquery.min.js"></script>                                                                              
    <script src="./js/rooms.js"></script>

    <!-- ---------------------- -->


</body>

</html>