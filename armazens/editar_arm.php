<?php
	include_once("../database/database.php");
?>

<?php

	if($_POST['nome'] && $_POST['lotacao_max'] && $_POST['armazem'] && $_POST['flag'] ){
		$lotacao_max = htmlentities($_POST['lotacao_max']);
		$id_armazem = htmlentities($_POST['armazem']);

		$query = "UPDATE armazem SET lotacao_max = :lotacao_max WHERE id_a= :id";

		$values = array($lotacao_max,$id_armazem);
		$insert = array(':lotacao_max', ':id');

		$result = execQuery($query,$insert,$values);

		$message = array('status' => 'ok');
	}
	else if($_POST['nome'] && $_POST['lotacao_max'] && $_POST['armazem'] && !isset($_POST['flag']) ){
		$nome = htmlentities($_POST['nome']);
		$lotacao_max = htmlentities($_POST['lotacao_max']);
		$id_armazem = htmlentities($_POST['armazem']);

		$query = "UPDATE armazem SET nome= :nome, lotacao_max = :lotacao_max WHERE id_a= :id";

		$values = array($nome, $lotacao_max,$id_armazem);
		$insert = array(':nome',':lotacao_max', ':id');

		$result = execQuery($query,$insert,$values);

		$message = array('status' => 'ok');
	}

	else $message = array('status' => 'not_ok');

	echo json_encode($message);
?>
