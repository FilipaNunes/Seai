<?php
	include_once("add_funcionario.php");
	include_once("../database/database.php");
?>

<?php
	$nome_completo = strip_tags($_POST['nome_completo']);
	$morada = strip_tags($_POST['morada']);
	$email= strip_tags($_POST['email']);
	$telemovel = strip_tags($_POST['telemovel']);
	$nif = strip_tags($_POST['nif']);


	addFuncionario($nome_completo,$morada,$email,$telemovel,$nif);

	$message = array('status' => 'ok');

	echo json_encode($message);

?>
