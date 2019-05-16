<?php

session_start();

session_destroy();
unset($_SESSION['user_email']);
header("Location: signin.php");

?>