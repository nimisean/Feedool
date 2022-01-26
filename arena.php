 
<?php
session_start();
require 'connect.php';
?>
 
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="ui8.css" />
<link rel="stylesheet" type="text/css" href="dialog.css">
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
<li><a class="navigation" id = "search" href="search.php">Search</a></li>
<li><a class="navigation" id = "cashier" href="cashier.php">Cashier</a></li>
<li><a class="navigation" id = "l_board" href="leaderboard.php">Leaderboard</a></li>
<li><a class="navigation" id = "faqs" href="myprofile.php">Profile</a></li>
<li><a class="navigation" id = "faqs" href="logout.php">Logout</a></li>
</ul>
</div>

<form name = "search" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<select name = "datafield" class = "data_field"/>
  <option value="FIFA20">Fifa20</option>
    <option value="FIFA21">Fifa21</option>
  <option value="NBA2K20">NBA2K20</option>
    <option value="NBA2K21">NBA2K21</option>
    <option value="NFL2K20">NFL2K20</option>
  <option value="NFL2K21">NFL2K21</option>
  
  
  
</select>
<select name = "phrase" class = "search_bar"/>
  <option value="PS3">ps3</option>
  <option value="PS4">ps4</option>
  <option value="pS5">ps5</option>
  <option value="XBOX">xbox</option>
  <option value="XBOXONE">xbox one </option>
  <option value="XBOXXSERIES">xbox x</option>
 
  
  
  
</select>

<button class ='search_btn' type = 'submit' >Find an opponent</button>

</form>

    
  
</div>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>

<div class = "result">
       <?php 
	      if($_SERVER["REQUEST_METHOD"] === "POST"){
	        $d_base = $_POST["datafield"];
            $_SESSION['game']= $d_base;
		    $console = $_POST["phrase"];
			$me= $_SESSION['username'];
             $_SESSION['console']= $console; 
            
             $sql = "SELECT COUNT(user) AS num FROM $d_base WHERE console   = :console";
             $stmt = $pdo->prepare($sql);
             $stmt->bindParam(':console', $console);
             $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($row['num']==0 ){
                         //Could not find a user with that username!
           //PS: You might want to handle this error in a more user-friendly manner!
             echo "Sorry no match found";
			 
              }
              
              else{
                $limit = 10;
            $offset= 20;
	        $sql = "SELECT * FROM $d_base WHERE  console = :console AND user != :me LIMIT :limit";
	         $stmt = $pdo->prepare($sql);
              
             
	        $stmt->bindParam(':console', $console);
			$stmt->bindParam(':me', $me);
            $stmt->bindParam(':limit', $limit);
           
                
	        $stmt->execute();
			$object = $stmt->fetchAll();
            
              
              foreach ( $object as $row){
        //    etc   
               
			   
                   if($row['image'] =="") {
				    echo "<span class = 'userpic'><img width='100' height='100' src='images/verify.jpg' alt='Default Profile Pic'> </span>";
			        }else {
				    $image = $row['image'];
					echo "<span class = 'custompic'><img width='100' height='100' src='images/$image' alt='Profile Pic'</span>";
				    }
		   
				 
			   echo "<form name = 'matchcreator' class='amount' action='verify.php' method ='post' >
			    
                      <span class = 'username'><a href = 'profile.php?id=".$row['id']."' > ".$row['user']."</a></span>
					  <input name = 'user2'  type = 'hidden' value = ".$row['user']." />
					  <input name = 'user2id' type = 'hidden'value = ".$row['id']." />
					  <input name = 'piclink' type = 'hidden' value = ".$row['image']." />
					  <input name = 'myname'  type = 'hidden' value = ".$_SESSION['username']." /> 
					  <input  name = 'value' type = 'number' class='price'  min='5' max='100' value='5'/>
					  <input  name = 'game' type = 'hidden'  value='$d_base'/>
					  <div class = 'review'>
					  <p>REVIEW</p>
					  </div>
					  <button id ='send' type = 'submit' >Send Challenge</button>
					  </form>
					  <br>
			   ";
             
              }
            
           
             
		
    
			
         

		
			  
             
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
	     
		 
	     if (isset( $_POST['accept_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = 1, seen=1  WHERE id = :id" ;
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			$_SESSION['user2']= $notice['user_from'];
		    $_SESSION['user2id']= $notice['user_from_id'];
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
<script type ='text/javascript' src="js/counter.js"></script>
</html>