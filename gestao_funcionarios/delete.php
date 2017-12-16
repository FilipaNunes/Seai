<?php include_once("../database/database.php");?>

<?php
	$id=$_POST['id'];

	$query="SELECT id_f FROM funcionario WHERE id_f = :id";
	$values = array($id);
	$insert = array(':id');

	$result = execQuery($query,$insert,$values);
	$num_registos = $result->rowCount($result);

	$query = "DELETE FROM funcionario WHERE id_f = :id";

	if($num_registos>0){
		$query2 = "DELETE FROM infor_funcionario WHERE id_f = :id";
		$result = execQuery($query2,$insert,$values);
	}


	$result = execQuery($query,$insert,$values);
	$message = array('status' => 'valid');

	echo json_encode($message);

?>
