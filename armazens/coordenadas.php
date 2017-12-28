<?php
	include_once("../database/database.php");
?>

<?php
	$latitude = htmlentities($_POST['latitude']);
	$longitude = htmlentities($_POST['longitude']);

	$query = "SELECT id_a FROM armazem WHERE latitude= :latitude AND longitude = :longitude";

	$values = array($latitude, $longitude);
	$insert = array(':latitude', ':longitude');

	$result = execQuery($query,$insert,$values);

	$n_registos= $result->rowCount($result);

	if($n_registos>0)$message = array('status' => 'not_ok');
	else $message = array('status' => 'ok');

	echo json_encode($message);
?>
