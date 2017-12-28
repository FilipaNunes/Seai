<?php
	include_once("../database/database.php");
?>

<?php

	if($_POST['nome'] && $_POST['morada_arm'] && $_POST['lotacao_max'] && $_POST['latitude'] && $_POST['longitude'] ){
		$nome = htmlentities($_POST['nome']);
		$morada_arm = htmlentities($_POST['morada_arm']);
		$ocupacao = 0;
		$lotacao_max = htmlentities($_POST['lotacao_max']);
		$latitude = htmlentities($_POST['latitude']);
		$longitude = htmlentities($_POST['longitude']);

		$query = "INSERT INTO armazem(nome,morada_arm,ocupacao,lotacao_max,latitude,longitude)
							VALUES(:nome, :morada_arm, :ocupacao, :lotacao_max, :latitude, :longitude)";


		$values = array($nome,$morada_arm,$ocupacao,$lotacao_max,$latitude,$longitude);
		$insert = array(':nome', ':morada_arm', ':ocupacao', ':lotacao_max', ':latitude', ':longitude');

		$result = execQuery($query,$insert,$values);

		$message = array('status' => 'ok');
	} else $message = array('status' => 'not_ok');

	echo json_encode($message);
?>
