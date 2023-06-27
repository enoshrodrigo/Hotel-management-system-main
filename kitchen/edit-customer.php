<!DOCTYPE html>
<html lang="en">
<?php
require_once('../dbConnection/connect.php');

session_start();
  if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen') {
  
    header('Location: ../login.html');
  
  }
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
                <h3 class="text-dark mb-4">Customers</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold" id="addcustomer">customer Info
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;" id="addcustomer">Add customer</a>
                    </p>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                              <div id="formContainer" >
                            <?php     
                          
                               if(isset($_GET['cid'])){
                                    $customerid = $_GET['cid'];
                                 $query = "SELECT * FROM customer where customerid = '$customerid'";
                               
                                 $result = $conn->query($query);
                               
 
                                 while ($row = $result->fetch_assoc()) {
                                        echo '<form action="edit-customer.php" method="POST" id="editcustomer" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="customerid">Customer ID</label>
                                            <input type="text" class="form-control" id="customerid" name="customerid" value="'.$row['customerid'].'" readonly>
                                            </div>
                                        <div class="form-group">
                                            <label for="customername">Customer Name</label>
                                            <input type="text" class="form-control" id="customername" name="customername" value="'.$row['cfname'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Lname</label>
                                            <input type="text" class="form-control" id="customerlname" name="customerlname" value="'.$row['clname'].'">
                                            </div>
                                            <div class="form-group">
                                            <label for="customeremail">Customer Mobile</label>
                                            <input type="text" class="form-control" id="customermobile" name="customermobile" value="'.$row['cmobile'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Email</label>
                                            <input type="emai;" class="form-control" id="customeremail" name="customeremail" value="'.$row['cemail'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Dob</label>
                                            <input type="date" class="form-control" id="customeremail" name="customerdob" value="'.$row['cdob'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Health</label>
                                            <input type="text" class="form-control" id="customerhealth" name="customerhealth" value="'.$row['health'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Description</label>
                                            <input type="text" class="form-control" id="customerdescription" name="customerdescription" value="'.$row['cdescription'].'">
                                            </div>
                                        <br>
                                        <div style=" margin-bottom:14px">
                                        <input type="reset" name="Reset" class="btn btn-primary">
                                        <input type="submit" name="cupsubmit" class="btn btn-primary" id="csubmit" style="float:right; ">
                                    </div>
                                        </form>';
                                        
                                 }
                                }
                                if(isset($_POST['cupsubmit'])){
                                    $customerid = $_POST['customerid'];
                                    $customername = $_POST['customername'];
                                    $customerlname = $_POST['customerlname'];
                                    $customermobile = $_POST['customermobile'];
                                    $customeremail = $_POST['customeremail'];
                                    $customerdob = $_POST['customerdob'];
                                    $customerhealth = $_POST['customerhealth'];
                                    $customerdescription = $_POST['customerdescription'];
                                    $query = "UPDATE customer SET cfname = '$customername', clname = '$customerlname', cmobile = '$customermobile', cemail = '$customeremail', cdob = '$customerdob', health = '$customerhealth', cdescription = '$customerdescription' WHERE customerid = '$customerid'";
                                    $result = $conn->query($query);
                                    if($result){
                                        echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Customer Updated Successfully",
                                            showConfirmButton: false,
                                            timer: 1500
                                            
                                          }).then(function() {
                                            window.location = "customer.php?#c'.$customerid.'";
                                          });
                                        </script>';
                                    }else{
                                        echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Customer Not Updated",
                                            showConfirmButton: false,
                                            timer: 1500
                                          })
                                        </script>';
                                    }
                                }
?>
 
<script>
    //customer first name and last name must be contain only letters
        document.getElementById("customername").addEventListener("input", function(evt) {
            var self = this;
            var invalidChars = /[^a-zA-Z]/;
            if (invalidChars.test(self.value)) {
                self.value = self.value.replace(invalidChars, "");
            }
        }, false);
        document.getElementById("customerlname").addEventListener("input", function(evt) {
            var self = this;
            var invalidChars = /[^a-zA-Z]/;
            if (invalidChars.test(self.value)) {
                self.value = self.value.replace(invalidChars, "");
            }
        }, false);

        //mobile number must be contain only  10 digits and start with 0

        document.getElementById("customermobile").addEventListener("input", function(evt) {
            var self = this;
            var invalidChars = /[^0-9]/;
            if (invalidChars.test(self.value)) {
                self.value = self.value.replace(invalidChars, "");
            }
            if (self.value.length > 10) {
                self.value = self.value.slice(0, 10);
            }
            //first digit must be 0
            if (self.value.length == 1) {
                if (self.value != 0) {
                    self.value = "";
                }
            }
            
        }, false);

       
    


    </script>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Admin 2023</span></div>
                </div>
            </footer>
            <div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
            <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
            <script src="../assets/js/bs-init.js"></script>
            <script src="../assets/js/theme.js"></script>
            <script src="../assets/js/javas.js"></script>
            <script src="../assets/js/ajax.js"></script>


            <!-- ---------------------- -->


</body>

</html>