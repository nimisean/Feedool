<?php
 $userErr="";
 $passwordErr="";
 $loginErr="";
//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    if (empty($_POST["username"])) {
        $userErr = "Please Fill in A username";
    }
	if (empty($_POST["username"])) {
        $passwordErr = "Please Fill in A password";
    }
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT  username,password FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
   
   if($user === false){
	  try{
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        throw new exception('Incorrect username / password combination!');
		else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
	}
    } 

   
    catch(Exception $e) {
     $loginErr="Incorrect username / password combination!";        
    }	
        //If $validPassword is TRUE, the login has been successful.
        try{
			$validPassword = password_verify($passwordAttempt, $user['password']);
		if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
			$_SESSION['username'] = $username;
			$_SESSION['balance']=$user['balance'];
			$_SESSION['won']=$user['won'];
			$_SESSION['drawn']=$user['drawn'];
			$_SESSION['lost']=$user['lost'];
			$_SESSION['matches']=$user['matches'];
			$_SESSION['image']=$user['image'];
			 //Redirect to our protected page, which we called home.php
            header('Location: welcome.php');
            exit;
		    }
           
            
         else{
            //$validPassword was FALSE. Passwords do not match.
            throw new exception('Incorrect username / password combination!');
        }
    }
	catch(Exception $e) {
         $loginErr="Incorrect username / password combination!";        
    }
		
     
	
	
    
}
?>