<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>


<?php 

	include_once("add_funcionario.php");
	include_once("database/database.php"); 
?>

<?php 
	//$id_a = strip_tags($_POST['id_a']);
	$nome_completo = strip_tags($_POST['nome_completo']);
	$morada = strip_tags($_POST['morada']);
	$email= strip_tags($_POST['email']);
	$telemovel = strip_tags($_POST['telemovel']);
	$nif = strip_tags($_POST['nif']);
	

	addFuncionario($nome_completo,$morada,$email,$telemovel,$nif);
	
	header('location:index.php');
?>
