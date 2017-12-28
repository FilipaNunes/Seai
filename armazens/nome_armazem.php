<?php
	include_once("../database/database.php");
?>

<?php
	$nome = htmlentities($_POST['nome']);

	$query = "SELECT id_a FROM armazem WHERE nome= :nome";

	$values = array($nome);
	$insert = array(':nome');

	$result = execQuery($query,$insert,$values);

	$n_registos= $result->rowCount($result);

	if($n_registos>0)$message = array('status' => 'not_ok');
	else $message = array('status' => 'ok');

	echo json_encode($message);
?>
