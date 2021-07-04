<?php
require 'db.php';
$sqlu = 'SELECT `name` FROM `main_inventory`';
$res = '<script> var comp = [';
$result = $conn->query($sqlu);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $res .= '"'.$row["name"].'",';
  }
}



echo $res."];</script>";


?>
