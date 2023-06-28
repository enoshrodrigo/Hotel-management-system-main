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
    Hide the login form by default .login-container {
      display: block;

    }

    /* Style the login form */
    .login-form {
      z-index: 999;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 5px;
      box-sizing: border-box;
      width: auto;
      height: auto;
      overflow: auto;

      /* max-width: -webkit-fill-available; */
      /* max-height: -webkit-fill-available; */
    }

    /* Style the form inputs */
    .login-form input[type="text"],
    .login-form input[type="password"] {
      margin-bottom: 20px;
      padding: 12px 20px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      width: 100%;
    }

    /* Style the submit button */
    .login-form input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


  <!-- <link rel="stylesheet" href="sb-admin.css"> -->
</head>

<body id="page-top">
  <div id="wrapper">


    <?php

    $sql = "SELECT * FROM staff";
    $result = $conn->query($sql);






    include_once('sidebar/sidebar.php');
    include_once('navigation/nav.php');

 
    // Check access level for this page
   

    ?>
    <!-- ---------------------- -->

    <div class="container-fluid">


      <h3 class="text-dark mb-4">Team</h3>
      <div class="card shadow">
        <div class="card-header py-3" id="enterstaff">


          <p class="text-primary m-0 fw-bold">Employee Info
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;">Add staff</a>
          </p>
        </div>
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-md-6" id="staffhide" style="display: none;">
              <?php if (isset($_POST['submit'])) {
                $nic = $_POST['nic'];
                $staff_Fname = $_POST['first_name'];
                $staff_Lname = $_POST['last_name'];
                $staff_email = $_POST['staff_email'];
                $staff_phone = $_POST['staff_mobile'];
                $staff_dob = $_POST['dob'];
                $staff_salary = $_POST['salary'];
                $staff_enteryear = $_POST['date'];
                $staff_description = $_POST['description'];
                // $staff_finger = $_POST['finger'];
                // $staff_role = $_POST['position'];



                $sql = "INSERT INTO staff (nic, f_name, l_name, email, mobile,dob, salary,workyear,description) VALUES ('$nic', '$staff_Fname', 
            '$staff_Lname','$staff_email', '$staff_phone','$staff_dob','$staff_salary','$staff_enteryear','$staff_description')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                  // echo "<script>confirm('Staff Added Successfully')</script>";
                  echo "<script>window.location.href='staff.php'</script>";
                } else {
                  echo "Staff Not Added";
                }
              }
              ?>

              <form method="POST">
                Enter NIC number: <div><input type="text" name="nic" class="form-control" id="vanilaformfields" required>
                  <div style="color: red;" id="ddd"></div>
                  <div style="color: red;" id="idSize"></div>
                </div>
                Enter First Name: <div><input type="text" name="first_name" class="form-control" id="vanilaformfields1" required>
                  Enter Last Name: <input type="text" name="last_name" class="form-control" id="vanilaformfields2" required>
                  Enter Email: <input type="email" name="staff_email" class="form-control" id="staff_email" required>
                  Enter Phone.No: <input type="tel" name="staff_mobile" class="form-control" id="staffmobile" required>
                  Enter DOB: <input type="date" name="dob" class="form-control" max="<?php
                    echo date('Y-m-d', strtotime('-18 years'));

                  ?>" required>
                  Enter salary: <input type="number" step='any' name="salary" class="form-control" required>
                  Enter Employe registered year: <input type="number" min='2000' max='<?php echo date('Y') ?>' name="date" class="form-control"    required>
                  <!-- Enter Role: <input type="text" name="position" class="form-control" required> -->
                  Enter Descripton: <input type="text" name="description" class="form-control">
                  <br>
                  <div>
                    <input type="reset" name="Reset" class="btn btn-primary">
                    <input type="submit" name="submit" class="btn btn-primary" value="Add Staff" style="float:right;" id="addstaff">

                  </div>


              </form>
            </div>



            <script>
              document.getElementById("vanilaformfields1").addEventListener("input", function() {
                var name = document.getElementById("vanilaformfields1").value;
                if (!/^[a-zA-Z]*$/g.test(name)) {
                  document.getElementById("vanilaformfields1").value = name.substring(0, name.length - 1);
                }
              });
              document.getElementById("vanilaformfields2").addEventListener("input", function() {
                var name = document.getElementById("vanilaformfields2").value;
                if (!/^[a-zA-Z]*$/g.test(name)) {
                  document.getElementById("vanilaformfields2").value = name.substring(0, name.length - 1);
                }
              });

              var bool = false;
              document.getElementById("enterstaff").addEventListener("click", function() {
                document.getElementById("staffhide").style.display = "none";
                if (bool) {
                  document.getElementById("staffhide").style.display = "block";
                  bool = false;
                } else {
                  document.getElementById("staffhide").style.display = "none";
                  bool = true;
                }

              });
              document.getElementById("vanilaformfields").addEventListener("input", function() {
                event.preventDefault();
                var inputValue = document.getElementById("vanilaformfields").value;
               if(inputValue.length <10){
                  document.getElementById("idSize").innerHTML ="Id length must be more than 10 characters";  
                  document.getElementById('addstaff').style.backgroundColor = "red";
                  document.getElementById('addstaff').disabled = false;           
                  }else{
                    document.getElementById("idSize").innerHTML ="";             
                  }

                checkInDB(inputValue);

              });

        

              function checkInDB(inputValue) {
                // event.preventDefault();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.responseText === 'already exists user.') {
                    document.getElementById('addstaff').style.backgroundColor = "red";
                    document.getElementById('addstaff').disabled = true;
                  } else {

                    document.getElementById("ddd").innerHTML ='';

                  
                    if (!/^\d+(V?)$/.test(inputValue)) {
                     

                     document.getElementById('addstaff').style.backgroundColor="red";
                     document.getElementById('addstaff').disabled=true;
                   document.getElementById("ddd").innerHTML ='Invalid NIC';

                   }
                   else{
                     document.getElementById('addstaff').style.backgroundColor="#6662e0";
                     document.getElementById('addstaff').disabled=false;
                   document.getElementById("ddd").innerHTML ='';

                   }
                  
                 
                   // Check if 'V' is in the middle of the ID
                   if (id.indexOf('V') !== id.length - 1) {
                     document.getElementById('addstaff').style.backgroundColor="red";
                     document.getElementById('addstaff').disabled=true;
                   document.getElementById("ddd").innerHTML ='Invalid NIC';
                   } else{
                     document.getElementById('addstaff').style.backgroundColor="#6662e0";
                     document.getElementById('addstaff').disabled=false;
                   document.getElementById("ddd").innerHTML ='';
                   }

                  }
                  if (this.readyState == 4 && this.status == 200) {

                    document.getElementById("ddd").innerHTML = this.responseText;
                  }
                };

                xhttp.open("POST", "./verify/staff-verify.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("value=" + inputValue);
              }
              
              //email mustbe contain @ and .  and before the @ mustbe contain 3 characters or more
              document.getElementById("staff_email").addEventListener("input", function() {
                                                var email = document.getElementById("staff_email").value;

                                                if(email.includes('@') && email.includes('.')){
                                          
                                                    document.getElementById("addstaff").disabled = false;
                                                }else{
                                                    document.getElementById("addstaff").disabled = true;
                                                }
                                            });
            

              
             
                                            </script>

            </script>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
          <div class="d-flex justify-content-between mb-3">
                            <div class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
                        
                            </div>
                          
                        </div>
            <thead>
              <tr>
                <th>NIC</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Enter year</th>
                <th>Salary</th>
                <th>Edit / delete</th>
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
              $query = "SELECT * FROM staff LIMIT $start, $records_per_page";
              // $result = mysqli_query($conn, $query);
              $result = $conn->query($query);
              $co = 0;
              while ($row = $result->fetch_assoc()) {
                $co++;
                echo '<tr>';
                echo '<td>' . $row['nic'] . '</td>';
                echo '<td id="c' . $row['nic'] . '">' . $row['f_name'] . " " . $row['l_name'] . '</td>';
                echo '<td>' . $row['email'] . " </td><td> " . $row['mobile'] . '</td>';
                echo '<td>' . $row['workyear'] . '</td>';
                echo '<td>Rs. ' . $row['salary'] . '</td>';
                echo '<td><a href="edit-staff.php?Sid=' . $row['staff_id'] . '" class="btn btn-primary btn-sm" style="margin-right:8px;">Edit</a>';
                //echo '<td><a href="customer.php?id=' . $row['customerid'] . '" class="btn btn-primary btn-sm edit-btn" style="margin-right:8px;">Edit</a>';
                echo '<a href="#" class="btn btn-danger btn-sm" onclick="deleteStaff(' . $row['staff_id'] . ')">Delete</a></td>';
                echo '</tr>';
              }
              if (isset($_GET['delid'])) {
                $delid = $_GET['delid'];
                $delquery = "DELETE FROM staff WHERE staff_id = '$delid'";
                $delresult = $conn->query($delquery);
                if ($delresult) {
                  echo "<script>window.location.href='staff.php';</script>";
                } else {
                  echo "Error: " . $delquery . "<br>" . $conn->error;
                }
              }
              ?>
              <script>
                function deleteStaff(id) {
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
                      window.location.href = 'staff.php?delid=' + id;
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


                });
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

  <script> //option to verify customer Mobile number  MOBILE SHOULD BE CONTAIN 10 DIGITS AND START WITH 0

document.getElementById("staffmobile").addEventListener("input", function() {
                                                var mobile = document.getElementById("staffmobile").value;
                                                if(mobile.length == 10 && mobile.charAt(0) == 0){
                                                    document.getElementById("addstaff").disabled = false;
                                                }else{
                                                    document.getElementById("addstaff").disabled = true;
                                                }
                                            });
                                            </script>
  </div>
  <footer class="bg-white sticky-footer">
    <div class="container my-auto">
      <div class="text-center my-auto copyright"><span>Copyright © Admin 2023</span></div>
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