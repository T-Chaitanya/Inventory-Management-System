<?php
    session_start();
    $npass = $_POST['cpwdn'];
    $nepass = md5($npass);
    $rol = $_SESSION['rno'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
    $con = new mysqli($servername, $username, $password, $dbname);
    $sqlq = "UPDATE users SET pas='$nepass' WHERE roll='$rol'";
    if(isset($_POST['cpwd'])){ 
        $con->query($sqlq);
        $_SESSION['pass'] = $nepass;
    }else{
        header('Location: ../index.php?e');
    }
    header('Location: ../index.php?s');
?>