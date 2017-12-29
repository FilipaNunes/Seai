<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php

include_once("login/session.php");

if (isset($_POST["pesquisar"]) AND isset($_POST["estado"])) {
	$_SESSION["estado"] = $_POST["estado"];
	header("Location: dados_pessoais2.php?page=1");
}

?>
