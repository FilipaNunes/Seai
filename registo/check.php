<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>
<?php include_once("database/database.php"); ?>


<?php

	function addUser($login,$password,$email){
		$options = ['cost' => 12];
		$query = "INSERT INTO clientes(username,password,email)
			        VALUES(:name, :pass, :email)";

		$password_hashed = password_hash($password, PASSWORD_DEFAULT, $options);

		$values = array($login,$password_hashed,$email);
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
