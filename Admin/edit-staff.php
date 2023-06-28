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
                <h3 class="text-dark mb-4">Staff</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">

                    <p class="text-primary m-0 fw-bold" id="Editstaff">Edit Staff</p>

                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                              <div id="formContainer" >
                            <?php        if(isset($_GET['Sid'])){
                                    $staffid = $_GET['Sid'];
                                 $query = "SELECT * FROM staff where staff_id = $staffid";
                               
                                 $result = $conn->query($query);
 
                                 while ($row = $result->fetch_assoc()) {
                                        echo '<form  method="POST" id="editcustomer" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="staffid">Staff ID</label>
                                            <input type="text" class="form-control" id="staffnic" name="staffnic" value="'.$row['nic'].'" readonly>
                                            </div>
                                        <div class="form-group">
                                            <label for="stafffname">Employee Name</label>
                                            <input type="text" class="form-control" id="staffname" name="staffname" value="'.$row['f_name'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="stafflname">Employee Lname</label>
                                            <input type="text" class="form-control" id="stafflname" name="stafflname" value="'.$row['l_name'].'">
                                            </div>
                                            <div class="form-group">
                                            <label for="staffmobile">Employee Mobile</label>
                                            <input type="text" class="form-control" id="staffmobile" name="staffmobile" value="'.$row['mobile'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="staffemail">Employee Email</label>
                                            <input type="email" class="form-control" id="staffemail" name="staffemail" value="'.$row['email'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="staffdob">Employee Dob</label>
                                            <input type="date" class="form-control" id="staffemail" name="staffdob" value="'.$row['dob'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="staffsalary">Employee Salary</label>
                                            <input type="number" step="any" class="form-control" id="staffsalary" name="staffsalary" value="'.$row['salary'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="staffworkyear">Employee Salary</label>
                                            <input type="number" placeholder="YYYY" min="2000" max="'.date("Y").'" class="form-control" id="staffworkyear" name="staffworkyear" value="'.$row['workyear'].'">
                                            </div>
                                        <div class="form-group">
                                            <label for="staffdescription">Employee Description</label>
                                            <input type="text" class="form-control" id="staffescription" name="staffdescription" value="'.$row['description'].'">
                                            </div>
                                        <br>
                                        <div style=" margin-bottom:14px">
                                        <input type="reset" name="Reset" class="btn btn-primary">
                                        <input type="submit" name="staffsubmit" class="btn btn-primary" id="staffsubmit" style="float:right; ">
                                    </div>
                                        </form>';
                                        
                                 }
                                }
                                if(isset($_POST['staffsubmit'])){
                                  try{
                                    $staffid = $_POST['staffnic'];
                                    $stafffname = $_POST['staffname'];
                                    $stafflname = $_POST['stafflname'];
                                    $staffmobile = $_POST['staffmobile'];
                                    $staffemail = $_POST['staffemail'];
                                    $staffdob = $_POST['staffdob'];
                                    $staffsalary = $_POST['staffsalary'];
                                    $staffworkyear = $_POST['staffworkyear'];
                                    $staffdescription = $_POST['staffdescription'];
                                    $query = "UPDATE staff SET f_name = '$stafffname', l_name = '$stafflname', mobile = '$staffmobile', email = '$staffemail', dob = '$staffdob', salary = '$staffsalary', workyear = '$staffworkyear', description = '$staffdescription' WHERE nic = '$staffid'";
                                    $result = $conn->query($query);
                                    if($result){
                                        echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Employee Updated Successfully",
                                            showConfirmButton: false,
                                            timer: 1500
                                            
                                          }).then(function() {
                                            window.location.href = "staff.php";
                                          });
                                        </script>';
                                    }
                                else{
                                        echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Employee Not Updated",
                                            showConfirmButton: false,
                                            timer: 1500
                                          })
                                        </script>';
                                    }
                                }
                            
                                catch(Exception $e){
                                    echo '<script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Employee Not Updated",
                                        // showConfirmButton: false,
                                        footer: "Something went wrong please contact the developer",
                                        timer: 10000
                                      })
                                    </script>';
                                }
                            }
?>
                                        <script> 
 //email mustbe contain @ and .  
 document.getElementById("staffemail").addEventListener("input", function() {
                                                var email = document.getElementById("staffemail").value;

                                                if(email.includes('@') && email.includes('.')){
                                          
                                                    document.getElementById("staffsubmit").disabled = false;
                                                }else{
                                                    document.getElementById("staffsubmit").disabled = true;
                                                }
                                            });
//option to verify customer Mobile number  MOBILE SHOULD BE CONTAIN 10 DIGITS AND START WITH 0

document.getElementById("staffmobile").addEventListener("input", function() {
                                                var mobile = document.getElementById("staffmobile").value;
                                                if(mobile.length == 10 && mobile.charAt(0) == 0){
                                                    document.getElementById("staffsubmit").disabled = false;
                                                }else{
                                                    document.getElementById("staffsubmit").disabled = true;
                                                }
                                            });

              //GETH THE first name and last name from input fields the names must be contaion only letters
                                            document.getElementById("staffname").addEventListener("input", function() {
                                                var name = document.getElementById("staffname").value;
                                                var letters = /^[A-Za-z]+$/;
                                                if(name.match(letters)){
                                                    document.getElementById("staffsubmit").disabled = false;
                                                }else{
                                                    document.getElementById("staffsubmit").disabled = true;
                                                }
                                            });

                                            document.getElementById("stafflname").addEventListener("input", function() {
                                                var name = document.getElementById("stafflname").value;
                                                var letters = /^[A-Za-z]+$/;
                                                if(name.match(letters)){
                                                    document.getElementById("staffsubmit").disabled = false;
                                                }else{
                                                    document.getElementById("staffsubmit").disabled = true;
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