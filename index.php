<?php

    require_once 'config.php';

    $uname_val = $upass_val = "";
    $uname_cls = $upass_cls = "";
    $uname_fdk = $upass_fdk = "";
    
    $invalid = "";

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(empty($_POST['input_uname'])){
            $uname_cls = 'is-invalid';
            $uname_fdk = '<div class="invalid-feedback">Username is required!</div>';
        }else{
            $uname_val = $_POST['input_uname'];
        }

        if(empty($_POST['input_upass'])){
            $upass_cls = 'is-invalid';
            $upass_fdk = '<div class="invalid-feedback">Password is required!</div>';
        }else{
            $upass_val = $_POST['input_upass'];
        }

        if($uname_val && $upass_val){
            $username = $uname_val;
            $password = $upass_val;

            $q = mysqli_query($conn,'SELECT username,password FROM users WHERE username="'.$username.'" AND NOT is_deleted=true;') or die (mysqli_error($conn));
            $f = mysqli_fetch_array($q);
            $pass_vld = password_verify($password, $f['password']);
            if($pass_vld){
                $_SESSION['active_user_session'] = $uname_val;
                header('location:user/');
            }else{
                $invalid = '<div class="alert bg-danger text-light text-center alert-dismissable" role="alert"><button class="close" data-dismiss="alert">&times;</button>Invalid Username or Password!</div>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log-In</title>
    <link rel="stylesheet" href="assets/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="assets/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/popper.js/1.14.4/umd/popper.min.js"></script>
    <script src="assets/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: rgb(33, 37, 43);
            color: #ccc
        }
        hr{
            border: 1px solid #9e9e9e;
        }
        form{
            background-color:#282c34;
            padding: 20px;
            border: 1px solid #616161;
            border-radius: 5px;
            max-width: 450px;
            margin: 10% auto;
        }
        form input{
            background-color: transparent !important;
            color: #CCC !important;
            border: 1px solid #757575 !important;
        }
        form input:focus{
            box-shadow: unset !important;
            border-color: #ccc !important;
        }
    </style>
</head>
<body>
<div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" auto-complete="off">
            <h3 class="font-weight-bold">Log-In</h3>
            <hr>
            <?php echo $invalid;?>
            <div class="form-group">
                <label for="input_uname">Username</label>
                <input class="form-control  <?php echo $uname_cls;?>" type="text" name="input_uname" id="input_uname" value="<?php echo $uname_val;?>" autofocus>
                <?php echo $uname_fdk;?>
            </div>
            <div class="form-group">
                <label for="input_upass">Password</label>
                <input class="form-control <?php echo $upass_cls;?>" type="password" name="input_upass" id="input_upass" value="<?php echo $upass_val;?>">
                <?php echo $upass_fdk;?>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <a class="btn btn-link" href="signup.php">Create an account?</a>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Log-In</button>
                </div>
            </div>
        </form>
    </div> 
</body>
</html>