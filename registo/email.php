<?php include_once("check.php"); ?>

<?php
	
	$email = $_POST['email'];
	
	$num_registos = (CheckEmail($email));
	
	if( $num_registos != 0)$message = array('status' => 'not_ok');
		
	else $message = array('status' => 'valid');
	
	echo json_encode($message);

?>
