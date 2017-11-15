<?php include_once("check.php");?>

<?php
	
	$user = $_POST['username'];
	
	$num_registos = (CheckUser($user));
	
	if( $num_registos != 0)$message = array('status' => 'not_ok');
		
	else $message = array('status' => 'valid');
	
	echo json_encode($message);

?>
