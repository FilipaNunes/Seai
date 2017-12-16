<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("gestao_funcionarios/add_funcionario.php"); ?>

<?php

	$email = $_POST['email'];

	$num_registos = (CheckEmail($email));

	if( $num_registos != 0)$message = array('status' => 'not_ok');

	else $message = array('status' => 'valid');

	echo json_encode($message);

?>
