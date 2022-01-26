<?php
   session_start();
   require 'connect.php';
?>
<?php
       if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user2= $_SESSION['user2'];
	            $myname=$_SESSION['username'];
			    $my_score=$_POST['my_score'];
	            $opp_score=$_POST['opp_score'];
				
				$_SESSION['$my_score'] = $my_score;
				$_SESSION['$opp_score'] = $opp_score;
		      $id=$_SESSION['matchid'];
		      $user2= $_SESSION['user2'];
              $user2= $_SESSION['user2_id'];
              $username= $_SESSION['username'];
	          $my_score = $_SESSION['$my_score'];
			  $opp_score=$_SESSION['$opp_score'];
              
				  
		    
				     $sql = "UPDATE input_matches  SET user1_score = :my_score, user1_score2= :opp_score WHERE id = :id"; 
              
					 $stmt = $pdo->prepare($sql);
					 $stmt->bindValue(':id', $id);
					
					 $stmt->bindValue(':my_score', $my_score);
					 $stmt->bindValue(':opp_score', $opp_score);
                   
					 $stmt->execute();
						
					     $user = $stmt->fetch(PDO::FETCH_ASSOC);
     
  
                     header('Location: last.php');
		               exit;
              
          }  
          
					 
					 
		
         
				  
	   
?>