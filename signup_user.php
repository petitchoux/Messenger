<?php 

include("include/connection.php");

    if(isset($_POST['sign_up'])){
        $name = htmlentities(mysqli_real_escape_string($con, $_POST['user_name']));
        $pass = htmlentities(mysqli_real_escape_string($con, $_POST['user_pass']));
        $email = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
        $rand = rand(1,2);

        if($name == ''){
            echo"<script>alert('Please enter a name')</script>";
        }
        if(strlen($pass)<8){
            echo"<script>alert('Password should be a minimum of 8 characters')</script>";
            exit();
        }

        $check_email = "SELECT * FROM users WHERE user_email='$email'";
        $run_email = mysqli_query($con, $check_email);

        $check = mysqli_num_rows($run_email);

        if($check==1){
            echo"<script>alert('Email is already in use')</script>";
            echo"<script>window.open('signup.php', '_self')</script>";
            exit();
        }

        if($rand == 1)
            $profile_pic = "images/profilepic1.jpg";
        else if($rand == 2)
            $profile_pic = "images/profilepic2.jpg";

        $insert = "INSERT INTO users (user_name, user_pass, user_email, user_profile) VALUES('$name','$pass','$email','$profile_pic')";

        $query = mysqli_query($con, $insert);

        if($query){
            echo"<script>alert('Your account, $name, has been created successfully')</script>";
            echo"<script>window.open('signin.php', '_self')</script>";
        } else {
            echo"<script>alert('User could not be registered')</script>";
            echo"<script>window.open('signup.php', '_self')</script>";
        }
    }

?>