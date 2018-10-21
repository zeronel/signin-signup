<?php 

    require 'session.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $f['firstname'].' '.$f['lastname'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="../assets/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/popper.js/1.14.4/umd/popper.min.js"></script>
    <script src="../assets/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: rgb(33, 37, 43);
            color: #ccc
        }
        .container{
            padding:15%;
        }
        .btnG{
            margin-top:4%;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Welcome <?php echo $f['username'];?></h1>
        <div class="btnG">
            <a class="btn btn-sm btn-danger" href="logout.php">Log-Out</a>
        </div>
    </div>
</body>
</html>