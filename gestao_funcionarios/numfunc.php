<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("gestao_funcionarios/add_funcionario.php"); ?>

<?php

	$num = $_POST['numfunc'];

	$num_registos = (CheckNum($num));

	if( $num_registos != 0)$message = array('status' => 'ok');

	else $message = array('status' => 'not_ok');

	echo json_encode($message);

?>
