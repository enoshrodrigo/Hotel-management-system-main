<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Staff - Admin</title>
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-add.min.css"> -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/vanilacss.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <!-- <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <script src="https://kit.fontawesome.com/c480a67077.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'hotel');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST['admin_login']) || isset($_POST['kitchen_login'])) {

    // Get the user input
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Prepare the SQL query
    if (isset($_POST['admin_login'])) {
        //bind param

        $query = "SELECT * FROM admins WHERE username=? AND password=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //bind parameters
        
    } else {
        
        $query = "SELECT * FROM kitchens WHERE username=? AND password=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

    }

    // Execute the query
    // $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {

        // Check if the user exists
        if (mysqli_num_rows($result) == 1) {

            // Set session variables and redirect  
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            if (isset($_POST['admin_login'])) {
                header('Location: ./Admin/index.php');
            } else {
                header('Location: ./kitchen/orders.php');
            }

        } else {

            
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid username or password!',
                footer: '<a href=\"./login.html\">Try again</a>'
              })
            </script>";

        }

    } else {

        // Query failed, show an error message
        echo "Error: " . mysqli_error($conn);

    }

    // Close the database connection
    mysqli_close($conn);
}
?>
</body>
</html>
