<?php include_once("check.php") ?>

<?php 
	$login = $_POST['user'];
	$password = $_POST['pass'];
	$email = $_POST['email'];


	addUser($login,$password,$email);
	
echo"done";
?>
