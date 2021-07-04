<?php
require 'db.php';
$kitid = $_GET['id'];
$meta = 'DELETE FROM `kits` WHERE kid='.$kitid.'';
$conn->query($meta);
$meta = 'DROP TABLE kit'.$kitid;
$conn->query($meta);

?>