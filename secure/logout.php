<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    session_destroy();
    setcookie('user','', time()-1, "/");
    setcookie('roll','',time()-1, "/");
    setcookie('pass','',time()-1, "/");
    header('Location: index.php');

?>