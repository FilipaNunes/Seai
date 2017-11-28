<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php")?>

<?php 
	function PontoRecolha(){
		$query = 'SELECT nome,morada_arm FROM armazem WHERE ocupacao = :ocupacao';
		
		$values = array('livre');
		$insert = array(':ocupacao');
		
		$result = execQuery($query,$insert,$values);
		
	}
?>
