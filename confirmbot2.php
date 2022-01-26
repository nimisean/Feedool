<?php
   session_start();
   require 'connect.php';
?>
<?php
       if($_SERVER["REQUEST_METHOD"] == "POST"){
         
              
					 header('Location: verify3.php');
		               exit;
					 
			  }
			  else{
				
				 			     
					 header('Location: verify3.php');
		               exit;
					 
			 
		             
			  }
         
				  
	   
?>