<?php
    
    require 'db.php';
    if (isset($_POST['pname'])) {
        $n=false;
        if (isset($_POST['pid'])) {
            $pid = $_POST['pid'];
            $sql = 'SELECT * from `main_inventory` WHERE pid = '.$pid;
            
            $result = $conn->query($sql);
            $n = $result->num_rows > 0;
            if ($n!=0) {
                $row = $result->fetch_assoc();
            }
        }
        $name = $_POST['pname'];
        $quan = $_POST['quan'];
        $price = $_POST['price'];
        $log = $_POST['log'];
        $tray = $_POST['tray'];

        if (isset($_POST['add'])) {//for add/edit
            
            if ($_POST['editf']=="true") {//edit
                $img = $_POST['image'];
                
                if ($_POST['image']!="") {
                    $folderPath = "upload/";
        
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
        
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid() . '.jpg';
        
                    $file = $folderPath . $fileName;
                    file_put_contents($file, $image_base64);
                    $path = $_SERVER['DOCUMENT_ROOT']."/is/".$row["img"];
                    $sqlu = 'UPDATE main_inventory SET img ="upload/'.$img = $fileName.'", name = "'.$name.'", tray = "'.$tray.'", quantity = '.$quan.', log = "'.$log.'" , price = '.$price.'  WHERE pid = '.$pid;
                    echo 1;

                    echo "<br>+++".$img."<br>--".$path;
                    unlink($path);
                } else {
                    $sqlu = 'UPDATE main_inventory SET name = "'.$name.'", tray = "'.$tray.'", quantity = '.$quan.', log = "'.$log.'" , price = '.$price.'  WHERE pid = '.$pid;
                }
            } elseif ($n) {
                $sqlu = 'UPDATE main_inventory SET price = ROUND(((price * quantity)+('.$price*$quan.'))/(quantity+'.$quan.'), 2), quantity = quantity + '.$quan.', log = "'.$log.'"   WHERE pid = '.$pid;
            } else {
                if ($_POST['image']!="") {
                    $img = $_POST['image'];
                    $folderPath = "upload/";
        
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
        
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid() . '.jpg';
        
                    $file = $folderPath . $fileName;
                    file_put_contents($file, $image_base64);
                    $sqlu = 'INSERT INTO `main_inventory`(`name`, `quantity`, `price`, `log`, `tray`, `img`) VALUES ("'.$name.'","'.$quan.'","'.$price.'","'.$log.'","'.$tray.'","upload/'.$fileName.'")';
                } else {
                    $sqlu = 'INSERT INTO `main_inventory`(`name`, `quantity`, `price`, `log`, `tray`) VALUES ("'.$name.'","'.$quan.'","'.$price.'","'.$log.'","'.$tray.'")';
                }
            }
        } elseif (isset($_POST['remove'])) {
            if ($_POST['editf']=="true") {
                $sqlu = 'DELETE FROM `main_inventory` where pid='.$pid;
                $path = $_SERVER['DOCUMENT_ROOT']."/is/".$row["img"];
                unlink($path);
            } else {
                echo 3;
                $sqlu = 'UPDATE main_inventory SET quantity = quantity - '.$quan.', log = "'.$log.'"  WHERE pid = '.$pid;
            }
        }
        $conn->query($sqlu);
        $conn->close();
    }
    echo $_POST['editf']." done";
    //header('location:index.php');
