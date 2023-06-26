<!DOCTYPE html>
<html lang="en">
<?php
require_once('../dbConnection/connect.php');
session_start();

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
        if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen')
        {
        
            header('Location: ../login.html');
        }
        include_once('sidebar/sidebar.php');
        include_once('navigation/nav.php');
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">
            <h1>hello</h1>

            <div class="card shadow">
                <div class="card-header py-3" id="addcustomer">
                    <p class="text-primary m-0 fw-bold" id="addcustomer">customer Info
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" style="float:right;" id="addcustomer">Add customer</a>
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">

                    <!-- <div class="row justify-content-center"> -->
                        <!-- <div class="col-md-6"> -->

                          <form id="k">
                        <input type="text" class="test" name="arr" id="tes">
                        <button type="button" class="btn btn-primary" id="btn">Submit</button>
                          </form>

                        <!-- </div> -->
                    <!-- </div> -->
                </div>
                <script>
                    document.getElementById("btn").addEventListener("click", function() {
                       var code = document.createElement("input");
                          code.setAttribute("type", "text");
                            code.setAttribute("name", "arr");
                            code.class = "test";
                            code.id = "tes";
                            document.getElementById("k").appendChild(code);


                    });
                    </script>
            </div>
        </div>

    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
    <!-- <script src="../assets/js/javas.js"></script> -->
    <!-- <script src="../assets/js/ajax.js"></script> -->
    <script src="./js/rooms.js"></script>
</body>

</html>