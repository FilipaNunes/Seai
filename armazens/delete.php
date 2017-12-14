<?php include_once("../database/database.php");?>

<?php
        $id=$_POST['id'];

				$query = "SELECT  id_e FROM encomenda WHERE armazem_recolha = :id AND data_entr is null";
				$values = array($id);
				$insert = array(':id');

				$result = execQuery($query,$insert,$values);

				$n_encomendas = $result->fetch();

				if($n_encomendas>0)$message = array('status' => 'not_ok');
				else{
					$query = "SELECT  id_e FROM encomenda WHERE armazem_recolha = :id AND data_entr is not null";
					$values = array($id);
					$insert = array(':id');


					$query1="DELETE FROM encomenda WHERE armazem_recolha = :id";
        	$query2="DELETE FROM armazem WHERE id_a  = :id";

					$values = array($id);
					$insert = array(':id');

					$result = execQuery($query,$insert,$values);
					$message = array('status' => 'valid');
				}

				echo json_encode($message);

?>
