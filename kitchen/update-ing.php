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

        if (isset($_GET['update'])) {

            @$selectFoods = "SELECT * FROM `food` WHERE `food_id`='" . $_GET['update'] . "'";

            @$result = mysqli_query($conn, $selectFoods);
            @$row = mysqli_fetch_assoc($result);
        }
        ?>

        <!-- ---------------------- -->
        <div class="container-fluid" style="overflow: auto;">
            <div class="row" id="row">
                <h3 class="text-dark mb-4">Ingridents</h3>
            </div>
            <div class="card shadow">
                <div class="card-header py-3" id="addcustomer">
                    <p class="text-primary m-0 fw-bold" id="addcustomer">Edit food Info
                    <h1 id="demo"></h1>
                    </p>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <!-- food_id Primary	int(11)			No	None		AUTO_INCREMENT	Change Change	Drop Drop	
	2	food_name	varchar(255)	utf8mb4_general_ci		No	None			Change Change	Drop Drop	
	3	food_quntity	int(5)			No	None			Change Change	Drop Drop	
	4	food_weight	double			No	0			Change Change	Drop Drop	
	5	food_measurement	varchar(10)	utf8mb4_general_ci		Yes	NULL			Change Change	Drop Drop	
	6	food_unit_price	double			No	0			Change Change	Drop Drop	
	7	food_img	varchar(255)	utf8mb4_general_ci		Yes	NULL			Change Change	Drop Drop	
	8	food_description	text	utf8mb4_general_ci		Yes	NULL			Change Change	Drop Drop	
	9	food_resgister_date	datetime			No	current_timestamp()			Change Change	Drop Drop	
	10	food_total	double			No	0			Change Change	Drop Drop -->

                            <form action="update-ing.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="food_name">Food Name</label>
                                    <input type="text" class="form-control" id="food_name" name="food_name" value="<?php echo @$row['food_name']; ?> "readonly>

                                    <label for="food_quntity">Food Quntity</label>
                                    <input type="text"step="any" min="1" class="form-control" id="food_quntity" name="food_quntity" value="<?php echo @$row['food_quntity']; ?>" required>
                                    <label for="food_weight">Food total Weight</label>
                                    <input type="number" step="any" min="1" class="form-control" id="food_weight" name="food_weight" value="<?php echo @$row['food_weight']; ?>" required>
                                    <label for="food_measurement">Food Measurement</label>
                                    <input type="text" class="form-control" id="food_measurement" name="food_measurement" value="<?php echo @$row['food_measurement']; ?>" readonly>
                                    <label for="food_unit_price">Food Unit Price</label>
                                    <input type="text" step="any" min="1" class="form-control" id="food_unit_price" name="food_unit_price" value="<?php echo @$row['food_unit_price']; ?>" required>
                                    
                                    <label for="food_description">Food Description</label>
                                    <input type="text" class="form-control" id="food_description" name="food_description" value="<?php echo @$row['food_description']; ?>">
                                    <label for="food_total">Food Total</label>
                                    <input type="number" step="any" min="1" class="form-control" id="food_total" name="food_total" value="<?php echo @$row['food_total']; ?> "readonly>
                                    <input type="hidden" class="form-control" id="food_id" name="food_id" value="<?php echo @$row['food_id']; ?>">

                                </div>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                            </form>

                            <script>
                                //food quantity*food unit price = food total
                                //food quantity and food unit price must be only add number and qun and total must be accept only positive number more than 0
                               //if food quantity and food unit price is empty then food weight and food total will be empty
                                //if food quantity and food unit price is not empty then food weight and food total will be not empty

                                $(document).ready(function() {
                                    $('#food_quntity').keyup(function() {
                                        var food_quntity = $('#food_quntity').val();
                                        var food_unit_price = $('#food_unit_price').val();
                                        var food_weight = $('#food_weight').val();
                                        var food_total = $('#food_total').val();
                                        if (food_quntity == '' || food_unit_price == '') {
                                            $('#food_weight').val('');
                                            $('#food_total').val('');
                                        } else {
                                            // $('#food_weight').val(food_quntity * food_unit_price);
                                            $('#food_total').val(food_quntity * food_unit_price);
                                        }
                                    });
                                    $('#food_unit_price').keyup(function() {
                                        var food_quntity = $('#food_quntity').val();
                                        var food_unit_price = $('#food_unit_price').val();
                                        var food_weight = $('#food_weight').val();
                                        var food_total = $('#food_total').val();
                                        if (food_quntity == '' || food_unit_price == '') {
                                            $('#food_weight').val('');
                                            $('#food_total').val('');
                                        } else {
                                            // $('#food_weight').val(food_quntity * food_unit_price);
                                            $('#food_total').val(food_quntity * food_unit_price);
                                        }
                                    });
                                });
                                $(document).ready(function() {
                                    $('#food_quntity').keypress(function(e) {
                                        var a = [];
                                        var k = e.which;

                                        for (i = 48; i < 58; i++)
                                            a.push(i);

                                        if (!(a.indexOf(k) >= 0))
                                            e.preventDefault();
                                    });
                                    $('#food_unit_price').keypress(function(e) {
                                        var a = [];
                                        var k = e.which;

                                        for (i = 48; i < 58; i++)
                                            a.push(i);

                                        if (!(a.indexOf(k) >= 0))
                                            e.preventDefault();
                                    });
                                    $('#food_total').keypress(function(e) {
                                        var a = [];
                                        var k = e.which;

                                        for (i = 48; i < 58; i++)
                                            a.push(i);

                                        if (!(a.indexOf(k) >= 0))
                                            e.preventDefault();
                                    });
                                });
                                 
                                

                            </script>
                        </div>
                    </div>
<?php
                    //update data in database
                    if(isset($_POST['update'])){
                        $sql="UPDATE `food` SET `food_name`='".$_POST['food_name']."',`food_quntity`='".$_POST['food_quntity']."',`food_weight`='".$_POST['food_weight']."',`food_measurement`='".$_POST['food_measurement']."',`food_unit_price`='".$_POST['food_unit_price']."',`food_description`='".$_POST['food_description']."',`food_total`='".$_POST['food_total']."' WHERE `food_id`='".$_POST['food_id']."'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            echo "<script>
                            //sweet alert
                            swal.fire({
                                title: 'Data Updated Successfully',
                                icon: 'success',
                                button: 'Ok',                        
                            }).then(function() {
                                window.location.href = './edit-kitchen.php';
                            });
                            </script>";
                            
                        }else{
                            echo "<script>alert('Data Not Updated Successfully')</script>";
                            echo "<script>window.location.href='./edit-kitchen.php'</script>";
                        }
                    } 
                    ?>


                </div>
            </div>
        </div>





    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Admin 2023</span></div>
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