<?php
	include_once("../database/database.php");
?>

<?php

	function Get_Informacoes($id){
		$query = "SELECT * FROM funcionario WHERE id_f = :id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);

		return $result->fetch();
	}

	function VerificarId($id){
		$query = "SELECT * FROM funcionario WHERE id_f = :id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);
		$n_funcionarios = $result->rowCount($result);

		if($n_funcionarios>0) return true;
		else return false;
		}
?>
