<?php
	include_once("../database/database.php");
?>

<?php

	function Get_Informacoes($id){
		$query = "SELECT * FROM armazem WHERE id_a = :id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);

		return $result->fetch();
	}

	function VerificarId($id){
		$query = "SELECT * FROM armazem WHERE id_a = :id";

		$values = array($id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);
		$n_armazens = $result->rowCount($result);

		if($n_armazens>0) return true;
		else return false;
		}
?>
