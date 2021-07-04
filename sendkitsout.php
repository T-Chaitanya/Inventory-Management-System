<?php
$id = $_GET['id'];
$quan = $_GET['quan'];
require 'db.php';
$sqlu = 'UPDATE kits set quantity=quantity-'.$quan.' where kid='.$id;
$conn->query($sqlu);

$sqlu = 'update main_inventory mi,
kit'.$id.' k
set mi.quantity = mi.quantity - k.quantity*'.$quan.'
where mi.name = k.name';
$conn->query($sqlu);

$sqlu = 'select * from kitsout where kid='.$id;
$result = $conn->query($sqlu);
        if ($result->num_rows > 0){
            $sqlu = 'UPDATE kitsout set quantity=quantity+'.$quan.' where kid='.$id;
            $conn->query($sqlu);
        }else{
            $sqlu = 'INSERT INTO kitsout (kid, kname, price,components)
            SELECT kid, kname, price,components
            FROM kits
            WHERE kid='.$id.';';
            $conn->query($sqlu);
            $sqlu = 'UPDATE kitsout set quantity='.$quan.' where kid='.$id;
            $conn->query($sqlu);
            echo $sqlu;
            
        }

$conn->close();


?>