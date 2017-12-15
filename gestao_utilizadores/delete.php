<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php
    $id=$_POST['id'];

		$query = "SELECT id_e FROM faz WHERE id_c=:id AND estado = :estado";

		$values = array($id,'Enviado');
		$insert = array(':id',':estado');

		$result = execQuery($query,$insert,$values);

		$num_encomendas = $result->rowCount($result);

		if($num_encomendas>0) $message = array('status' => 'not_ok');
		else{
			$query="DELETE FROM faz WHERE id_c = :id";
			$query1="DELETE FROM encomenda WHERE cliente = :id";
	  	$query2="DELETE FROM clientes WHERE id_c  = :id";


			$values = array($id);
			$insert = array(':id');

			$result = execQuery($query,$insert,$values);
			$result1 = execQuery($query1,$insert,$values);
			$result2 = execQuery($query2,$insert,$values);

			$message = array('status' => 'ok');
		}


    echo json_encode($message);


?>
