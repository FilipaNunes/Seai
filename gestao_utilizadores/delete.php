<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php
    $id=$_POST['id'];

		$query = "SELECT id_e FROM faz WHERE id_c=:id AND (estado = :estado OR estado = :estado2)";

		$values = array($id,'Pendente', 'entregue');
		$insert = array(':id',':estado', ':estado2');

		$result = execQuery($query,$insert,$values);

		$num_encomendas = $result->rowCount($result);

		if($num_encomendas>0) $message = array('status' => 'not_ok');
		else{

      $query = "SELECT faz.id_e,custo,peso,data_submissao FROM faz JOIN encomenda ON faz.id_e = encomenda.id_e WHERE id_c=:id AND estado = :estado";

  		$values = array($id,'Pendente');
  		$insert = array(':id',':estado');

  		$result = execQuery($query,$insert,$values);
      $num_encomendas = $result->rowCount($result);

      if($num_encomendas>0){
        for($i=0;$i<$num_encomendas;$i++){
          $encomenda = $result->fetch();
          $custo = $encomenda['custo'];
          $peso = $encomenda['peso'];
          $data_s = $encomenda['data_submissao'];

          $data = explode('-', $data_s);
          $data[2] = '01';
          $data_s = implode('-', $data);

          if($peso>0 && $peso<=0.5)$servico = '0a1';
          else if($peso>0.5 && $peso<=1)$servico = '1a2';
          else if($peso>1 && $peso<=1.5)$servico = '2a3';
          else if($peso>1.5 && $peso<=2)$servico = '3a4';

          $query = 'SELECT "'.$servico.'" FROM receitas WHERE data = :data';

    			$values = array($data_s);
    			$insert = array(':data');

    			$result = execQuery($query,$insert,$values);

    			$custo_anterior = $result->fetch();

    			$custo_atual = $custo_anterior[$servico] - $custo;

    			$query = 'UPDATE receitas SET "'.$servico.'" = :custo WHERE data = :data';

    			$values = array($custo_atual, $data_s);
    			$insert = array(':custo',':data');

    			execQuery($query,$insert,$values);

        }
      }

			$query="DELETE FROM faz WHERE id_c = :id";
			$query1="DELETE FROM encomenda WHERE cliente = :id";
	  	$query2="DELETE FROM clientes WHERE id_c  = :id";


			$values = array($id);
			$insert = array(':id');

			$result = execQuery($query,$insert,$values);
			$result1 = execQuery($query1,$insert,$values);
			$result2 = execQuery($query2,$insert,$values);

			$message = array('status' => 'ok');
		}


    echo json_encode($message);


?>
