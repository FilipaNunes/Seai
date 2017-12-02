<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php"); ?>

<?php 
	
	function PontoRecolha(){

		$query = 'SELECT nome, morada_arm FROM armazem WHERE ocupacao = :ocupacao';
		
		$values = array('Livre');
		$insert = array(':ocupacao');
		
		$result = execQuery($query,$insert,$values);
		
		$num_registos = $result->rowCount($result);
		
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$nome = $array['nome'];
			$morada = $array['morada_arm'];
			$value = $i + 1;
			echo"
					<option value=$value> $nome - $morada </option>
				";
		}
	}
	
	function MoradaEntrega(){
		
		$query = 'SELECT localizacao FROM waypoint ';

		$result = execQuery($query,null,null);
		
		$num_registos = $result->rowCount($result);
		
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$nome = $array['localizacao'];
			$value = $i + 1;
					
			echo"
					<option value=$value> $nome </option>
				";
		}
		
	}
?>
