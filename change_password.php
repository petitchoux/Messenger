<!DOCTYPE html>
<?php
session_start();
include("include/connection.php");
include("include/header.php");

if(!isset($_SESSION['user_email'])) {
    header("location: signin.php");
} else {
?>

<html>
<head>
<title>Messenger | Change Password</title>
<meta charset="utf-8">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/profile_image.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>

<body>

<div class="row">
<div class="col-sm-2">
</div>

<div class="col-sm-8">

<form action="" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover">
<tr text-align="center">
<td colspan="6" class="active"><h2>Change Password</h2></td>
</tr>
<tr>
<td id="mypass" style="font-weight: bold;">Current Password</td>
<td><input type="password" name="current_pass" class="form-control" required placeholder="Current password"/></td>
</tr>

<tr>
<td id="mypass" style="font-weight: bold;">New Password</td>
<td><input type="password" name="u_pass1" class="form-control" required placeholder="New password"/></td>
</tr>

<tr>
<td id="mypass" style="font-weight: bold;">Confirm New Password</td>
<td><input type="password" name="u_pass2" class="form-control" required placeholder="Confirm password"/></td>
</tr>

<tr text-align="center">
<td colspan="6">
<input type="submit" name="change" value="Change" class="btn btn-info"/>
</td>

</tr>
</table>
</form>

<?php

if(isset($_POST['change'])){
    $c_pass = $_POST['current_pass'];
    $pass1 = $_POST['u_pass1'];
    $pass2 = $_POST['u_pass2'];

    $user = $_SESSION['user_email'];
    $get_user = "SELECT * FROM users WHERE user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_password = $row['user_pass'];

    if($c_pass !== $user_password){
        echo "
        <div class='alert alert-danger'><strong>Your old password didn't match.</strong></div>
        ";
    }

    if($pass1 !== $pass2){
        echo "
        <div class='alert alert-danger'><strong>Your new and confirmed password didn't match.</strong></div>
        ";
    }

    if($pass1 < 7 AND $pass2 < 7){
        echo "
        <div class='alert alert-danger'><strong>Your password must be 8 or more characters.</strong></div>
        ";
    }

    if($pass1 == $pass2 AND $c_pass == $user_password){
        $update_pass = mysqli_query($con, "UPDATE users SET user_pass='$pass1' WHERE user_email='$user'");
        echo "
        <div class='alert alert-danger'><strong>Your password has successfully been updated.</strong></div>
        ";
    }

}

?>

</div>

<div class="col-sm-2">
</div>

</div>

</body>
</html>

<?php } ?>