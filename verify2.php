<?php
   session_start();
   require 'connect.php';

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    

         
	<link rel="stylesheet" type="text/css" href="mainui.css" />
	<link rel="stylesheet" type="text/css" href="ui3.css" />
	<link rel="stylesheet" href="dialog.css">
	<script src="dialog.js"></script>
	<script src="countdown2.js"></script>

	
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700' rel='stylesheet' type='text/css'>
<title> Feedool</title>
</head>
<body>
<div class = "panel">
<div class = "countdown">

<p>
    Time remaining: <span id="timer"></span>
</p>
</div>
</div>


<form name = "countdown" id= "count" action ="confirmbot2.php" method ="post">
<input name = "phrase" class = "search_bar"/ type = "hidden">
</form>



</body>

</html>
<script type ='text/javascript' src="js/jquery.js"></script>

