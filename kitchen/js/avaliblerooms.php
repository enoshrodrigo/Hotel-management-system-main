<?php
require_once('..\..\dbConnection\connect.php');

header("Content-Type: application/json");
if(isset($_POST['value'])){
  $value = $_POST['value'];
  $sql = "SELECT * FROM roomdetail WHERE roomtype='$value' AND status=1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $dependentOptions = array();
    $dependentOptionsnone = array();
    while ($row = mysqli_fetch_assoc($result)) {
        
        $dependentOptions[] = array("value" => $row["roomnumid"], "text" => $row["roomnumid"], "price" => $row["price"],  "roomtype" => $row["roomtype"], "roomstatus" => $row["status"],
        "roomac" => $row["ac"],"roomtv" => $row["tv"],"roomwifi" => $row["wifi"],"roomfridge" => $row["fridge"],"roomkitchen" => $row["kitchen"]
    ,"roomfloor" => $row["roomfloor"],"roomview" => $row["roomview"]);
    }
    header("Content-Type: application/json");
  echo json_encode($dependentOptions);
  } else {
    $dependentOptionsnone[] = array("value" => "none", "text" => "No Rooms Available");
    header("Content-Type: application/json");
    echo json_encode($dependentOptionsnone);
  }
}

?>