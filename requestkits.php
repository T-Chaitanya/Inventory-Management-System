<?php 
require 'db.php';

$quanr = $_GET["quan"];
$kid = $_GET['kid'];

$sqlu = 'SELECT quantity from kits where kid="'.$kid.'"';
$result = $conn->query($sqlu);
$row = $result->fetch_assoc();
if($row['quantity']>=$quanr){
echo '{
    "resp": "OK ",
    "ok":1
  }';
}else{
        
    $quan = 0;
    $a = 1;
    $temp ="";


    $sqlu = 'create table IF NOT EXISTS tinv select name,quantity from main_inventory';
    $conn->query($sqlu);
    $sqlu = 'create table IF NOT EXISTS nn as SELECT name as na,((SELECT quantity from tinv where name=na) - quantity*'.$quanr.') as nq FROM kit'.$kid;
    $conn->query($sqlu);
    $sqlu = 'create view IF NOT EXISTS nf as (SELECT * FROM `nn` WHERE nq<0)';
    $conn->query($sqlu);

    while ($a) {

        $sqlu = 'SELECT * FROM nf';
        $result = $conn->query($sqlu);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $temp .='<tr><td>'.$row['na'].'</td><td>'.$row['nq'].'</td></tr>';
            }
            $a=0;
        }else{
            $quan +=1;
            $sqlu = 'update tinv set quantity=(select nq from nn where na=name)';
        $conn->query($sqlu);
        $sqlu = 'UPDATE `nn` SET `nq`= ( (SELECT quantity from tinv where name=na) - (select quantity from kit'.$kid.' where name=na )) WHERE 1';
        $conn->query($sqlu);
        }
        
    }
    //echo $quan;
    $sqlu='DROP VIEW IF EXISTS `is`.`nf`;';
    $conn->query($sqlu); 
    $sqlu='DROP TABLE IF EXISTS `is`.`nn`;';
    $conn->query($sqlu);
    $sqlu='DROP TABLE IF EXISTS `is`.`tinv`;';
    $conn->query($sqlu);
    $conn->close();








    echo '{
        "resp": "<table class=sol>'.$temp.'</table>",
        "sol": "",
        "ok":0
      }';
}
?>