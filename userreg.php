<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["username"])) {
     $nameErr = "Username is required";
   } else {
     $name = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9@_]*$/",$name)) {
       $nameErr = "Only letters , numbers , '@' , '_' allowed"; 
     }
   }
  if (empty($_POST['password'])) {
    $passErr = ' Password is required !';
} else {
    $pass = test_input($_POST['password']);

    if (!preg_match('/^[a-zA-Z0-9@_]*$/', $pass)) {
        $passErr = 'password can only contain a upper/lower case letters , numbers, '_' and '@'';
    } else {
        $valid++;
    }
} 
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
  function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
 ?>