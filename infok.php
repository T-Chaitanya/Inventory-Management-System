<?php 
require 'db.php';

$id =$_GET['id'];
$sqlu = 'SELECT * FROM `kits` WHERE kid="'.$id.'"';

$result = $conn->query($sqlu);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = [ 'kname' => $row["kname"], 'pri' =>  $row["price"], 'com' => $row["components"],  'quan' =>$row["quantity"] ];
    
}else{
    $data = [];
}

    
    

header('Content-type: application/json');
echo json_encode( $data );

?>