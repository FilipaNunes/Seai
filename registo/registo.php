<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>


<?php include_once("registo/check.php") ?>
<?php include_once ("login/action_login.php") ?>

<?php 
	$login = strip_tags($_POST['user']);
	$password = strip_tags($_POST['pass']);
	$email = strip_tags($_POST['email']);


	addUser($login,$password,$email);
	
	session_start();
	$id = verifica_login($login, $password);
    $_SESSION["user_id"] = $id;
	header("Location: ../dados_pessoais/update_dados.php");
?>
