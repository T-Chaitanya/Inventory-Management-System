<?php
require 'db.php';

$quan = 0;
$a = 1;
if (isset($_GET['kid'])){
    $kid = $_GET['kid'];
    //$req = $_GET['req'];
$sqlu = 'DROP VIEW IF EXISTS `is`.`nf`;DROP TABLE IF EXISTS `is`.`nn`,`is`.`tinv`;';
$conn->query($sqlu);
$sqlu = 'create table IF NOT EXISTS tinv select name,quantity from main_inventory';
$conn->query($sqlu);
$sqlu = 'create table IF NOT EXISTS nn as SELECT name as na,((SELECT quantity from tinv where name=na) - quantity) as nq FROM '.$kid.'';
$conn->query($sqlu);
$sqlu = 'create view IF NOT EXISTS nf as (SELECT * FROM `nn` WHERE nq<0)';
$conn->query($sqlu);

while ($a) {

    $sqlu = 'SELECT * FROM nf';
    $result = $conn->query($sqlu);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "error add ".$row['na']."---".$row['nq'];
        }
        $a=0;
    }else{
        $quan +=1;
        $sqlu = 'update tinv set quantity=(select nq from nn where na=name)';
        $conn->query($sqlu);
        $sqlu = 'UPDATE `nn` SET `nq`= ( (SELECT quantity from tinv where name=na) - (select quantity from '.$kid.' where name=na )) WHERE 1';
        $conn->query($sqlu);
    }

    
}
echo $quan;

$sqlu='DROP VIEW IF EXISTS `is`.`nf`;';
$conn->query($sqlu); 
$sqlu='DROP TABLE IF EXISTS `is`.`nn`;';
$conn->query($sqlu);
$sqlu='DROP TABLE IF EXISTS `is`.`tinv`;';
$conn->query($sqlu);
$sqlu='UPDATE kits SET quantity ="'.$quan.'" where kid="'.explode("kit",$kid)[1].'"';
//echo $sqlu;
$conn->query($sqlu);
$conn->close();

}
header("location:index.php")
?>

