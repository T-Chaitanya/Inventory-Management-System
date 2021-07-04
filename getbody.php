<?php
require 'db.php';
$kname = $_GET['kname'];
$check = 'SELECT decl FROM `kits` WHERE kname="'.$kname.'"';
$result = $conn->query($check);
$row = $result->fetch_assoc();
if ($result->num_rows > 0) {
    $body = $row['decl'];
    echo $body;
}
?>