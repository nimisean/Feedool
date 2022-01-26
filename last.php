<?php
   session_start();
   require 'connect.php';
?>
<?php
   
    $user2= $_SESSION['user2'];
	            $myname=$_SESSION['username'];
			    $my_score=$_SESSION['$my_score'];
	            $opp_score=$_SESSION['$opp_score'];
				
				$_SESSION['$my_score'] = $my_score;
				$_SESSION['$opp_score'] = $opp_score;
		      $id=$_SESSION['matchid'];
		      $user2= $_SESSION['user2'];
              $user2= $_SESSION['user2_id'];
              $username= $_SESSION['username'];
	          $my_score = $_SESSION['$my_score'];
			  $opp_score=$_SESSION['$opp_score'];
           $sql = "SELECT * FROM input_matches   WHERE id = :id";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
           $notice = $stmt->fetch(PDO::FETCH_ASSOC);
          $verify =$notice['u1'];
          $verify2 =$notice['u2'];
          $userdata1 = $notice['user1'];
          $userdata2 = $notice['user2'];                       
                                  
        
          $yes = "YES";                       
          if($userdata1 =$myname && $verify==0){
              
                $sql = "UPDATE input_matches  SET u1 = :yes WHERE id = :id";
                  $stmt = $pdo->prepare($sql);
			      $stmt->bindValue(':yes', $yes);
                  $stmt->bindValue(':id', $id);
                  $stmt->execute();
                  $notice = $stmt->fetch(PDO::FETCH_ASSOC);
                     header('Location: verify2.php');
		               exit;
              
          }
          elseif($userdata1 =$myname && $verify2==0){
              $sql = "UPDATE input_matches  SET u2 = :yes WHERE id = :id"; 
              $stmt = $pdo->prepare($sql);
			      $stmt->bindValue(':yes', $yes);
                  $stmt->execute();
                  $notice = $stmt->fetch(PDO::FETCH_ASSOC);
                     header('Location: verify2.php');
		               exit;
          }
          else{
              echo "Data Cannot Be Re-entered";
          }

?>