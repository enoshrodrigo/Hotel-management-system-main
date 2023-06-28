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

    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Booked Rooms</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <!-- <link rel="stylesheet" href="sb-admin.css"> -->
</head>

<body id="page-top">
    <div id="wrapper">

        <?php
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');



        ?>

        <!-- ---------------------- -->

        <div class="container-fluid">


            <h3 class="text-dark mb-4">Rooms</h3>
            <div class="card shadow">
                <div class="card-header py-3" id="enterstaff">


                    <p class="text-primary m-0 fw-bold">Booking Info
                        <!-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;"></a> -->
                    <a href="rooms.php" class="btn btn-primary btn-sm d-none d-sm-inline-block" style="float:right;background-color:#6e71d7;" role="button">Go back</a>

                    </p>
                    <!-- button for go back -->
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Room</th>
                                    <th>Room number</th>
                                    <th>Customer Id</th>
                                    <th>Customer Name</th>
                                    <th>Booked date</th>
                                    <th>Given date</th>
                                    <th>Price</th>
                                    <th>Expire in </th>
                                    <th>Pay succes</th>
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
                                $query = "SELECT * FROM roomdetail ,room, customer WHERE roomdetail.status = 0 
                            AND roomdetail.roomtype =  room.roomid AND customer.customerid = roomdetail.customerid 
                            LIMIT $start, $records_per_page";
                                $result = mysqli_query($conn, $query);
                                $k = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $k++;
                                    echo '<tr>';
                                    echo '<td>' . $row['roomname'] . '</td>';
                                    echo '<td>' . $row['roomnumid'] . '</td>';
                                    echo '<td>' . $row['customerid'] . '</td>';
                                    echo '<td>' . $row['cfname'] . ' ' . $row['clname'] . '</td>';
                                    echo '<td>' . $row['register_date'] . '</td>';
                                    echo '<td>' . $row['givedate'] . '</td>';
                                    //current price based on date
                                    // $currentdate = date("Y-m-d");
                                    $date1 = new DateTime($row['register_date']);
                                    $date2 = new DateTime($row['givedate']);
                                    $diff = $date1->diff($date2);
                                    $days = $diff->days;
                                    $price = $row['price'] * $days;
                                    //if date is less than 0 then price is $row['price']
                                    if ($price < $row['price']) {
                                        $price = $row['price'];
                                    }
                                    echo '<td>Rs.' . $price . ' </td>';
                                ?><td id="countdown<?php echo $k; ?>"></td>
                                    <td>
                                         <!-- <a href="pay.php?roomid=<?php //echo $row['roomnumid']; ?>&customerid=<?php //echo $row['customerid']; ?>" class="btn btn-primary btn-sm d-none d-sm-inline-block" style="background-color:#6e71d7;" role="button">Pay sucess</a> -->
                                    <a href="#" class="btn btn-primary btn-sm d-none d-sm-inline-block" style="background-color:#6e71d7;" onclick="deleteBooks('<?php echo $row['roomnumid']; ?> ')">CheckOut</a></td>

                                <?php
                                    echo '</tr>';
                                    echo "    <script>
                                let countDownDate$k = new Date('$row[givedate]').getTime();
                                let x$k = setInterval(function() {
                                    let now$k = new Date().getTime();
                                    let distance$k = countDownDate$k - now$k;
                                    let days$k = Math.floor(distance$k / (1000 * 60 * 60 * 24));
                                    let hours$k = Math.floor((distance$k % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    let minutes$k = Math.floor((distance$k % (1000 * 60 * 60)) / (1000 * 60));
                                    let seconds$k = Math.floor((distance$k % (1000 * 60)) / 1000);
                                    document.getElementById('countdown$k').innerHTML = days$k + 'd ' + hours$k + 'h ' +
                                        minutes$k + 'm ' + seconds$k + 's ';
                                    if (distance$k < 0) {
                                        clearInterval(x$k);
                                        document.getElementById('countdown$k').innerHTML = 'EXPIRED'
                                        document.getElementById('countdown$k').style.color = '#6662e0';
                                        document.getElementById('countdown$k').style.fontWeight = 'bold';
                                       
                                     
                                        
                                    }
                                }, 1000);
                            </script>";
                                }

                                ?>
                                  <script>
                                    function deleteBooks(id) {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "You won't be able to revert this!",
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, Check out the room!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'pay.php?roomid=' + id;
                                            }
                                        })
                                    }

                                  
                                </script>

                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                            $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM staff"));
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
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/javas.js"></script>
    <script src="../assets/js/ajax.js"></script>

    <!-- ---------------------- -->


</body>

</html>