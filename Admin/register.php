<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Admin</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">

      <?php
      session_start();
      if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
      
        header('Location: ../login.html');
      
      }

     include_once('sidebar/sidebar.php');
     include_once('navigation/nav.php');
 
     ?>

        <div class="container-fluid">
            <!-- <div class="card shadow"> -->
                <h3>Team</h3>
            <!-- </div> -->
        </div>
    </div>
</body>

</html>