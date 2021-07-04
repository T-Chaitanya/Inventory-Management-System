<?php
register_shutdown_function( "fatal_handler" );

function fatal_handler() {
    echo "fatal";
    #header("location: index.php?error=1");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$user = $_POST['uid'];
$pas = md5($_POST['pas']);
$con = new mysqli($servername, $username, $password, $dbname);
$sqlq = "SELECT * FROM users WHERE id='$user' and pas='$pas'";
echo $sqlq;
$result = $con->query($sqlq);
$row = $result->fetch_assoc();
$chk = $_POST['login'];

$con->close();
if($chk == 'true'){
        if($result->num_rows==0){
            echo "error";
            header("location: index.php?error=1");
        }else{
            setcookie('user',$row["name"],time() + (86400 * 5), "/");
            setcookie('pass',$row["pas"],time() + (86400 * 5), "/");
            session_start();
            $_SESSION['user'] = $row["name"];
            $_SESSION['pass'] = $row["pas"];
            header("location: ../");
        }
    }else{
    echo "noo";
    header("location: index.php?error=1");
}


?>

