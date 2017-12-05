<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>


<?php 

	include_once("add_arm.php");
	include_once("database/database.php"); 
?>

<?php 
	//$id_a = strip_tags($_POST['id_a']);
	$nome = strip_tags($_POST['nome']);
	$morada_arm = strip_tags($_POST['morada_arm']);
	$ocupacao = "Livre";
	$lotacao_max = strip_tags($_POST['lotacao_max']);
	

	addArmazem($nome,$morada_arm,$ocupacao,$lotacao_max);
	
	header('location:index.php');
?>
