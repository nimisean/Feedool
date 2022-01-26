<?php
          session_start();
/**
 * Include our MySQL connection.
 */
         require 'connect.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name = "viewport" width ="device-width, initial scale = 1.0">
	
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	
    <link rel="stylesheet" href="ui7.css">
	<link rel="stylesheet" href="dialog.css">
	<script src="dialog.js"></script>
	
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700' rel='stylesheet' type='text/css'>
<title> Feedool</title>
</head>
<body>
<div class = "panel">

<?php

		
			
        	    $id = $_SESSION['matchid'];
			  	$user2= $_SESSION['user2'];
	            $myname=$_SESSION['username'];
				
				echo $id;
				echo $myname;
				echo $user2;
					
				$sql = "SELECT * FROM input_matches WHERE ID = :id ";
				$stmt = $pdo->prepare($sql);
	         	
				$stmt->bindValue(':id', $id);
				$stmt->execute(); 
				$test1 = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $test1['user1_score'];
			echo $test1['user2_score'];
    echo $test1['user1_score2'];
			echo $test1['user2_score2'];
    
    
            if ($myname ===$test1['user1'] ){
                $my_score = $test1['user1_score'];
                $opp_score=$test1['user2_score'];
                
                if($my_score===$opp_score){
                    echo "Someone inputted Wrong Scores";
                }
                elseif($my_score>opp_score){
                    echo "YOU WON";
                    
                }
                else{
                    echo "Loss";
                }
            }
            else{
                $my_score=$test1['user2_score'];
                $opp_score=$test1['user2_score'];
                if($my_score===$opp_score){
                    echo "Someone inputted Wrong Scores";
                }
                elseif($my_score>opp_score){
                    echo "YOU WON";
                    
                }
                else{
                    echo "Loss";
                }
                
            }
    //Fetch row.
                				
		    
		
			   
                

			
				  
				
				
				
				

				
             
			
			
			 
			 
			  
        
    
?>

</div>




</body>

</html>
<script type ='text/javascript' src="js/jquery.js"></script>



      
