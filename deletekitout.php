<?php
require 'db.php';
$kitid = $_GET['id'];
$meta = 'DELETE FROM `kitsout` WHERE kid='.$kitid;
$conn->query($meta);

?>