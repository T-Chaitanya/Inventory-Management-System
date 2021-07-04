<?php
require 'db.php';
$kname = $_POST['kname'];
$quanc = $_POST['quanc'];
$price = $_POST['price'];
$mess = $_POST['mess'];
$c=1;
$check = 'SELECT * FROM `kits` WHERE kname="'.$kname.'"';
$result = $conn->query($check);

if ($result->num_rows > 0) {
    $check = 'SELECT * FROM `kitsout` WHERE kname="'.$kname.'"';
    $result2 = $conn->query($check);
    if ($result2->num_rows > 0) {
        $c=0;
        header("location:index.php?error=kit");
    }else{
        $row = $result->fetch_assoc();
        $id = $row["kid"];
        $quanin = $row["components"];
        $sqlu ='UPDATE kits SET decl = '."'".$mess."'".', components = "'.$quanc.'" , price = '.$price.'  WHERE kname = "'.$kname.'"';
        $conn->query($sqlu);
        $sqlu ='TRUNCATE kit'.$id;
        $conn->query($sqlu);
       
        for ($i=0; $i < $quanc; $i++) { 
            if (isset($_POST['pname'.$i])) {
                $t = 'INSERT INTO kit'.$id.' (`name`,`quantity`,`tray`, `img`) VALUES ("'.$_POST['pname'.$i].'", "'.$_POST["quan".$i].'",(SELECT tray FROM main_inventory
            WHERE name="'.$_POST['pname'.$i].'"), (SELECT img FROM main_inventory
            WHERE name="'.$_POST['pname'.$i].'"))';
                $conn->query($t);
            
                echo $i."<br>".$t."<br>";
            }else{
                $quanc = $quanc+1;
            }
        }
    }
    

    }else{
        
    $meta = 'INSERT INTO `kits`(`kname`, `components`, `price`,`decl`) VALUES ("'.$kname.'",'.$quanc.','.$price.',"'.$mess.'")';
    $conn->query($meta);
    $id = 0;
    $temp = 'SELECT kid FROM `kits` ORDER BY kid DESC LIMIT 1';
    $result = $conn->query($temp);
    $row = $result->fetch_assoc();
    $id = $row['kid'];

    $createt = 'CREATE TABLE kit'.$id.' ( `sno` INT(100) NOT NULL AUTO_INCREMENT , `name` VARCHAR(1000) NOT NULL , `quantity` VARCHAR(1000) NOT NULL, `tray` VARCHAR(1000) NOT NULL ,`img` VARCHAR(1000) NOT NULL , PRIMARY KEY (`sno`)) ENGINE = InnoDB;';
    $conn->query($createt);


    for ($i=0; $i < $quanc; $i++) { 
        $t = 'INSERT INTO kit'.$id.'(`name`, `quantity`, `tray`, `img`) VALUES ("'.$_POST['pname'.$i].'","'.$_POST["quan".$i].'",(SELECT tray FROM main_inventory
        WHERE name="'.$_POST['pname'.$i].'"),(SELECT img FROM main_inventory
        WHERE name="'.$_POST['pname'.$i].'"))';
        $conn->query($t);
        
        
    }
}
$conn->close();
if ($c) {
    header("location:canCreate.php?kid=kit".$id);
}
?>