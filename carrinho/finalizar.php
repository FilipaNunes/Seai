<?php
	  session_start();
	  include_once('../database/database.php');
?>


<?php
	function InserirEncomenda($peso,$dimensao,$data_s,$destino,$produto,$recolha,$hora_s,$id_c,$ponto_recolha){
		if($ponto_recolha == 1){
			$local_recolha = 'armazem_recolha';
			$recolha = explode(' -',$recolha);
			$recolha = $recolha[0];
			$query = "SELECT id_a FROM armazem WHERE nome = :nome";

			$values = array($recolha);
			$insert = array(':nome');

			$result = execQuery($query,$insert,$values);

			$id_recolha_temp = $result->fetch();
			$id_recolha = $id_recolha_temp['id_a'];
		}
		else if($ponto_recolha == 2){
			$local_recolha = 'ponto_recolha';
			$recolha = explode(' - ',$recolha);
			$recolha = $recolha[1];
			$query = "SELECT id_er FROM ponto_entrega_recolha WHERE morada_arm = :morada";

			$values = array($recolha);
			$insert = array(':morada');

			$result = execQuery($query,$insert,$values);

			$id_recolha_temp = $result->fetch();
			$id_recolha = $id_recolha_temp['id_er'];
		}

		$destino = explode(' - ',$destino);
		$destino = $destino[1];
		$query = "SELECT id_er FROM ponto_entrega_recolha WHERE morada_arm = :morada";

		$values = array($destino);
		$insert = array(':morada');

		$result = execQuery($query,$insert,$values);

		$id_entrega_temp = $result->fetch();
		$id_entrega = $id_entrega_temp['id_er'];

		$query = 'INSERT INTO encomenda(peso,dimensoes,data_submissao,"'.$local_recolha.'",
													tipo_encomenda,hora_submissao,cliente,ponto_entrega)
				  		VALUES(:peso, :dimensao, :data_s,:recolha,:produto,:hora_s,:id,:entrega)';

		$values = array($peso,$dimensao,$data_s,$id_recolha,$produto,$hora_s,$id_c,$id_entrega);
		$insert = array(':peso', ':dimensao', ':data_s',':recolha',':produto',':hora_s',':id',':entrega');

		$result = execQuery($query,$insert,$values);

		$query = 'SELECT id_e FROM encomenda WHERE peso = :peso AND dimensoes = :dimensao AND
												   										 data_submissao = :data_s AND
																						   ponto_entrega = :destino AND
																						   tipo_encomenda = :produto AND
																						   "'.$local_recolha.'" = :recolha AND
																						   hora_submissao = :hora_s AND cliente = :id';

		$values = array($peso,$dimensao,$data_s,$id_entrega,$produto,$id_recolha,$hora_s,$id_c);
		$insert = array(':peso', ':dimensao', ':data_s',':destino',':produto',':recolha',':hora_s',':id');

		$result = execQuery($query,$insert,$values);
		$id_e = $result->fetch();

		return $id_e;
	}

	function InserirFaz($id_e,$id_c,$custo){
		$query = "INSERT INTO faz(id_e,id_c,custo,estado) VALUES(:id_e, :id_c, :custo, :estado)";

		$values = array($id_e,$id_c,$custo,'Pendente');
		$insert = array(':id_e', ':id_c', ':custo',':estado');

		$result = execQuery($query,$insert,$values);
	}

	function Receitas($servico,$custo,$data_s){

		$query = "SELECT id FROM receitas WHERE data = :data_s";

		$values = array($data_s);
		$insert = array(':data_s');

		$result = execQuery($query,$insert,$values);

		$num_registos = $result->rowCount($result);

		if($num_registos == 0){
			$query = "INSERT INTO receitas(data) VALUES(:data)";

			$values = array($data_s);
			$insert = array(':data');

			execQuery($query,$insert,$values);

			$query = 'UPDATE receitas SET "'.$servico.'" = :custo WHERE data = :data';

			$values = array($custo, $data_s);
			$insert = array(':custo',':data');

			execQuery($query,$insert,$values);

		} else{

			$query = 'SELECT "'.$servico.'" FROM receitas WHERE data = :data';

			$values = array($data_s);
			$insert = array(':data');

			$result = execQuery($query,$insert,$values);

			$custo_anterior = $result->fetch();

			$custo_atual = $custo + $custo_anterior[$servico];

			$query = 'UPDATE receitas SET "'.$servico.'" = :custo WHERE data = :data';

			$values = array($custo_atual, $data_s);
			$insert = array(':custo',':data');

			execQuery($query,$insert,$values);
		}
	}

	if(isset($_SESSION['carrinho'])){

		$id_c = $_SESSION['user_id'];
		$limite = count($_SESSION["carrinho"]["servico"]);
		$hora_s = date("H:i:s");
		$data_s = date("Y-m-d");
		$data_receita = date("Y-m-01");
		
		for($i=0;$i<$limite;$i++){

			$servico = ($_SESSION['carrinho']['servico'][$i]);

			if ( strcmp($servico,'>0 a 1kg') == 0) $servico = '0a1';
			else if ( strcmp($servico,'>1 a 2kg') == 0) $servico = '1a2';
			else if ( strcmp($servico,'>2 a 3kg') == 0) $servico = '2a3';
			else if ( strcmp($servico,'>3 a 4kg') == 0) $servico = '3a4';
			else $servico = 'outras';

			$produto = ($_SESSION['carrinho']['produto'][$i]);
			$peso = ($_SESSION['carrinho']['peso'][$i]);
			$dimensao = ($_SESSION['carrinho']['dimensoes'][$i]);
			$destino = ($_SESSION['carrinho']['destino'][$i]);
			$recolha = ($_SESSION['carrinho']['recolha'][$i]);
			$quantidade = ($_SESSION['carrinho']['quantidade'][$i]);
			$custo = ($_SESSION['carrinho']['custo'][$i])/($quantidade);
			$ponto_recolha = ($_SESSION['carrinho']['ponto_recolha'][$i]);

			for($j=0;$j<$quantidade;$j++){
				$encomenda = InserirEncomenda($peso,$dimensao,$data_s,$destino,$produto,$recolha,$hora_s,$id_c,$ponto_recolha);
				$id_e_temp= $encomenda['id_e'];
				$id_e = $id_e_temp + $j;
				InserirFaz($id_e,$id_c,$custo);
				Receitas($servico,$custo,$data_receita);
			}
		}

	}

	$_SESSION['carrinho'] = array();

	header('location: ../index.php');


?>
