<?php
   session_start();
   require 'connect.php';
?>
<?php
       if($_SERVER["REQUEST_METHOD"] == "POST"){
         
	           
			    $my_score=$_POST['my_score'];
	            $opp_score=$_POST['opp_score'];
				
			
		      $id=$_SESSION['matchid'];
		 
			 
	        		  
		      
				     $sql = "UPDATE input_matches  SET user2_score = :my_score, user2_score2= :opp_score WHERE id = :id"; 
              
					 $stmt = $pdo->prepare($sql);
					 $stmt->bindValue(':id', $id);
					
					 $stmt->bindValue(':my_score', $my_score);
					 $stmt->bindValue(':opp_score', $opp_score);
                   
					 $stmt->execute();
						
					     $user = $stmt->fetch(PDO::FETCH_ASSOC);
					 header('Location: verify2.php');
		               exit;
					 
		
         
				  
	   }
?>