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
<title>Messenger | Profile Image</title>
<meta charset="utf-8">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/profile_image.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>

<body>

<?php 

$user = $_SESSION['user_email'];
$get_user = "SELECT * FROM users WHERE user_email='$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_name = $row['user_name'];
$user_profile = $row['user_profile'];

echo "
<div class='card'>
    <img src='$user_profile'>
    <h1>$user_name</h1>
    <form method='post' enctype='multipart/form-data'>
    <label id='update_profile'><i class='fa fa-circle-o' aria-hidden='true'></i>Select Image
    <input type='file' name='u_image' size='60'></label>
    <button id='button_profile' name='update'>&nbsp&nbsp&nbsp<i class='fa fa-heart' aria-hidden='true'></i>Update Image</button>
    </form>
    </div><br><br>
";

if(isset($_POST['update'])){
    $u_image = $_FILES['u_image']['name'];
    $image_tmp = $_FILES['u_image']['tmp_name'];
    $random_number = rand(1,100);

    if($u_image == ''){
        echo "<script>alert('You must select an image to be uploaded.')</script>";
        echo "<script>window.open('upload.php','_self')</script>";
        exit();
    } else {
        move_uploaded_file($image_tmp, "images/$u_image.$random_number");

        $update = "UPDATE users SET user_profile = 'images/$u_image.$random_number' WHERE user_email = '$user'";

        $run = mysqli_query($con, $update);

        if($run){
            echo "<script>alert('Successful Upload')</script>";
            echo "<script>window.open('upload.php','_self')</script>";
        }
    }
}

?>


</body>
</html>

<?php } ?>