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
	$user2=$_SESSION['user2'];
	$myname=$_SESSION['myname'] ;
	$user2id=$_SESSION['user2id'];
	$piclink = $_SESSION['piclink'];
	$userid=$_SESSION['user_id'];
	$value=$_SESSION['value'];
    $game = $_SESSION['game'];
    $console =   $_SESSION['console']; 
   
	$sql = "SELECT * FROM crudentials Where username = :myname";
	$stmt = $pdo->prepare($sql);
         //Bind our variables.
    $stmt->bindValue(':myname', $myname);
	$stmt->execute();
	$my = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
       if ( isset($_POST['yes']) ){
            
         $seen = 0;     
             
         $sql = "INSERT INTO requests (user_from,user_to,game,Console,amount,seen) VALUES (:myname,:user2,:game,:console,:value,:seen)";
         $stmt = $pdo->prepare($sql);
         //Bind our variables.
         $stmt->bindValue(':myname', $myname);
		
         $stmt->bindValue(':user2', $user2);
            $stmt->bindValue(':game', $game);
		  $stmt->bindValue(':console', $console);
          $stmt->bindValue(':value', $value);
		  $stmt->bindValue(':seen', $seen);
		 

           
		 
 
       //Execute the statement and insert the new account.
         $result = $stmt->execute(); 
           
              if($result ===true){
        //What you do here is up to you!
        		 
		  header('Location: welcome.php');
		 exit;
		
          }
         else{
             echo"sql error";
         }
    
         }
    
        
}
	
        
         
      
		 
		 
		
	
	?>