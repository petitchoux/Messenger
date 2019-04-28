<!DOCTYPE html>
<?php
session_start();
include("find_friends_function.php");

if(!isset($_SESSION['user_email'])) {
    header("location: signin.php");
} else {
?>

<html>
<head>
<title>Messenger | Search</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/find_people.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<a class="navbar-brand" href="#">
<?php
$user = $_SESSION['user_email'];
$get_user = "SELECT * FROM users WHERE user_email = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_name = $row['user_name'];
echo "<a class='navbar-brand' href='../home.php?user_name=$user_name'>Messenger</a>";
?>

<ul class="navbar-nav">
<li><a style="color: white; text-decoration: none; font-size: 20px;" href="../acount_settings.php">Settings</a></li>
</ul>

</nav><br>

<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<form class="search_form" action="">
<input type="text" name="search_query" placeholder="Search Friends" autocomplete="off" required>
<button class="btn" type="submit" name="search_btn">Search</button>
</form>
</div>
<div class="col-sm-4">
</div>
</div><br><br>
<?php search_user(); ?>
</body>
</html>
<?php } ?>