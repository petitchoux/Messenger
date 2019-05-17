<?php

session_start();

include("include/connection.php");

$user_name = $_SESSION['user_name'];
$username = $_SESSION['username'];

if(isset($_POST['submit'])){
        $msg = htmlentities($_POST['msg_content']);

        if($msg == ""){
            echo "<div class='alert alert-danger'>
            <strong><center>Message was unable to send</center></strong>
            </div>";
        } else if(strlen($msg)>255){
            echo "<div class='alert alert-danger'>
            <strong><center>Message is too long. Maxium characters: 255</center></strong>
            </div>";
		} else {
        $insert = "INSERT INTO users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date) VALUES('$user_name','$username', '$msg', 'unread', NOW())";
        $run_insert = mysqli_query($con, $insert); 
		}
}

header("Location: home.php?user_name=$username")

?>