<?php
  require_once('..\..\dbConnection\connect.php');

  if(isset($_POST['value'])){
    $value = $_POST['value'];
 $sql = "SELECT * FROM food ";
 $result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) > 0) {
  $dependentOptions = array();
  $dependentOptionsnone = array();
  while ($row = mysqli_fetch_assoc($result)) {
      
      $dependentOptions[] = array("food_id" => $row["food_id"], "food_name" => $row["food_name"], "food_quntity" => $row["food_quntity"],  
      "food_weight" => $row["food_weight"], "food_measurement" => $row["food_measurement"],"food_unit_price" => $row["food_unit_price"],
      "food_img" => $row["food_img"],"food_description" => $row["food_description"],"food_resgister_date" => $row["food_resgister_date"],
      "food_total" => $row["food_total"]);
  }
  header("Content-Type: application/json");
echo json_encode($dependentOptions);
} else {
  $dependentOptionsnone[] = array("food_id" => "none", "food_name" => "No Foods");
  header("Content-Type: application/json");
  echo json_encode($dependentOptionsnone);
}
}

if(isset($_POST['check'])){
  $MessureValue = $_POST['check'];
  // $dependentMessure = array();
  $sqls ="SELECT * FROM food WHERE food_id = $MessureValue";
  $results = mysqli_query($conn, $sqls);
  if (mysqli_num_rows($results) > 0) {
    $MdependentOptions = array();
    $MdependentOptionsNones = array();
    while ($row = mysqli_fetch_assoc($results)) {
        
        $dependentOptions[] = array("food_id" => $row["food_id"], "food_name" => $row["food_name"], "food_quntity" => $row["food_quntity"],  
        "food_weight" => $row["food_weight"], "food_measurement" => $row["food_measurement"],"food_unit_price" => $row["food_unit_price"],
        "food_img" => $row["food_img"],"food_description" => $row["food_description"],"food_resgister_date" => $row["food_resgister_date"],
        "food_total" => $row["food_total"]);
    }
    header("Content-Type: application/json");
  echo json_encode($dependentOptions);
  } else {
    $dependentOptionsNones[] = array("food_id" => "none", "food_name" => "No Foods");
    header("Content-Type: application/json");
    echo json_encode($dependentOptioNsnones);
  }
}


?>
 