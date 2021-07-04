<?php 
require 'db.php';

$quanr = $_GET["quan"];
$kid = $_GET['kid'];

$sqlu = 'SELECT quantity from kitsout where kid='.$kid;
$result = $conn->query($sqlu);
$row = $result->fetch_assoc();
if($row['quantity']>=$quanr){
echo '{
    "resp": "OK ",
    "ok":1
  }';
}else{
    echo '{
        "resp": "Not enough kits out of inventory",
        "ok":0
      }';

}
$conn->close();
?>