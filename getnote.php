<?php
require 'db.php';
$kid = $_GET['id'];
if(isset($_GET['data'])){
    $sql = 'UPDATE kitsout SET log="'.$_GET['data'].'" where kid='.$kid;
    $conn->query($sql);
    echo $sql;
}else{
    $sql = "SELECT log FROM kitsout where kid=".$kid;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$res = '<textarea rows="8" name="logl" class="form-control" id="logl" autofill="off"
                                            placeholder="log">'.$row['log'].'</textarea>
                                            <center><button type="button" onClick="sendNote('.$kid.')" rel="tooltip" class="btn btn-rose">
                <i class="material-icons">check</i>&nbsp;OK
            </button></center>';

echo $res;
}




?>