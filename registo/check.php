<?php include_once("../database/database.php"); ?>


<?php

	function addUser($login,$password,$email){
		$query = "INSERT INTO clientes(username,password,email) VALUES('" . $login . "','" . md5($password) . "','" . $email . "');";
		$result = execQuery($query);
	}

	function CheckUser($user){
	$query = "SELECT username FROM clientes WHERE username = '".$user."'";
	$result = execQuery($query);
	$num_registos = pg_numrows($result);
	
	return $num_registos;
}


function CheckEmail($email){
	$query = "SELECT email FROM clientes WHERE email = '".$email."'";
	$result = execQuery($query);
	$num_registos = pg_numrows($result);
	
	return $num_registos;
}
?>