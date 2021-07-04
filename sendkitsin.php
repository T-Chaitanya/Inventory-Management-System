<?php
$id = $_GET['id'];
$quan = $_GET['quan'];
require 'db.php';
$sqlu = 'UPDATE kits set quantity=quantity+'.$quan.' where kid='.$id;
$conn->query($sqlu);
$sqlu = 'UPDATE kitsout set quantity=quantity-'.$quan.' where kid='.$id;
$conn->query($sqlu);

$sqlu = 'update main_inventory mi,
kit'.$id.' k
set mi.quantity = mi.quantity + k.quantity*'.$quan.'
where mi.name = k.name';
$conn->query($sqlu);

$sqlu = 'select quantity from kitsout where kid='.$id;
$result = $conn->query($sqlu);

$row = $result->fetch_assoc();
        if ($row['quantity'] == 0) {
            $sqlu = 'DELETE from kitsout where kid='.$id;
            $conn->query($sqlu);
        }

$conn->close();


?>