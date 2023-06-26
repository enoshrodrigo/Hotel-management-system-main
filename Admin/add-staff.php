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
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-add.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/vanilacss.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">



    <!-- <link rel="stylesheet" href="sb-admin.css"> -->
</head>

<body id="page-top">
    <div id="wrapper">

        <?php
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');
 

        if (isset($_POST['submit'])) {
            $nic = $_POST['nic'];
            $staff_Fname = $_POST['first_name'];
            $staff_Lname = $_POST['last_name'];
            $staff_email = $_POST['staff_email'];
            $staff_phone = $_POST['staff_mobile'];
            $staff_dob = $_POST['dob'];
            $staff_enteryear = $_POST['date'];
            $staff_description = $_POST['description'];
            // $staff_finger = $_POST['finger'];
            // $staff_role = $_POST['position'];



            $sql = "INSERT INTO staff (nic, f_name, l_name, email, mobile,dob,workyear,description) VALUES ('$nic', '$staff_Fname', 
            '$staff_Lname','$staff_email', '$staff_phone','$staff_dob','$staff_enteryear','$staff_description')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>confirm('Staff Added Successfully')</script>";
                echo "<script>window.location.href='staff.php'</script>";
            } else {
                echo "Staff Not Added";
            }
        }
        ?>

        <div class="container mt-5">
            <h3 class="text-dark mb-4">Customers</h3>
            <div class="card shadow">

                <!-- <div class="card-body"> -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form method="POST">
                                Enter NIC number: <div><input type="text" name="nic" class="form-control" id="vanilaformfields" required>
                                <div style="color: red;" id="ddd"></div>
                                </div>
                                Enter First Name: <div><input type="text" name="first_name" class="form-control" id="vanilaformfields" required>
                                Enter Last Name: <input type="text" name="last_name" class="form-control" id="vanilaformfields" required>
                                Enter Email: <input type="email" name="staff_email" class="form-control" required>
                                Enter P.No: <input type="tel" name="staff_mobile" class="form-control" required>
                                Enter DOB: <input type="date" name="dob" class="form-control" required>
                                Enter Enter year: <input type="year" name="date" class="form-control" required>
                                <!-- Enter Role: <input type="text" name="position" class="form-control" required> -->
                                Enter Descripton: <input type="text" name="description" class="form-control">
                                <br>
                                <div>
                                    <input type="reset" name="Reset" class="btn btn-primary">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Staff" style="float:right;" id="addstaff">

                                </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        document.getElementById("vanilaformfields").addEventListener("input", function() {
            event.preventDefault();
            var inputValue = document.getElementById("vanilaformfields").value;

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
                    document.getElementById('addstaff').style.backgroundColor = "#6662e0";
                    document.getElementById('addstaff').disabled = false;

                }
                if (this.readyState == 4 && this.status == 200) {

                    document.getElementById("ddd").innerHTML = this.responseText;
                }
            };

            xhttp.open("POST", "check.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("value=" + inputValue);
        }
    </script>
    </div>
    <?php
    include_once('navigation/footer.php');
    ?>

</body>