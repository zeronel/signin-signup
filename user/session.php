<?php

    require_once '../config.php';

    session_start();

    $s = $_SESSION['active_user_session'];
    $q = mysqli_query($conn, 'SELECT userid,username,password,firstname,lastname,birthdate,gender,address FROM users WHERE username="'.$s.'"') or die(mysqli_error($conn));
    $f = mysqli_fetch_array($q);

    if(!isset($_SESSION['active_user_session']) || empty($_SESSION['active_user_session'])){
        header('location: ../');
    }

?>