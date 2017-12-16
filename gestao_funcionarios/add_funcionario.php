<?php include_once("../database/database.php"); ?>


<?php

		function addFuncionario($nome_completo,$morada,$email,$telemovel,$nif){


		$query = "INSERT INTO funcionario(nome_completo,morada,email,telemovel,nif)
			      VALUES(:nome_completo, :morada, :email, :telemovel, :nif)";


		$values = array($nome_completo,$morada,$email,$telemovel,$nif);
		$insert = array(':nome_completo', ':morada', ':email', ':telemovel' ,':nif');

		$result = execQuery($query,$insert,$values);
	}

	function CheckEmail($email){
		$query = "SELECT email FROM funcionario WHERE email = :email";

		$values = array($email);
		$insert = array(':email');

		$result = execQuery($query,$insert,$values);
		$num_registos = $result->rowCount($result);

		return $num_registos;
	}

	function CheckNif($nif){
		$query = "SELECT nif FROM funcionario WHERE nif = :nif";

		$values = array($nif);
		$insert = array(':nif');

		$result = execQuery($query,$insert,$values);
		$num_registos = $result->rowCount($result);

		return $num_registos;
	}

	function CheckNum($id){
		$query = "SELECT id_f FROM funcionario WHERE id_f = :id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);
		$num_registos = $result->rowCount($result);

		return $num_registos;
	}


?>
