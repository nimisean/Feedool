<!DOCTYPE HTML>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    
	<link rel="stylesheet" type="text/css" href="verify.css" />
<script type ='text/javascript' src="js/hide.js"></script>
<?php
//login.php
 
/**
 * Start the session.
 */

session_start();
/**
 * Include our MySQL connection.
 */
require 'connect.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$user2 = !empty($_POST['user2']) ? trim($_POST['user2']) : null;
    $user2id = !empty($_POST['user2id']) ? trim($_POST['user2id']) : null;
	$myname=!empty($_POST['myname']) ? trim($_POST['myname']) : null;
	$piclink=!empty($_POST['piclink']) ? trim($_POST['piclink']) : null;
	$game=!empty($_POST['game']) ? trim($_POST['game']) : null;
	$game=!empty($_POST['game']) ? trim($_POST['game']) : null;
	$value=!empty($_POST['value'])? trim($_POST['value']) : null;
	
	$_SESSION['user2'] = $user2;
	$_SESSION['myname'] = $myname;
	$_SESSION['user2id'] = $user2id;
	$_SESSION['piclink'] = $piclink;
	$_SESSION['game'] = $game;
	$_SESSION['value'] = $value;
    
	

	
	$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
	
if ($my['balance'] > 0){
	    echo $_SESSION['game'];
		echo$_SESSION['value'];
        $console= $_SESSION['console'];
        $seen=0;
       
		echo "
		
		<div class = 'body'>
		<div class ='dialog'>
        <h1> Confirm Scores</h1>
		<form name = 'confirm' method = 'post' action='confirm.php'>
        <p> Are you sure You want to Place The Match? </p>
		<button name = 'yes' type = 'submit' id ='y'>Yes</button> 
        <button  name = 'no' type= 'button'id='n'>No</button>
		</form>
		</div>
		</div>
		";
} else{
		
		echo "
		<div class = 'body'>
		<div class ='dialog'>
        <h1>Insufficient  Funds</h1>
        <p class = 'msg'>What do you want to do?</p>
        <button type = 'button' id ='y'><a href = 'cashier.php'>Deposit</a></button> 
        <button type = 'button'id='n'><a href = 'cashier.php'>Cancel</a></button>
		
		</form>
		</div>
		</div>
		
		";
	}


		
		
		
		
	
	
	
		
		 
	     
		
				 
                 
                 
	

	 
            
			 //Redirect to our protected page, which we called match.php
   
            
}
           
            
       
    
		
?>
