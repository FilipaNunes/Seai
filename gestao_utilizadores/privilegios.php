<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php

	if(isset($_POST['retirar_privilegios'])){
		$id = $_POST['id'];

		$query = "UPDATE clientes SET admin = false WHERE id_c=:id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);

		$message = array("status" => "ok");
	}
	else if(isset($_POST['conceder_privilegios'])){
		$id = $_POST['id'];

		$query = "UPDATE clientes SET admin = true WHERE id_c=:id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);

		$message = array("status" => "ok");
	}
	else $message = array("status" => "not_ok");

	echo json_encode($message);



?>
