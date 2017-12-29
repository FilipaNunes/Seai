<?php
	include_once("../database/database.php");
?>

<?php

	if($_POST['email'] && $_POST['morada'] && $_POST['funcionario'] && $_POST['flag']  && $_POST['telemovel']  ){
		$morada = htmlentities($_POST['morada']);
		$id_func = htmlentities($_POST['funcionario']);
		$telemovel = htmlentities($_POST['telemovel']);

		$query = "UPDATE funcionario SET morada = :morada, telemovel = :telemovel WHERE id_f = :id";

		$values = array($morada,$telemovel,$id_func);
		$insert = array(':morada',':telemovel',':id');

		$result = execQuery($query,$insert,$values);

		$message = array('status' => 'ok');
	}
	else if($_POST['email'] && $_POST['morada'] && $_POST['funcionario'] && $_POST['telemovel'] && !isset($_POST['flag']) ){
		$morada = htmlentities($_POST['morada']);
		$id_func = htmlentities($_POST['funcionario']);
		$telemovel = htmlentities($_POST['telemovel']);
		$email = htmlentities($_POST['email']);

		$query = "UPDATE funcionario SET morada = :morada, telemovel = :telemovel, email = :email WHERE id_f = :id";

		$values = array($morada,$telemovel,$email,$id_func);
		$insert = array(':morada',':telemovel',':email',':id');

		$result = execQuery($query,$insert,$values);

		$message = array('status' => 'ok');
	}

	else $message = array('status' => 'not_ok');

	echo json_encode($message);
?>
