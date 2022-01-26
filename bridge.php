<?php
session_start();
/**
 * Include our MySQL connection.
 */
require 'connect.php';
if($_SERVER["REQUEST_METHOD"] === "POST"){
	          $id =  $_SESSION['id'];
		 
	     if (isset( $_POST['accept_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = 1, seen=1  WHERE id = :id" ;			
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			
			$sql = "SELECT * FROM requests WHERE id = :id" ;
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			
		
			header('Location: veriiify.php');
           
	    }
	
	    elseif(isset( $_POST['reject_'] )){
		    $id = $_POST['id'];
		    $sql = "UPDATE requests SET status = 'red' ,seen=1  WHERE id = :id";
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
	        $stmt->execute();
			header('Location: welcome.php');
	    }
		 }


 
			

			
			
?>