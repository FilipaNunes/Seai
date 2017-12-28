<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>


<?php

	function verifica_login($username, $password){
        global $conn;

        include_once ("database/database.php");

        if (!isset($conn)){
            db();
        }

        return check_login_db($username, $password);
    }


  if(isset($_POST['user']) && isset($_POST['pass'])) {

    if (session_status() == PHP_SESSION_NONE)session_start();

  $login = htmlentities($_POST['user']);
	$password = htmlentities($_POST['pass']);

  $id = verifica_login($login, $password);
  $_SESSION["user_id"] = $id;


  if ($id != NULL) $message = array('status' => 'ok');
	else $message = array('status' => 'not_ok');
}
	   echo json_encode($message);


?>
