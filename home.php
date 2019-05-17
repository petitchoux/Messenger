<!DOCTYPE html>
<?php
session_start();
include("include/connection.php");
if(!isset($_SESSION['user_email'])) {
    header("location: signin.php");
} else {
?>

<html>
<head>
<title>Messenger | Home</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/home.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn-img')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>

<script>
$(document).ready(function(){
  $("#user_lookup").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".left-chat-user-list li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</head>

<body>
    <div class="container-fluid mw-100 main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">		
				<div class="messenger-header">
					<div class="dropdown">
						<button onclick="myFunction()" class="dropbtn">
						<img class="dropbtn-img" src="Images\setting_icon.png" alt="icon" style="width:25px">
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="account_settings.php">Setting</a>
<<<<<<< HEAD
							<a href="logout.php" id="logout">Logout</a>
=======
							<a href="logout.php" id="logout">Log Out</a>
>>>>>>> Visual-Update
						</div>
					</div>								
					<div class="messenger-header-title">Messenger</div>
                </div>                
				<div class="input-group searchbox">
                    <div class="input-group-btn">
						<input type="text" id="user_lookup" placeholder="Search Messenger">
                    </div>
                </div>
                    <div class="left-chat">
                        <ul class="left-chat-user-list">
                            <?php include("include/get_users_data.php");?>
                        </ul>
                    </div>
            </div>
                <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                    <div class="row">
                        <!-- getting user info of who is logged in -->
                        <?php 
                            $user = $_SESSION['user_email'];
                            $get_user = "SELECT * FROM users WHERE user_email='$user'";
                            $run_user = mysqli_query($con, $get_user);
                            $row = mysqli_fetch_array($run_user);

                            $user_id = $row['user_id'];
                            $user_name = $row['user_name'];
							$_SESSION['user_name']=$user_name;
							
                        ?>
                        <!-- Getting the user data on which the user clicks -->
                        <?php 
                            if(isset($_GET['user_name'])){
                                global $con;

                                $get_username = $_GET['user_name'];
                                $get_user = "SELECT * FROM users WHERE user_name='$get_username'";

                                $run_user = mysqli_query($con, $get_user);

                                $row_user = mysqli_fetch_array($run_user);

                                $username = $row_user['user_name'];
								$_SESSION['username']=$username;
                                $user_profile_image = $row_user['user_profile'];
                            }

                            $total_messages = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                            $run_messages = mysqli_query($con, $total_messages);
                            $total = mysqli_num_rows($run_messages);

                        ?>
                            <div class="col-md-12 right-header-chat-name">
								<?php echo "$username"; ?><br/>
								<div class="active-status">Active 10y ago </div>
							</div>
							<div class="col-md-12 right-header">
                                <div class="right-header-img">
                                    <img src= <?php echo "$user_profile_image"; ?>>
                                </div>
                                <div class="right-header-detail">
                                    <form method="post">
                                    <p><?php echo "$username"; ?></p>
                                    <span>
                                        <?php echo $total; ?> messages
									</span> &nbsp &nbsp
                                    </form>
                                    <?php 
                                    if(isset($_POST['logout'])){
                                        $update_status = mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_name='$user_name'");
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
							<?php
								$update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status='read' WHERE sender_username='$username' AND receiver_username='$user_name'");
								$sel_msg = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER BY 1 ASC";
							?>
                            <div class="row">
                                <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
<<<<<<< HEAD
                                    <?php 
                                    $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status='read' WHERE sender_username='$username' AND receiver_username='$user_name'");

                                    $sel_msg = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER BY 1 ASC";
                                    
                                    $run_msg = mysqli_query($con, $sel_msg);

                                    while ($row = mysqli_fetch_array($run_msg)) {
                                        $sender_username = $row['sender_username'];
                                        $receiver_username = $row['receiver_username'];
                                        $msg_content = $row['msg_content'];
                                        $msg_date = $row['msg_date'];
                                    ?>
                                    <ul>
                                    <?php 
                                        if($user_name == $sender_username AND $username == $receiver_username){
                                            echo "<li><div class='rightside-right-chat'>
                                            <span>$user_name <small>$msg_date</small></span><br><br>
                                            <p>$msg_content</p>
                                            </div>
                                            </li>";
                                        } else if($user_name == $receiver_username AND $username == $sender_username){
                                            echo "<li><div class='rightside-left-chat'>
                                            <span>$username <small>$msg_date</small></span><br><br>
                                            <p>$msg_content</p>
                                            </div>
                                            </li>";
                                        }
                                    ?>
                                    </ul>
                                    <?php
                                    }
                                    ?>
=======
									<?php include("include/get_chat_history.php");?>
>>>>>>> Visual-Update
                                </div>
							<script>
								$(document).ready(function(){	
									$("#submit_btn").click(function(){
										$("#scrolling_to_bottom").load(window.location.pathname + " #scrolling_to_bottom");
									});
								});	
							</script>
                            </div>
                                <div class="row">
                                    <div class="col-md-12 right-chat-textbox">
                                        <form action = "send.php" method="post">
                                        <input class = "text-bar" autocomplete="off" type="text" name="msg_content" placeholder="Type a message...">
<<<<<<< HEAD
                                        <button class="btn" id= "submit_btn" name="submit"><i class="fa fa-telegram">Send</i></button>
=======
                                        <button class="btn" onclick="reload()" id= "submit_btn"name="submit"><i class="fa fa-telegram">Send</i>
                                        </button>
>>>>>>> 818e64f771e47d64d3cf6431f5aa8bc1c6592978
                                    </div>
									<div>
									
									</div>
                                </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD

=======
<?php

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
		unset($_POST['submit']);
		header('Location: home.php?user_name=Joyce');
		}
    }
?>
>>>>>>> 818e64f771e47d64d3cf6431f5aa8bc1c6592978

<<<<<<< HEAD
// Autoscrolls to the bottom to the most recent messages
=======
<!--Autoscrolls to the bottom to the most recent messages-->
>>>>>>> Visual-Update
    <script>
        $('#scrolling_to_bottom').animate({
            scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var height = $(window).height();
            $('.left-chat').css('height', (height - 92) + 'px');
            $('.right-header-contentChat').css('height', (height - 163) + 'px');
        });
    </script>

</body>
</html>
<?php } ?>