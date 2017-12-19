<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>


<?php include_once("registo/check.php") ?>

<?php
	  if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['email']) ){
			$login = htmlentities($_POST['user']);
			$password = htmlentities($_POST['pass']);
			$email = htmlentities($_POST['email']);

			addUser($login,$password,$email);

			$message = array('status' => 'ok');
		} else $message = array('status' => 'not_ok');

	echo json_encode($message);

?>
