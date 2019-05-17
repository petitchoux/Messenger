<?php 
	$run_msg = mysqli_query($con, $sel_msg);
	while ($row = mysqli_fetch_array($run_msg)) {
		$sender_username = $row['sender_username'];
		$receiver_username = $row['receiver_username'];
		$msg_content = $row['msg_content'];
		$msg_date = $row['msg_date'];
		
		echo "<ul>";
			
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
		
		echo "</ul>";

	}
?>