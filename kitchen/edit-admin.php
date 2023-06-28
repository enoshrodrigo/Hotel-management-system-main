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
    

    <!-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>   -->

    <!-- <link rel="stylesheet" href="sb-admin.css"> -->
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');

        if (isset($_POST['submit'])) {
            //update password in admins tabel 
            $password =md5($_POST['passwordCheck']);
            $sql = "UPDATE kitchens SET password='".$password."' WHERE username='" . $_SESSION['username'] . "'";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                echo "<script>window.reload();</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
             
          
        }
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">
            <div class="row" id="row">
                <h3 class="text-dark mb-4">Kitchen-Admin</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3" id=" "> 
                    <p class="text-primary m-0 fw-bold" id=" ">Admin Info
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;" id=" ">Kitchen-Admin</a>
                        <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-6">  `
                             

                                <form action='./edit-admin.php' method="POST">
                                    <?php 
                                $sql = "SELECT * FROM kitchens where username ='". $_SESSION['username']."'";
                                
                                $result = mysqli_query($conn,$sql);
                    
                                if($result){
                                    if(mysqli_num_rows($result) == 1){
                                  $row = mysqli_fetch_assoc($result);
                                  echo' <div> User Name: <input type="text" name="username" value="'.$row["username"].'" class="form-control" id="username" readonly ></div>
                                  <div> Password: <input type="password" name="password" class="form-control" id="password"  required></div>
                                  <div> Re enter password: <input type="password" name="passwordCheck" class="form-control" id="passwordCheck" required ></div>
                                  <br>
                                        <div style=" margin-bottom:14px">
                                        <input type="reset" name="Reset" class="btn btn-primary">
                                        <input type="submit" name="submit"  class="btn btn-primary" id="adminubmit" style="float:right; ">
                                    </div> ';
  

                                    }
                                }

                              
                                   
 ?>
                                </form>
                            
                        </div>
                    </div>


                    
                </div>
            </div>
        </div>


 <script>     

//  $(document).ready(function(){
//     $('#adminubmit').click(function(){
//         var password = $('#password').val();
//         var passwordCheck = $('#passwordCheck').val();
//         if(password != passwordCheck){
//             alert("Password does not match");
//             return false;
//         }
//     });
// });
    
 //check password match or not if not match show error message and disable submit button

 $(document).ready(function(){
    $('#adminubmit').click(function(){
        var password = $('#password').val();
        var passwordCheck = $('#passwordCheck').val();
        if(password != passwordCheck){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password does not match!',
                footer: '<a href>Why do I have this issue?</a>'
              })
            return false;
        }
    });
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
 


    <!-- ---------------------- -->


</body>

</html>