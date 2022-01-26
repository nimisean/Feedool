<?php
session_start();
require 'connect.php';
        
            $username=$_SESSION['username'];
			$win=$_SESSION['won'];
			$draw=$_SESSION['drawn'];
			$lost=$_SESSION['lost'];
			$matches = $_SESSION['games'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    
	<link rel="stylesheet" type="text/css" href="ui.css" />
	
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700' rel='stylesheet' type='text/css'>
<title> Feedool</title>
</head>
<body>
<div class = "mainpanel">
<div class = "navbar">
<ul>
<li><a class="navigation" id = "home"  href="welcome.php">Home</a></li>
<li><a class="navigation" id = "arena" href="arena.php">Arena</a></li>
<li><a class="navigation" id = "match" href="match.php">Match</a></li>
<li><a class="navigation" id = "search" href="search.php">Search</a></li>
<li><a class="navigation" id = "cashier" href="cashier.php">Cashier</a></li>
<li><a class="navigation" id = "l_board" href="leaderboard.php">Leaderboard</a></li>
<li><a class="navigation" id = "my_profile" href="myprofile.php">Profile</a></li>
<li><a class="navigation" id = "faqs" href="logout.php">Logout</a></li>
</ul>
</div>

<div class = "score-panel">
<span class = "wins"><h3>WINS</h3></span>
<span class = "draws"><h3>DRAWS</h3></span>
<span class = "losses"><h3>LOSSES</h3></span>
<span class = "wins-numbers"><h3><?php echo $win; ?></h3></span>
<span class = "draws-numbers"><h3><?php echo $draw; ?></h3></span>
<span class = "losses-numbers"><h3><?php echo $lost; ?></h3></span>
    </div>