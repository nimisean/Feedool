<?php
session_start();
require 'connect.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    
	<link rel="stylesheet" type="text/css" href="ui6.css" />
	
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
<li><a class="navigation" id = "cashier" href="cashier.html">Cashier</a></li>
<li><a class="navigation" id = "faqs" href="myaccount.html">Account</a></li>
<li><a class="navigation" id = "my_profile" href="myprofile.php">Profile</a></li>
<li><a class="navigation" id = "faqs" href="#">Signout</a></li>
</ul>
</div>

<div class= "balance"><h1> BALANCE</h1></div>

<div class= "mybalance"><h1><?php echo $_SESSION['balance']; ?></h1></div>
</div>
<div class = "panel2">

<div class = "score-panel">
<span class = "deposit"><h3>Deposit</h3></span>
<span class = "withdraw"><h3>Withdraw</h3></span>
<span class = "transfer"><h3>Transfer</h3></span>


<div class = "buttons">
<div class = "btn-2" >
<center><p>T</p>
</div>
<div class = "btn-3"  >
<center><p>W</p></center>
</div>
<div class = "btn-4">
<center><p>D</p></center>
</div>
</div>
</div>
</div>
</div>

<div class = "notification" id = "scrollingDiv">

  
<?php

$form = $_SERVER['PHP_SELF'];
$username = $_SESSION['username'];
$sql = "SELECT * FROM requests WHERE user_to = :username AND seen= 0";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':username', $username);
	        $stmt->execute();
			
			while ($notice = $stmt->fetch(PDO::FETCH_ASSOC)){
				 $_SESSION['user2']= $notice['user_from'];
				 $_SESSION['user2id']= $notice['user_from_id'];
                 echo "<form action = '$form' method='post' name = 'decision' id='decision_'>
				 <p>You  recieved a match  request from <a href = 'profile.php?id=".$notice['user_from_id']."' > ".$notice['user_from']."</a></p>
				 <input name = 'id' type = 'hidden' value = ".$notice['id'].">
				 <input name = 'accept_' type = 'submit' class = 'accept'  value= 'Accept'>
				  <input name = 'reject_' type = 'submit' class = 'reject'  value= 'Reject'>
				 </form>
				 <br>
			   ";
			   $username = $_SESSION['username'];
         if($_SERVER["REQUEST_METHOD"] == "POST"){
	     $id = $_POST['id'];
		 
	     if (isset( $_POST['accept_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = 1, seen=1  WHERE id = :id" ;
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			header('Location: match.php');
	}
	elseif(isset( $_POST['reject_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = -1 ,seen=1  WHERE id = :id";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			
			$sql = "SELECT * FROM requests WHERE user_to = :username AND seen= 0";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':username', $username);
	        $stmt->execute();
			header('Location: welcome.php');
			while ($notice = $stmt->fetch(PDO::FETCH_ASSOC)){
				  
                echo "<form action = '$form' method='post' name = 'decision'>
				 #<p>You  recieved a match  request from <a href = 'profile.php?id=".$notice['user_from_id']."' > ".$notice['user_from']."</a></p>
				 <input name = 'id' type = 'hidden' value = ".$notice['id'].">
				 <input name = 'accept_' type = 'submit' class = 'accept'  value= 'Accept'>
				  <input name = 'reject_' type = 'submit' class = 'reject'  value= 'Reject'>
				 </form>
				 <br>
			   ";
	         }
            }
			}
			}
			
?>



</div>

<div class = "notice" id = "notification">
<?php
    $username = $_SESSION['username'];
    $sql = "SELECT COUNT(user_from) AS num FROM requests WHERE user_to = :username AND seen= 0";
    $stmt = $pdo->prepare($sql);
	$stmt->bindValue(':username', $username);
	$stmt->execute();
	$notice = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($notice['num']>0){
		echo "You have ".$notice['num']." notifications";
	}
	else{
		echo"No new Notification";
	}
    
   
?>

</div>
<body>
<script type ='text/javascript' src="js/jquery.js"></script>
<script type ='text/javascript' src="js/scroller.js"></script>
</html>