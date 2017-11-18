<?php include_once("../database/database.php"); ?>


<?php

	function addUser($login,$password,$email){
		$query = "INSERT INTO clientes(username,password,email)
			      VALUES(:name, :pass, :email)";
		
		$values = array($login,(md5($password)),$email);
		$insert = array(':name',':pass', ':email');
		
		$result = execQuery($query,$insert,$values);
	}

	function CheckUser($user){
	$query = "SELECT username FROM clientes WHERE username = :user";
	
	$values = array($user);
	$insert = array(':user');
	
	$result = execQuery($query,$insert,$values);
	
	$num_registos = $result->rowCount($result);
	
	return $num_registos;
}


function CheckEmail($email){
	$query = "SELECT email FROM clientes WHERE email = :email";
	
	$values = array($email);
	$insert = array(':email');
	
	$result = execQuery($query,$insert,$values);
	$num_registos = $result->rowCount($result);
	
	return $num_registos;
}
?>