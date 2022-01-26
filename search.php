<?php
session_start();
require 'connect.php';
?>
 
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    
	<link rel="stylesheet" type="text/css" href="ui9.css" />
	<link rel="stylesheet" href="dialog.css">
	<script src="js/dialog.js"></script>
	
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
<li><a class="navigation" id = "search" href="cashier.html">Search</a></li>
<li><a class="navigation" id = "cashier" href="cashier.php">Cashier</a></li>
<li><a class="navigation" id = "faqs" href="myaccount.html">Account</a></li>
<li><a class="navigation" id = "my_profile" href="myprofile.php">Profile</a></li>
<li><a class="navigation" id = "faqs" href="logout.php">Logout</a></li>
</ul>
</div>
<form name = "search" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<select name = "datafield" class = "data_field"/>
  <option value="Cups ">Cups</option>
  <option value="Leagues">Leagues</option>
  <option value="Leaderboard">Leaderboard</option>
 
 
</select>

<input name = "phrase" class = "search_bar"/>

<button class ='search_btn' type = 'submit' >Send Challenge</button>
</form>
</div>
<div class = "result">
<?php
 if($_SERVER["REQUEST_METHOD"] == "POST"){
	        $d_base = $_POST["datafield"];
		    $phrase =  $_POST["phrase"];
	        $sql = "SELECT * FROM $d_base WHERE name = :phrase";
	        $stmt = $pdo->prepare($sql);
	        $stmt->bindValue(':phrase', $phrase);
	        $stmt->execute();
			$object = $stmt->fetch(PDO::FETCH_ASSOC);
			if($object === false){
            //Could not find a user with that username!
           //PS: You might want to handle this error in a more user-friendly manner!
             echo "Sorry no match found";
			 
           } else{
			   $image= $object['image'];
			   $_SESSION['id']=$object['id'];
			   if($image === "" ) {

				    echo "<span class = 'userpic'><img width='100' height='100' src='images/verify.jpg' alt='Default Profile Pic'> </span>";
			   }else {
					echo "<span class = 'userpic'><img width='100' height='100' src='images/".$image."' alt='Profile Pic'</span>";
				}
		   
				 $_SESSION['cupid']= $object['id'];
			   echo "<form name = 'matchcreator' class='amount' action='verify.php' method ='post' >
			           
                   <span class = 'competition'><a href = 'cup.php?id=".$object['id']."' > ".$object['name']."</a></span>
					    
					  <input  name = 'value' type = 'number' id ='price'  min='5' max='100' value='5'/>
					  
					  <div class = 'review'>
					  <p>REVIEW</p>
					  </div>
					  <button id ='send' type = 'submit' >Send Challenge</button>
					  </form>
					  <br>
				
			   ";
 }
 }

?>
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


</body>
<script type ='text/javascript' src="js/jquery.js"></script>
<script type ='text/javascript' src="js/scroller.js"></script>
</html>