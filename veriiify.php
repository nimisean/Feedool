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

	$id =  $_SESSION['id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){


		 
	     if (isset( $_POST['accept_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = 1, seen=1  WHERE id = :id" ;			
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			
			$sql = "SELECT * FROM requests WHERE id = :id" ;
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			
		
           
	    }
	
	    elseif(isset( $_POST['reject_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = 'red' ,seen=1  WHERE id = :id";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			
	    }
	
	$myname = $_SESSION['username'];
    
    
	

	
	$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
	
if ($my['balance'] > 0){
	    echo $_SESSION['game'];
	
      
       
		echo "
		
		<div class = 'body'>
		<div class ='dialog'>
        <h1> Confirm Scores</h1>
		<form name = 'confirm' method = 'post' action='confirm2.php'>
        <p> Are you sure You want to Place The Match? </p>
		<button name = 'yes' type = 'submit' id ='y'>Yes</button> 
        <button  name = 'no' type= 'button'id='n'>No</button>
		</form>
		</div>
		</div>
		";
    
} 
else{
		
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
