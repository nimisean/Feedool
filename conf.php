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
    $id=$_SESSION['id'];
	$user2=$_SESSION['user_2'];
	$myname=$_SESSION['username'] ;
    $value=$_SESSION['amount'];
    $console =   $_SESSION['console']; 
    $myid=$_SESSION['myid'];
    $green="Green";

$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
    $bal=$my['balance'];
$debit = $value + 1.00;
$my_val=$bal-$debit;
$my_bal=$my_val;
         
          $sql = "UPDATE crudentials SET balance = :my_bal  WHERE id = :myid"; 
              
					 $stmt = $pdo->prepare($sql);
					 $stmt->bindValue(':myid', $myid);
					
					 $stmt->bindValue(':my_bal', $my_bal);
					
                   
					 $stmt->execute();
						
				     $pay = $stmt->fetch(PDO::FETCH_ASSOC);
         
$sql = "SELECT * FROM input_matches WHERE user1 = :myname AND status = :green";
				$stmt = $pdo->prepare($sql);
	         	$stmt->bindValue(':myname', $myname);
                $stmt->bindValue(':green', $green);
				$stmt->execute(); 
				$detail = $stmt->fetch(PDO::FETCH_ASSOC);
                $mid = $detail['id'];
                echo $mid;
            
                $user2 = $detail['user2'];
          
         
         
		
 
       //Execute the statement and insert the new account.
     
            
                
        //What you do here is up to you!
        	
	      
            
          
               $_SESSION['matchid']=$mid;    
            
		     header('Location: match2.php');
		 exit;
		
    
         
    
        

	
        
         
      
		 
		 
		
	
	?>