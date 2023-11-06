<?php
    session_start();
    unset($_SESSION['user_login']);
    session_destroy();
    setcookie('user_login','',time(),'/');
    header("location: index.php");
?>