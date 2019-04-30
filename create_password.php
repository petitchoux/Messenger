<!DOCTYPE html>
<html>
<head>
<title>Messenger | Create Password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/signin.css">
</head>
<body>
<div class="signin-form">
<form action="" method="post">
<div class="form-header">
<h2>Create a New Password</h2>
<p>Messenger</p>
</div>
<div class="form-group">
<label>Enter a New Password</label>
<input type="password" class="form-control" name="pass1" placeholder="Password" autocomplete="off" required>
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" class="form-control" name="pass2" placeholder="Password" autocomplete="off" required>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-lg" name="change">Submit</button>
</div>
</form>
</div>
<?php

session_start();

include("include/connection.php");

if(isset($_POST['change'])){
    $user = $_SESSION['user_email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if($pass1 !== $pass2){
        echo "
        <div class='alert alert-danger'><strong>Your new and confirmed password didn't match.</strong></div>
        ";
    }

    if(strlen($pass1) < 7){
        echo "
        <div class='alert alert-danger'><strong>Your password must be 8 or more characters.</strong></div>
        ";
    }

    if($pass 1==$pass2 AND strlen($pass1) > 7){
        $update_pass = mysqli_query($con, "UPDATE users SET user_pass='$pass1' WHERE user_email='$user'");
        session_destroy();
        echo "<script>alert('Please login with your new password.')</script>";
        echo "<script>window.open('signin.php', '_self')</script>";
    
    }
}

?>
</body>
</html>