<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php

	$id = $_POST['id'];

	$query = "SELECT admin FROM clientes WHERE id_c = :id";

	$values = array($id);
	$insert = array(':id');

	$result = execQuery($query, $insert, $values);

	$admin = $result->fetch();

	if($admin['admin']== true) $message = array("status" => "admin");
	else $message = array("status" => "not_admin");

	echo json_encode($message);
?>
