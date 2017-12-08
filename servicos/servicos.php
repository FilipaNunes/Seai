<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php"); ?>

<?php

	function PontoRecolha(){
		echo'
					<select class="w3-select" name="option" id="localrecolha" required>
					<option value="" disabled selected>Escolher</option>';

		$query = 'SELECT nome, morada_arm FROM ponto_entrega_recolha';

		$result = execQuery($query,null,null);

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
		echo"</select>";

	}

	function RecolhaArmazem(){

		echo'
					<select class="w3-select" name="option" id="localrecolha" required>
					<option value="" disabled selected>Escolher</option>';

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
		echo"</select>";
	}

	function MoradaEntrega(){

		$query = 'SELECT nome, morada_arm FROM ponto_entrega_recolha';

		$result = execQuery($query,null,null);

		$num_registos = $result->rowCount($result);

		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$nome = $array['nome'];
			$morada = $array['morada_arm'];
			$value = $i + 1;

			echo"
					<option value=$value> $nome - $morada</option>
				";
		}

	}

	if(isset($_POST['recolha'])){
		$recolha = $_POST['recolha'];
		if($recolha == 1) RecolhaArmazem();
		else if ($recolha == 2) PontoRecolha();
	}

?>
