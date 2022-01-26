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
    


	$user2 =$_SESSION['user2'];
    $user2id= $_SESSION['user2id'];
	$myname=$_SESSION['username'];
	
	    
	
	
	
	$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
if ($my['balance'] > 0){
		echo "
		<div class = 'body'>
		<div class ='dialog'>
        <h1> Confirm Scores</h1>
		<form name = 'confirm' method = 'post' action = 'match.php'>
        <p> Are you sure You want to Place The Match? </p>
		<button type = 'submit' id ='y'>Yes</button> 
        <button type = 'button'id='n'>No</button>
		</form>
		</div>
		</div>
		";
         header('Location: match.php');
		
	}
	else{
		
		echo "
		<div class = 'body'>
		<div class ='dialog2'>
        <h1>Insufficient  Funds</h1>
        <p>What do you want to do?</p>
        <button type = 'button' id ='y'><a href = 'cashier.php'>Deposit</a>
        <button type = 'button2'id='n'>Cancel</button>
		
		
		</div>
		</div>
		
		";
	}
		 

		
			
		
		
	
	
	
		
		 
	     
		
				 
                 
                 
	

	 
            
			 //Redirect to our protected page, which we called match.php
   
      
           
            
       
    
		
?>
