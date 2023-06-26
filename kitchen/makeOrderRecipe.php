<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Kitchen - Admin</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <?php
    require_once('../dbConnection/connect.php');
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen')
        {
        
            header('Location: ../login.html');
        }


    if (isset($_POST['makeOrder'])) {
        $roomNo = $_POST['roomNo'];
        $recipeID = $_POST['recipeName'];
        $order = "INSERT INTO `placedorder`(`order_roomnumid`, `order_recipe_id`, `order_status`) VALUES ($roomNo,$recipeID,0)";
        $result = mysqli_query($conn, $order);
        if ($result) {
            echo "<script>Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Order Added',
                                showConfirmButton: false,
                                timer: 1500
                              })</script>";
        } else {
            echo "<script>Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Order Not Added',
                                showConfirmButton: false,
                                timer: 1500
                              })</script>";
        }
    }
    ?>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <s-cript src="../assets/js/bs-init.js"></script>
        <script src="../assets/js/theme.js"></script>
</body>

</html>