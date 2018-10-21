<?php 

    DEFINE('hostname','localhost');
    DEFINE('username','root');
    DEFINE('password','');
    DEFINE('database','signin_signup');

    $conn = mysqli_connect(hostname,username,password,database);
    if(!$conn){
        die('Database Connection Failed! ' . mysqli_connect_error());
    }

?>