<?php
require_once('../dbConnection/connect.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'kitchen')
{
    header('Location: ../login.html');
}

if (isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id'];
    $sql = "DELETE FROM recipe WHERE recipe_id = '$recipe_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )</script>";
    } else {
        echo "<script>Swal.fire(
            'Error!',
            'Your file has not been deleted.',
            'error'
          )</script>";
    }
}


?>