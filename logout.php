    <?php
	     session_start();
	 require 'connect.php';
	unset($_SESSION['is_auth']);

    session_destroy();
 

    // After logout, send them back to login.php

    header("location: login.php");

    exit;
?>