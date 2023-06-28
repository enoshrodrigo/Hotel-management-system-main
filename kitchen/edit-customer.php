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
                                            <input type="text" class="form-control" id="customername" name="customername" value="'.$row['cfname'].'" required>
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Lname</label>
                                            <input type="text" class="form-control" id="customerlname" name="customerlname" value="'.$row['clname'].'"required>
                                            </div>
                                            <div class="form-group">
                                            <label for="customeremail">Customer Mobile</label>
                                            <input type="text" class="form-control" id="customermobile" name="customermobile" value="'.$row['cmobile'].'"required>
                                            <div id="Mobilenumberwarning" style="color:red;" ></div>
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Email</label>
                                            <input type="email" class="form-control" id="customeremail" name="customeremail" value="'.$row['cemail'].'"required>
                                            <div id="Emailwarning" style="color:red;" ></div>
                                            </div>
                                        <div class="form-group">
                                            <label for="customeremail">Customer Dob</label>
                                            <input type="date" class="form-control" id="customerDob" name="customerdob" value="'.$row['cdob'].'"required>
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
 
    //verify input fields
    document.getElementById("page-top").addEventListener("mousemove", function() {
            
            //verify customer email
            //email mustbe contain @ and .  and before the @ mustbe contain 3 characters or more
    
            var email = document.getElementById("customeremail").value;
    
            if (email.includes('@') && email.includes('.')) {
                email_verified = false;
                document.getElementById("csubmit").disabled = false;
                document.getElementById("Emailwarning").innerHTML = "";

            } else {
                email_verified = true;
                document.getElementById("Emailwarning").innerHTML = "Email must contain @ and .";
                document.getElementById("csubmit").disabled = true;
            }
            //customer mobile number validation number only can contaion 10 numbers and start with 0
            var mob = document.getElementById("customermobile").value;
            var filter = /^\d*(?:\.\d{1,2})?$/;
            if (filter.test(mob)) {
                if (mob.length == 10) {
                    if (mob.charAt(0) == 0) {
                        document.getElementById("Mobilenumberwarning").innerHTML = "";
                        mob_verified = false;
                        document.getElementById("csubmit").disabled = false;
                    } else {
                        document.getElementById("Mobilenumberwarning").innerHTML = "Mobile number must start with 0";
                        mob_verified = true;
                        document.getElementById("csubmit").disabled = true;
                    }
                } else {
                    document.getElementById("Mobilenumberwarning").innerHTML = "Mobile number must contain 10 numbers";
                    mob_verified = true;
                    document.getElementById("csubmit").disabled = true;
                }
            } else {
                document.getElementById("Mobilenumberwarning").innerHTML = "Mobile number must contain numbers only";
                mob_verified = true;
                document.getElementById("csubmit").disabled = true;
            }
     
            if( email_verified || mob_verified){
                document.getElementById("csubmit").disabled = true;
            }else{
                document.getElementById("csubmit").disabled = false;
            }

    });
    //first name and last name must be contain only letters
    document.getElementById("customername").addEventListener("input", function() {
        var name = document.getElementById("customername").value;
        if (!/^[a-zA-Z]*$/g.test(name)) {
            document.getElementById("customername").value = name.substring(0, name.length - 1);
        }
    }); 
    document.getElementById("customerlname").addEventListener("input", function() {
        var name = document.getElementById("customerlname").value;
        if (!/^[a-zA-Z]*$/g.test(name)) {
            document.getElementById("customerlname").value = name.substring(0, name.length - 1);
        }
    });



       
    


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
                    <div class="text-center my-auto copyright"><span>Copyright © Rico shadow 2023</span></div>
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