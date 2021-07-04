<?php 
require 'db.php';

$name =$_GET['name'];
$sqlu = 'SELECT * FROM `main_inventory` WHERE name="'.$name.'"';

$result = $conn->query($sqlu);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = [ 'pid' => $row["pid"], 'pri' =>  $row["price"], 'com' => $row["log"], 'tray' => $row["tray"] , 'quan' =>$row["quantity"], 'im' =>$row["img"] ];
    
}else{
    $data = [];
}

    
    

header('Content-type: application/json');
echo json_encode( $data );

?>