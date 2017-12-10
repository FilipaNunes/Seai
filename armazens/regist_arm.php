<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>


<?php 

	include_once("add_arm.php");
	include_once("database/database.php"); 
?>

<?php 
	$nome = strip_tags($_POST['nome']);
	$morada_arm = strip_tags($_POST['morada_arm']);
	$ocupacao = "Livre";
	$lotacao_max = strip_tags($_POST['lotacao_max']);
	

	// Adicionar novo Armazém
	try {
    addArmazem($nome,$morada_arm,$ocupacao,$lotacao_max);
	} catch (PDOException $e) {

		if (strpos($e->getMessage(), 'armazem_nome_key') !== false) {

		echo "<p> Armazem ja existe </p>";
		
		}	
	}
		
	
	header('location:index.php');
?>
