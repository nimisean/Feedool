<?php
session_start();
require 'connect.php';

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

<div class= "myname"><?php echo $_SESSION['username']; ?></div>

   <?php   
            
			$piclink=$_SESSION['image'];
			
			//use variables and set them in another file
	
			 if($_SESSION['image']=="Nil") {
				    echo "<span class = 'userpic2'><img width='100' height='100' src='images/verify.jpg' alt='Default Profile Pic'> </span>";
			 }else {
					echo "<span class = 'userpic3'><img width='100' height='100' src='images/vop4.jpg' alt='Profile Pic'</span>";
				}
?>
<div class= "balance"><h1> BALANCE</h1></div>
<div class= "mybalance"><h1><?php echo $_SESSION['balance']; ?></h1></div>
</div>
 

<div class = "panel2">
<center><h2>RANK</h2></center>
<?php       
            $username=$_SESSION['username'];
			
            $win=$_SESSION['win'];
			$draw=$_SESSION['draw'];
			$lost=$_SESSION['loss'];
			$matches = $_SESSION['games'];
			$sql = "SELECT * FROM crudentials WHERE username = :username";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':username', $username);
	        $stmt->execute();
			$user_stat = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['myid']=$user_stat['id'];
			$matches = $user_stat['games'];
            
            if ($matches<50){
               echo"<center><h1>NEWBIE</h1></center>"; 
            }
		    elseif($matches >50 && $matches <100){
               echo"<center><h1>PRO</h1></center>";
            }
			elseif($matches >100 && $matches <250){
            echo"<center><h1>ELITE</h1></center>";    
            }
			elseif($matches >250&&$matches <500){
            echo"<center><h1>ELITE</h1></center>";    
            }	
                
			else{
             echo"<center><h1>LEGENDARY</h1></center>";    
            }	
				
				
			
			
		
			

?>




<button class = "btn-2" >
<center><p>Create Game</p>
</button>

<button class = "btn-3"  >
<center><p>Random Play</p></center>
</button>
<button class = "btn-4">
<center><p>Play  a Friend</p></center>
</button>
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
				  $_SESSION['id']=$notice['id'];
				  
                echo "<form action ='veriiify.php'  method='post' name = 'decision'>
				 <p>You  recieved a match  request from <a href = 'profile.php?id=".$notice['id']."' > ".$notice['user_from']."</a></p>
				 <input name = 'id' type = 'hidden' value = ".$notice['id'].">
				 <input name = 'accept_' type = 'submit' class = 'accept'  value= 'Accept'>
				  <input name = 'reject_' type = 'submit' class = 'reject'  value= 'Reject'>
				  <input name = 'user2id'  type='hidden'  value= ".$notice['user_from'].">
				 </form>
				 <br>
			   ";
			  
			     $username = $_SESSION['username'];
                  
				 
        

			
			}
			
			
	$sql = "SELECT * FROM requests WHERE user_from = :username AND seen= 1 AND status = 1";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':username', $username);
	        $stmt->execute();
    			
				while ($notice = $stmt->fetch(PDO::FETCH_ASSOC)){
				 $_SESSION['user_2']= $notice['user_to'];
				  $_SESSION['game']=$notice['game'];
				  $_SESSION['req_id']=$notice['id'];
                  $_SESSION['amount']=$notice['amount'];
                  $_SESSION['console']=$notice['Console']; 
                echo 
                    "<form  name = 'decision' id='decision_' action ='veriify.php' method= 'post' >
				 <p><a href = 'profile.php?id=".$notice['id']."' > ".$notice['user_to']."</a> Acccepted you friend Request</p>
				 <input name = 'id' type = 'hidden' value = ".$notice['id'].">
				 <input name = 'accept_' type = 'submit' class = 'accept'  value= 'proceed'>
	             </form>
				 <br>
			   ";		
                $username = $_SESSION['username'];
				 
         
			

			
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
		$sum1 = $notice['num'];
		$_SESSION['sum1'] = $sum1;
		
	}
	else{
		
		$_SESSION['sum1'] = 0; 
		
	}
	
	
	$username = $_SESSION['username'];
	$sql = "SELECT COUNT(user_to) AS num FROM requests WHERE user_from = :username AND seen= 1";
    $stmt = $pdo->prepare($sql);
	$stmt->bindValue(':username',$username);
	$stmt->execute();
    $notice2 = $stmt->fetch(PDO::FETCH_ASSOC);
    
	
	if ($notice2['num']>0){
        
		$sum1 = $_SESSION['sum1'];
		$sum2 = $notice2['num']; 	
        $total  = $sum1 + $sum2;
        echo "<p> $total  New Notifications</p>";
        
        
        
	}
	else{
        
		echo "No new notifications";
        
        }
	
	 



	

    
   
?>

</div>

</body>
<script type ='text/javascript' src="js/jquery.js"></script>
<script type ='text/javascript' src="js/scroller.js"></script>


</html>