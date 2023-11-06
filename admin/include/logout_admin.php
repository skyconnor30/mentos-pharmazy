<?php
    session_start();
    unset($_SESSION['admin_login']);
    session_destroy();
    setcookie('admin_login','',time(),'/');
    header("location: ../../index.php");
?>