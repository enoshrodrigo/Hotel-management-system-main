<!DOCTYPE html>
<html lang="en">
<?php
require_once('../dbConnection/connect.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen') {

    header('Location: ../login.html');
}


// Check access level for this page


?>

<head>




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
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');

        if (isset($_POST['submit'])) {
            $nic = $_POST['nic'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['customer_mobile'];
            $email = $_POST['customer_email'];
            $dob = $_POST['customer_dob'];
            $description = $_POST['customer_description'];
            $health = $_POST['customer_health'];
            $customersql = "INSERT INTO customer (customerid,cfname,clname,cmobile,cemail,cdob,health,cdescription) VALUES ('$nic','$first_name', '$last_name', '$phone', '$email', '$dob','$health', '$description')";
            $cresult = $conn->query($customersql);
            if ($cresult) {
                // echo "<script>window.location.reload();</script>";
                echo "<script>window.location.href='customer.php';</script>";
            } else {
                echo "Error: " . $customersql . "<br>" . $conn->error;
            }
        }
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">
            <div class="row" id="row">
                <h3 class="text-dark mb-4">Customers</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3" id="addcustomer">
                    <p class="text-primary m-0 fw-bold" id="addcustomer">customer Info
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;" id="addcustomer">Add customer</a>
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div id="formContainer" style="display: none;">

                                <form method="POST">
                                    Enter NIC number: <div><input type="text" name="nic" class="form-control" id="customernic" required>
                                        <div style="color: red;" id="customercheck"></div>
                                        <div style="color: red;" id="customernic"></div>

                                    </div>
                                    Enter First Name: <div><input type="text" name="first_name" class="form-control" id="first_name" required>
                                        Enter Last Name: <input type="text" name="last_name" class="form-control" id="last_name" required>
                                        Enter Email: <input type="email" name="customer_email" id="customer_email" class="form-control" required>
                                        <div style="color: red;" id="customer_email_warning"></div>
                                        Enter Phone.No: <input type="tel" name="customer_mobile" id="cmobile" class="form-control" required>
                                        <div style="color: red;" id="cmobile_warning"></div>
                                        Enter DOB: <input type="date" name="customer_dob" class="form-control" max="<?php
                                                                                                                    echo
                                                                                                                    date('Y-m-d', strtotime('-18 years'));
                                                                                                                    ?>" required>
                                        Health Conditions: <input type="text" name="customer_health" class="form-control form-control-lg">
                                        <!-- Enter Enter year: <input type="year" name="customer_date" class="form-control" required> -->
                                        Enter Descripton: <input type="text" name="customer_description" class="form-control form-control-lg">
                                        <br>
                                        <div style=" margin-bottom:14px">
                                            <input type="reset" name="Reset" class="btn btn-primary">
                                            <input type="submit" name="submit" class="btn btn-primary" id="csubmit" style="float:right; ">
                                        </div>
                                        <!-- irc technology -->
                                </form>
                            </div>
                        </div>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone/edit</th>
                                    <th>birthday</th>
                                    <th>Health</th>
                                    <th>Edit / delete</th>


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
                                $query = "SELECT * FROM customer LIMIT $start, $records_per_page";
                                // $result = mysqli_query($conn, $query);
                                $result = $conn->query($query);
                                $co = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $co++;
                                    echo '<tr>';
                                    echo '<td>' . $row['customerid'] . '</td>';
                                    echo '<td id="c' . $row['customerid'] . '">' . $row['cfname'] . " " . $row['clname'] . '</td>';
                                    echo '<td>' . $row['cmobile'] . " </td><td> " . $row['cdob'] . '</td>';
                                    echo '<td>' . $row['health'] . '</td>';
                                    echo '<td><a href="edit-customer.php?cid=' . $row['customerid'] . '" class="btn btn-primary btn-sm" style="margin-right:8px;">Edit</a>';
                                    echo '<a href="#" class="btn btn-danger btn-sm" onclick="deleteCustomer(' . $row['cid'] . ')">Delete</a></td>';
                                    echo '</tr>';
                                }
                                if (isset($_GET['delid'])) {
                                    try {
                                        $delid =  $_GET['delid'];
                                        $delquery = "DELETE FROM customer WHERE cid = $delid";
                                        $delresult = $conn->query($delquery);
                                        if ($delresult) {
                                            echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'Customer deleted successfully!',
                                            timer: 2000
                                           // showConfirmButton: false
                                        }).then(function() {
                                                window.location.href='customer.php';
                                            })
                                        </script>";
                                        } else {
                                            //have data abouth the customer
                                            echo "<script>
                                         Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Contain data in databse!',
                                            timer: 2000
                                           // showConfirmButton: false
                                        }).then(function() {
                                                window.location.href='customer.php';
                                            })
                                        </script>";
                                        }
                                    } catch (Exception $e) {
                                        echo "<script> 
                                      Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                        timer: 2000
                                       // showConfirmButton: false
                                    }).then(function() {
                                            window.location.href='customer.php';
                                        });;
                                
                                  </script>";
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
                                                window.location.href = 'customer.php?delid=' + id;
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
                            $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer"));
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


        <script>
            //customer mobile number validation number only can contaion 10 numbers and start with 0
            // $(document).ready(function() {
            //     $("#cmobile").on("input", function() {
            //         var mob = $(this).val();
            //         var filter = /^\d*(?:\.\d{1,2})?$/;
            //         if (filter.test(mob)) {
            //             if (mob.length == 10) {
            //                 if (mob.charAt(0) == 0) {
            //                     $("#cmobile").css("border", "2px solid green");
            //                     $("#csubmit").prop('disabled', false);
            //                 } else {
            //                     $("#cmobile").css("border", "2px solid red");
            //                     $("#csubmit").prop('disabled', true);
            //                 }
            //             } else {
            //                 $("#cmobile").css("border", "2px solid red");
            //                 $("#csubmit").prop('disabled', true);
            //             }
            //         } else {
            //             $("#cmobile").css("border", "2px solid red");
            //             $("#csubmit").prop('disabled', true);
            //         }
            //     });
            // });
            document.getElementById("page-top").addEventListener("mousemove", function() {

                //verify customer email
                //email mustbe contain @ and .  and before the @ mustbe contain 3 characters or more

                var email = document.getElementById("customer_email").value;

                if (email.includes('@') && email.includes('.')) {
                    document.getElementById("customer_email_warning").innerHTML = '';
                    email_verified = false;
                    document.getElementById("csubmit").disabled = false;
                } else {
                    document.getElementById("customer_email_warning").innerHTML = 'invalid email';
                    email_verified = true;
                    document.getElementById("csubmit").disabled = true;
                }
                //customer mobile number validation number only can contaion 10 numbers and start with 0
                var mob = document.getElementById("cmobile").value;
                var filter = /^\d*(?:\.\d{1,2})?$/;
                if (filter.test(mob)) {
                    if (mob.length == 10) {
                        if (mob.charAt(0) == 0) {
                            document.getElementById("cmobile_warning").innerHTML = '';
                            mob_verified = false;
                            document.getElementById("csubmit").disabled = false;
                        } else {
                            document.getElementById("cmobile_warning").innerHTML = 'mobile number should be start with 0';
                            mob_verified = true;
                            document.getElementById("csubmit").disabled = true;
                        }
                    } else {
                        document.getElementById("cmobile_warning").innerHTML = 'mobile number should be 10 digits';
                        mob_verified = true;
                        document.getElementById("csubmit").disabled = true;
                    }
                } else {
                    document.getElementById("cmobile_warning").innerHTML = 'mobile number should be 10 digits';
                    mob_verified = true;
                    document.getElementById("csubmit").disabled = true;
                }
                //id must be contain more than 10 digits and it can be contain V at the end of the nic but its not mandotary
                var nic = document.getElementById("customernic").value;
                if (nic.length >= 10) {
                    if (/^\d+(V?)$/.test(nic)) {
                        nic_verified = false;
                        document.getElementById("csubmit").disabled = false;
                    } else {
                        nic_verified = true;
                        document.getElementById("customernic").innerHTML = 'invalid nic';
                        document.getElementById("csubmit").disabled = true;
                    }
                } else {
                    nic_verified = true;
                    document.getElementById("customernic").innerHTML = 'nic should be more than 10 digits';
                    document.getElementById("csubmit").disabled = true;
                }



                if (email_verified || mob_verified || nic_verified) {
                    document.getElementById("csubmit").disabled = true;
                } else {
                    document.getElementById("csubmit").disabled = false;
                }





            });




            //first name and last name must be contain only letters
            //   });
            document.getElementById("first_name").addEventListener("input", function() {
                var name = document.getElementById("first_name").value;
                if (!/^[a-zA-Z]*$/g.test(name)) {
                    document.getElementById("first_name").value = name.substring(0, name.length - 1);
                }
            });
            document.getElementById("last_name").addEventListener("input", function() {
                var name = document.getElementById("last_name").value;
                if (!/^[a-zA-Z]*$/g.test(name)) {
                    document.getElementById("last_name").value = name.substring(0, name.length - 1);
                }
            });
        </script>


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
    <script src="../assets/js/ajax.js"></script>

    <script src="./verifyKitchen/javas.js"></script>     <!-- verify customer form -->



    <!-- ---------------------- -->


</body>

</html>