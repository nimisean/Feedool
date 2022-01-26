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

	
	$user2=$_SESSION['user2']  ;
	$myname = $_SESSION['username'];
    $value= $_SESSION['amount'];
	$console = $_SESSION['console'];
    $val= $value + 1;
	
	$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
	
if ($my['balance'] > $val){
    
	 header('Location: conf.php');
		 exit;
		
		
      
       

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
