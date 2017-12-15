<?php
	include_once("../database/database.php");
?>

<?php
	$nome = strip_tags($_POST['nome']);
	$morada_arm = strip_tags($_POST['morada_arm']);
	$ocupacao = 0;
	$lotacao_max = strip_tags($_POST['lotacao_max']);

	$query = "SELECT id_a FROM armazem WHERE nome= :nome";

	$values = array($nome);
	$insert = array(':nome');

	$result = execQuery($query,$insert,$values);

	$n_registos= $result->rowCount($result);

	if($n_registos>0)$message = array('status' => 'not_valid');
	else{
		$query = "INSERT INTO armazem(nome,morada_arm,ocupacao,lotacao_max)
						VALUES(:nome, :morada_arm, :ocupacao, :lotacao_max)";


		$values = array($nome,$morada_arm,$ocupacao,$lotacao_max);
		$insert = array(':nome', ':morada_arm', ':ocupacao', ':lotacao_max');

		$result = execQuery($query,$insert,$values);

		$message = array('status' => 'valid');
	}

	echo json_encode($message);
?>
