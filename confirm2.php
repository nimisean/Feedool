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
	$user2=$_SESSION['user2'];
	$myname=$_SESSION['username'] ;
    $value=$_SESSION['amount'];
    $console =   $_SESSION['console']; 
    $myid=$_SESSION['myid'];
   
	$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
       if ( isset($_POST['yes']) ){
            
         $status = "Green"; 
         $my_bal=$my['balance'];
         $debit = $value + 1.00;
         $new_bal=$my_bal - $debit;
         $final_bal = $new_bal;
          $sql = "UPDATE crudentials  SET balance = :final_bal  WHERE id = :myid"; 
              
					 $stmt = $pdo->prepare($sql);
					 $stmt->bindValue(':myid', $myid);
					
					 $stmt->bindValue(':final_bal', $new_bal);
					
                   
					 $stmt->execute();
						
				     $pay = $stmt->fetch(PDO::FETCH_ASSOC);
         
	     $sql = "INSERT INTO input_matches (user1,user2,console,amount,status) VALUES (:user2,:myname,:console,:value,:status)";
         $stmt = $pdo->prepare($sql);
         
         //Bind our variables.
        
		$stmt->bindValue(':myname', $myname);
         $stmt->bindValue(':user2', $user2);
		 
          $stmt->bindValue(':console', $console);
		  $stmt->bindValue(':value', $value);
          $stmt->bindValue(':status', $status); 
		  $result = $stmt->execute();
          $mid = $pdo->lastInsertId();
         
         
		
 
       //Execute the statement and insert the new account.
     
              if($result ===true){
                
        //What you do here is up to you!
        	
	        echo $mid;
            
            $_SESSION['matchid']=$mid;
                  
            
		     header('Location: match.php');
		 exit;
		
          }
         else{
             echo"sql error";
         }
    
         }
    
        
}
	
        
         
      
		 
		 
		
	
	?>