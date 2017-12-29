<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php
	 if(isset($_POST['id']))
      {
        $id=$_POST['id'];

				$query="SELECT estado FROM faz WHERE id_e = :id";

				$values = array($id);
				$insert = array(':id');

				$result = execQuery($query,$insert,$values);
				$estado = $result->fetch();

				if( strcmp($estado["estado"], 'Pendente') != 0 ) $message = array('status' => 'not_ok');
				else{

				$query="SELECT custo FROM faz WHERE id_e = :id";
				$query2="SELECT peso FROM encomenda WHERE id_e = :id";
				$values = array($id);
				$insert = array(':id');

				$result = execQuery($query,$insert,$values);
				$result2 = execQuery($query2,$insert,$values);

				$custos = $result->fetch();
				$pesos = $result2->fetch();

				$custo = $custos["custo"];
				$peso = $pesos["peso"];

				$query3="SELECT * FROM receitas
						 ORDER BY id DESC
						 LIMIT 1";

				$result3 = execQuery($query3,NULL,NULL);
				$receitas = $result3->fetch();

				if (($peso > 0) AND ($peso <= 0.5)) {
					$correcao = $receitas["0a1"] - $custo;
					$id_r = $receitas["id"];
					$query4 = "UPDATE receitas
							   SET \"0a1\" = :correcao
							   WHERE id = $id_r";
					$values2 = array($correcao);
					$insert2 = array(':correcao');
					execQuery($query4, $insert2, $values2);
				}

				elseif (($peso > 0.5) AND ($peso <= 1)) {
					$correcao = $receitas["1a2"] - $custo;
					$id_r = $receitas["id"];
					$query4 = "UPDATE receitas
							  SET \"1a2\" = :correcao
							  WHERE id = $id_r";
					$values2 = array($correcao);
					$insert2 = array(':correcao');
					execQuery($query4, $insert2, $values2);
				}

				elseif (($peso > 1) AND ($peso <= 1.5)) {
					$correcao = $receitas["2a3"] - $custo;
					$id_r = $receitas["id"];
					$query4 = "UPDATE receitas
							  SET \"2a3\" = :correcao
							  WHERE id = $id_r";
					$values2 = array($correcao);
					$insert2 = array(':correcao');
					execQuery($query4, $insert2, $values2);
				}

				elseif (($peso > 1.5) AND ($peso <= 2)) {
					$correcao = $receitas["3a4"] - $custo;
					$id_r = $receitas["id"];
					$query4 = "UPDATE receitas
							  SET \"3a4\" = :correcao
							  WHERE id = $id_r";
					$values2 = array($correcao);
					$insert2 = array(':correcao');
					execQuery($query4, $insert2, $values2);
				}

				$query="DELETE FROM faz WHERE id_e = :id";
		        $query2="DELETE FROM encomenda WHERE id_e  = :id";

				$result = execQuery($query,$insert,$values);
				$result2 = execQuery($query2,$insert,$values);
				$message = array('status' => 'ok');
		    }
			} else $message = array('status' => 'not_ok2');

			echo json_encode($message);
?>
