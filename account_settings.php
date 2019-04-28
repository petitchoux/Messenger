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
<title>Messenger | Settings</title>
<meta charset="utf-8">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/find_people.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>

<div class="row">

<div class="col-sm-2">
</div>

<?php

$user = $_SESSION['user_email'];
$get_user = "SELECT * FROM users WHERE user_email='$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_name = $row['user_name'];
$user_pass = $row['user_pass'];
$user_email = $row['user_email'];
$user_profile = $row['user_profile'];

?>

<div class="col-sm-8">
<form action="" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover">
<tr text-align="center">
<td colspan="6" class="active"><h2>Account Settings</h2></td>
</tr>
<tr>
<td style="font-weight: bold;">Change Username</td>
<td><input type="text" name="u_name" class="form-control" required value="<?php echo $user_name; ?>"/></td>
</tr>
<tr>
<td>
</td>
<td>
<a class="btn btn-default" style="text-decoration: none; font-size: 15px;" href="upload.php">
<i class="fa fa-user" aria-hidden="true"></i>Change Profile Image</a>
</td>
</tr>

<tr>
<td style="font-weight: bold;">Change Email</td>
<td><input type="email" name="u_email" class="form-control" required value="<?php echo $user_email; ?>"/></td>
</tr>

<tr>
<td stlye="font-weight: bold;">Forgotten Password</td>
<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Forgotten Password</button>
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">x</button>
</div>
<div class="modal-body">
<form action="recovery.php?id=<?php echo $user_id; ?>" method="post" id="f">
<strong>What is the name of your hometown?</strong>
<textarea class="form-control" cols="83" rows="4" name="content" placeholder="Write your answer here..."></textarea><br>
<input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
<pre>The above is a security question that will be asked if you forget your <br> Password.</pre><br><br>
</form>
<?php 

if(isset($_POST['sub'])) {
    $security_answer = htmlentities($_POST['content']);
    if($security_answer == '') {
        echo "<script>alert('Answer cannot be blank')</script>";
        echo "<script>window.open('account_settings.php', '_self')</script>";
        exit();
    } else {
        $update = "UPDATE users SET forgotten_answer='$security_answer' WHERE user_email = '$user'";
        $run = mysqli_query($con, $update);

        if ($run){
            echo "<script>alert('Working...')</script>";
            echo "<script>window.open('account_settings.php', '_self')</script>";
        } else {
            echo "<script>alert('Error while updating information')</script>";
            echo "<script>window.open('account_settings.php', '_self')</script>";
        
        }
    }
}

?>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close
</button>
</div>
</div>
</div>
</div>

</tr>
<tr><td></td><td><a href="change_password.php" class="btn btn-default" style="text-decoration: none; font-size: 15px;"><i class="f fa-key fa-fw" aria-hidden="true"></i>Change Password</td>
</tr>

<tr text-align="center">
<td colspan="6">
<input type="submit" value="Update" name="update" class="btn btn-info">
</td>
</tr>
</table>
</form>

<?php

if(isset($_POST['update'])){
    $user_name = htmlentities($_POST['u_name']);
    $email = htmlentities($_POST['u_email']);
    $update = "UPDATE users SET user_name = '$user_name', user_email = '$email' WHERE user_email = '$user'";

    $run = mysqli_query($con, $update);

    if($run) {
        echo "<script>window.open('account_settings.php', '_self')</script>";
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