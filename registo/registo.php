<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>


<?php include_once("registo/check.php") ?>

<?php
	$login = strip_tags($_POST['user']);
	$password = strip_tags($_POST['pass']);
	$email = strip_tags($_POST['email']);

	addUser($login,$password,$email);

	$message = array('status' => 'ok');

	echo json_encode($message);

?>
