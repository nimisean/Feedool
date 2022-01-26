<?php
session_start();
require 'connect.php';
?>
<?php
$username = $_SESSION['username'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$accept = isset($_POST['accept']);
	$reject = isset($_POST['reject']);
	$id = isset($_POST['id']);
	if ($accept){
		    $sql = "INSERT INTO requests (status,seen) VALUES ('accepted','1') WHERE id = :id" ;
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':username', $username);
	        $stmt->execute();
			header('Location: welcome.php');
	}
	elseif($reject){
		    $sql = "INSERT INTO requests (status,seen) VALUES ('rejected','1') WHERE id = :id" " ;
		    $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':username', $username);
	        $stmt->execute();
	}
}
?>