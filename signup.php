<?php

    require_once 'config.php';

    $uname_val = $upass_val = $fname_val = $lname_val = $bdate_val = $gendr_val = $addrs_val = '';
    $uname_cls = $upass_cls = $fname_cls = $lname_cls = $bdate_cls = $gendr_cls = $addrs_cls = '';
    $uname_fdk = $upass_fdk = $fname_fdk = $lname_fdk = $bdate_fdk = $gendr_fdk = $addrs_fdk = '';

    function testThis($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        #Username
        if(empty($_POST['input_uname'])){
            $uname_cls = 'is-invalid';
            $uname_fdk = '<div class="invalid-feedback">Username is required!</div>';
        }if(mysqli_num_rows(mysqli_query($conn,'SELECT username FROM users WHERE username="'.$_POST['input_uname'].'"')) > 0) {
            $uname_cls = 'is-invalid';
            $uname_fdk = '<div class="invalid-feedback">'.$_POST['input_uname'].' is already taken</div>';
        }else{
            $uname_val = testThis($_POST['input_uname']);
        }
        #Password
        if(empty($_POST['input_upass'])){
            $upass_cls = 'is-invalid';
            $upass_fdk = '<div class="invalid-feedback">Password is required!</div>';
        }else{
            $upass_val = testThis($_POST['input_upass']);
            //$_PASS = testThis($_POST['input_upass']);
        }
        #Firstname
        if(empty($_POST['input_fname'])){
            $fname_cls = 'is-invalid';
            $fname_fdk = '<div class="invalid-feedback">Firstname is required!</div>';
        }else{
            $fname_val = testThis($_POST['input_fname']);
        }
        #Lastname
        if(empty($_POST['input_lname'])){
            $lname_cls = 'is-invalid';
            $lname_fdk = '<div class="invalid-feedback">Lastname is required!</div>';
        }else{
            $lname_val = testThis($_POST['input_lname']);
        }
        #Birthdate
        if(empty($_POST['input_bdate'])){
            $bdate_cls = 'is-invalid';
            $bdate_fdk = '<div class="invalid-feedback">Birthdate is required!</div>';
        }else{
            $bdate_val = testThis($_POST['input_bdate']);
        }
        #Gender
        if(empty($_POST['input_gendr'])){
            $gendr_cls = 'is-invalid';
            $gendr_fdk = '<div class="invalid-feedback">Gender is required!</div>';
        }else{
            $gendr_val = testThis($_POST['input_gendr']);
        }
        #Address
        if(empty($_POST['input_addrs'])){
            $addrs_cls = 'is-invalid';
            $addrs_fdk = '<div class="invalid-feedback">Address is required!</div>';
        }else{
            $addrs_val = testThis($_POST['input_addrs']);
        }

        if($uname_val && $upass_val && $fname_val && $lname_val && $bdate_val && $gendr_val && $addrs_val){

            $stmt = $conn->prepare('INSERT INTO users(username,password,firstname,lastname,birthdate,gender,address)VALUES(?,?,?,?,?,?,?);') or die(mysqli_error($conn));
            $stmt->bind_param('sssssss', $uname,$upass,$fname,$lname,$bdate,$gendr,$addrs);
            
            $uname = $uname_val;
            $upass = crypt($upass_val, '$6$rounds=5000$dea45120h818a122e5algorithm$');
            $fname = $fname_val;
            $lname = $lname_val;
            $bdate = $bdate_val;
            $gendr = $gendr_val;
            $addrs = $addrs_val;

            $stmt->execute();
            $stmt->close();
            $conn->close();
            
            header('Location:./');
        }
        //mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/_eye.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="assets/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/popper.js/1.14.4/umd/popper.min.js"></script>
    <script src="assets/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title>Sign-Up</title>
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
            margin: 4% auto;
        }
        form input, form select, option{
            background-color: transparent !important;
            color: #CCC !important;
            border: 1px solid #757575 !important;
        }
        form select option{
            background-color: rgb(33, 37, 43) !important;
            
        }
        form input:focus, form select:focus{
            box-shadow: unset !important;
            border-color: #ccc !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"  auto-complete="off">
            <h3>Sign-Up</h3>
            <hr>
            <div class="form-group">
                <label for="input_uname">Username</label>
                <input class="form-control <?php echo $uname_cls;?>" type="text" name="input_uname" id="input_uname" value="<?php echo $uname_val;?>" autofocus>
                <?php echo $uname_fdk;?>
            </div>
            <div class="form-group">
                <label for="input_upass">Password</label>
                <input class="form-control <?php echo $upass_cls;?>" type="password" name="input_upass" id="input_upass" value="">
                <?php echo $upass_fdk;?>
            </div>
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input_fname">Firstname</label>
                        <input class="form-control <?php echo $fname_cls;?>" type="text" name="input_fname" id="input_fname" value="<?php echo $fname_val;?>">
                        <?php echo $fname_fdk;?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input_lname">Lastname</label>
                        <input class="form-control <?php echo $lname_cls;?>" type="text" name="input_lname" id="input_lname" value="<?php echo $lname_val;?>">
                        <?php echo $lname_fdk;?>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input_bdate">Birthdate</label>
                        <input class="form-control <?php echo $bdate_cls;?>" type="date" name="input_bdate" id="input_bdate" value="<?php echo $bdate_val;?>">
                        <?php echo $bdate_fdk;?>
                    </div>        
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input_gendr">Gender</label>
                        <select class="form-control <?php echo $gendr_cls;?>" name="input_gendr" id="input_gendr">
                            <option value="">Choose Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <?php echo $gendr_fdk;?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input_addrs">Address</label>
                <input class="form-control <?php echo $addrs_cls;?>" type="text" name="input_addrs" id="input_addrs" value="<?php echo $addrs_val;?>">
                <?php echo $addrs_fdk;?>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <a class="btn btn-link" href="./">Already have an account?</a>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" type="submit">Sign-Up</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
