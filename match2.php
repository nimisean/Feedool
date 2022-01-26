<?php

       
     session_start();
	 require 'connect.php';
	 	 
		
		 
	
  ?>
 
 
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    
	<link rel="stylesheet" type="text/css" href="ui3.css" />
	<link rel="stylesheet" href="dialog.css">
	<script src="dialog.js"></script>
	
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700' rel='stylesheet' type='text/css'>
<title> Feedool</title>
</head>
<body>
<div class = "holder">
<div class = "navbar">
<ul>
<li><a class="navigation" id = "home"  href="welcome.php">Home</a></li>
<li><a class="navigation" id = "arena" href="arena.php">Arena</a></li>
<li><a class="navigation" id = "match" href="match.php">Match</a></li>
<li><a class="navigation" id = "match" href="match.php">Store</a></li>
<li><a class="navigation" id = "search" href="search.php">Search</a></li>
<li><a class="navigation" id = "cashier" href="cashier.php">Cashier</a></li>
<li><a class="navigation" id = "l_board" href="leaderboard.php">Account</a></li>
<li><a class="navigation" id = "faqs" href="profile.php">Profile</a></li>
<li><a class="navigation" id = "faqs" href="logout.php">Logout</a></li>
</ul>
</div>


<?php
 $myname=$_SESSION['username'];
 $id=$_SESSION['matchid'];
 $user2= $_SESSION['user_2'];
    

    
 
   
  $sql = "SELECT * FROM crudentials WHERE   username = :user2";
				$stmt = $pdo->prepare($sql);
	         	$stmt->bindValue(':user2', $user2);
				$stmt->execute(); 
				$detail = $stmt->fetch(PDO::FETCH_ASSOC);
                $user2id = $detail['id'];
                echo $user2id;
				$_SESSION['user2_id'] =  $user2id;
    
    
                 echo "<div class = 'accept2'></div>";
    
  
    echo $id;
    echo $user2;
    echo $user2id;
    
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			    $user2= $_SESSION['user2'];
	            $myname=$_SESSION['username'];
			    $my_score=$_POST['my_score'];
	            $opp_score=$_POST['opp_score'];
				
				$_SESSION['$my_score'] = $my_score;
				$_SESSION['$opp_score'] = $opp_score;
				
				

				
		
		        
			 
		
			
					
					
				   
				 

				
			
		
	}
 ?>
	
<div class = "vs">
<h1>VS</h1>
</div>
<

<div class = "board">
<center><p>You: <h1><?php echo $_SESSION['username'];?> </h1> </p></center>
</div>
<div class ="board2">
<center><p>Opponent: <h1><?php echo $_SESSION['user_2'];?> </h1> </p></center>
 </div>
<div class= "Myname"><?php echo "<a href = 'profile.php?id=".$_SESSION['user_id']."' >You</a>"; ?></div>
<div class= "opp"><?php echo "<a href = 'profile.php?id=".$_SESSION['user2_id']."' >Opponent</a>"; ?></div>


<form name ="match_results" action="confirmbott.php" method = "post" id="scores" >

<input  name = 'my_score' type = 'number'  id='score1'  min="0" value='0'/>
<input  name = 'opp_score' type = 'number' id='score2' min="0"  value='0'/>

<button  id ='send_result' type = 'button' onclick="showHide();">Send Challenge </button>
<div class ="dialog" id = "user_confirm">
<h1> Confirm Scores</h1>
<p> Are you sure the scores are correct? </p>
<button type = "submit" id ="y">Yes</button> 
 <button type = "button"onclick="hide()" id="n">No</button>'
</div>
</div>
 <?php
   
    
    $sql = "SELECT * FROM requests WHERE id = :id ";
    $stmt = $pdo->prepare($sql);
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	$req = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_from = $req['user_from'];
	$user2 = $req['user_to'];

	$username = $_SESSION['username'];

	
	
	
	$sql = "SELECT * FROM crudentials WHERE username = :username";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':username', $username);
	$stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
	   if($user['image'] ==""){
		   echo "<div class = 'userpic'><img  src='images/verify.jpg' alt='Default Profile Pic'> </div>";
            $image= $user['image'];
			$id = $user['id'];
		    
			}else {
					 echo "<div class = 'userpic'><img  src='images/verify.jpg' alt='Default Profile Pic'> </div>";
				}

      
	
	 
	$sql = "SELECT * FROM crudentials WHERE username = :user2";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':user2', $user2);
	$stmt->execute();
	$user_2 = $stmt->fetch(PDO::FETCH_ASSOC);
   
		   if($user_2['image'] == ""){
		 
              
				
				
			
                     echo "<div class = 'userpic2'><img  src='images/verify.jpg' alt='Default Profile Pic2'> </div>";
				    
				    
			 }else {
                   $image= $user_2['image'];
		           $user2id = $user_2['id'];
				   $_SESSION['user_2id'] = $user2id;
				   echo "<div class = 'userpic2'><img src='images/".$image."' alt='Profile Pic2'</div>";
				}

       


	
    ?>
</form>


 











</body>
<script type ='text/javascript' src="js/jquery.js"></script>
<script type ='text/javascript' src="js/scroller.js"></script>
<script type ='text/javascript' src="js/hide.js"></script>

</html>
