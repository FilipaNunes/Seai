<?php
    include_once("../database/database.php");
	include_once("../login/session.php");

	function update_encomenda_db($produto, $peso, $dimensao, $destino) {
		$id = $_POST["id"];
        $query = "UPDATE encomenda
                  SET tipo_encomenda = :produto,
					  peso         = :peso, 
					  dimensao      = :dimensao, 
                      morada_destino      = :destino 
				  WHERE id_e = :id";
		$values = array($produto, $peso, $dimensao, $destino, $id);
		$insert = array(':produto', ':peso', ':dimensao', ':destino', ':id');
		
		$result = execQuery($query, $insert, $values);
		
		return $result;	
}

	function update_faz_db($caracteristicas) {
		$id = $_POST["id"];
        $query = "UPDATE faz
                  SET caracteristicas = :caracteristicas 
				  WHERE id_e = :id";
		$values = array($caracteristicas, $id);
		$insert = array(':caracteristicas', ':id');
		
		$result = execQuery($query, $insert, $values);
		
		return $result;	
}

	if ($_POST["update"] AND ($_POST["peso"] <= 0 OR $_POST["peso"] > 4)) {
		$id = $_POST["id"];
		header("Location: update_encomenda2.php?id=$id");
	}
	
	elseif ($_POST["update"]) {
		update_encomenda_db($_POST["produto"], $_POST["peso"], $_POST["dimensao"], $_POST["destino"]);
		update_faz_db($_POST["caracteristicas"]);
		header("Location: dados_pessoais2.php");
	}
?>
