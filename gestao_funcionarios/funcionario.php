<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php
	function funcionario(){
		$limite = 6;
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
			if(!(is_numeric($page) == 1)) $page = 1;
		}
		else $page=1;
		$inicio = ($page-1) * $limite;
		if(isset($_POST['sair'])){
			unset($_SESSION['mes']);
			unset($_SESSION['ano']);
		}
		if(isset($_POST['mes2']) || isset($_SESSION['mes'])){
			if(isset($_POST['mes2'])){
				$_SESSION['mes']=$_POST['mes2'];
				$_SESSION['ano']=$_POST['ano2'];
			}
			$ano = $_SESSION['ano'];
			$mes = $_SESSION['mes'];
			$data = $ano . "-" . $mes . "-01";
			$query = "SELECT id_f FROM infor_funcionario WHERE data = :data";
			$values = array($data);
			$insert = array(':data');
			$result = execQuery($query,$insert,$values);
			$num_registos = $result->rowCount($result);
			$paginas_totais = ceil($num_registos / $limite);
			$query = "SELECT * FROM infor_funcionario JOIN funcionario ON infor_funcionario.id_f=funcionario.id_f
							  WHERE data = :data ORDER BY funcionario.id_f OFFSET $inicio LIMIT $limite";
			$values = array($data);
			$insert = array(':data');
			$result = execQuery($query,$insert,$values);
			$num_registos = $result->rowCount($result);
			if($num_registos == 0) echo"
															<p> Não existem dados para o mês e ano selecionado</p>
																<form method='post' action='index.php'>
																	<input class='w3-btn w3-red' type='submit' name='sair' value='Voltar à Listagem'></input>
																</form>
															";
			else{
				echo"
				<table class='w3-table-all'>
					<tbody>
						<tr>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Nº Funcionário </th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Nome do Funcionário</th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Nº Faltas Justificadas </th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Nº Faltas Injustificadas </th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Atrasos </th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Salário </th>
						</tr>
						";
				for($i=0;$i<$num_registos;$i++){
					$array = $result->fetch();
					$id_f = $array['id_f'];
					$nome_completo = $array['nome_completo'];
					$n_faltas_just = $array['n_faltas_just'];
					$n_faltas_injust = $array['n_faltas_injust'];
					$atrasos = $array['atrasos'];
					$salario = $array['salario'];
				echo"
					<tr style='text-align:center'>
						<td style='text-align:center'> $id_f </td>
						<td style='text-align:center'> $nome_completo </td>
						<td style='text-align:center'> $n_faltas_just </td>
						<td style='text-align:center'> $n_faltas_injust </td>
						<td style='text-align:center'> $atrasos </td>
						<td style='text-align:center'> $salario </td>
				</tr>";
			}
			echo "
				</tbody>
				</table>";
			$pagLink = "<div class='pagination'>";
			if($paginas_totais>1){
				for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";
				echo $pagLink . "</div>";
			}
			echo"
			<p></p>
				<form method='post' action='index.php'>
					<input class='w3-btn w3-red' type='submit' name='sair' value='Voltar à Listagem'></input>
				</form>
			";
		}
	}else{
			$query = "SELECT id_f FROM funcionario";
			$result = execQuery($query,null,null);
			$num_registos = $result->rowCount($result);
			$paginas_totais = ceil($num_registos / $limite);
			if($num_registos == 0) echo "<p>Não existem funcionários!</p>";
			else {
				echo"
				<table class='w3-table-all'>
	        <tbody>
	          <tr>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Nº Funcionário </th>
	          	<th style='background-color:#f44336; text-align:center'> <font color='white'> Nome do Funcionário</th>
	          	<th style='background-color:#f44336; text-align:center'> <font color='white'> Morada </th>
	          	<th style='background-color:#f44336; text-align:center'> <font color='white'> Email</th>
	          	<th style='background-color:#f44336; text-align:center'> <font color='white'> Contacto Telefónico </th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'> Nif </th>
							<th style='background-color:#f44336; text-align:center'> <font color='white'></th>
              <th style='background-color:#f44336; text-align:center'> <font color='white'></th>
	        	</tr>
						";
			$query = "SELECT id_f,nome_completo, morada, email, telemovel,nif FROM funcionario ORDER BY id_f OFFSET $inicio LIMIT $limite";
			$result = execQuery($query,null,null);
			$num_registos = $result->rowCount($result);
			for($i=0;$i<$num_registos;$i++){
				$array = $result->fetch();
				$nome_completo = $array['nome_completo'];
				$morada = $array['morada'];
				$email = $array['email'];
				$telemovel = $array['telemovel'];
				$nif = $array['nif'];
				$id = $array['id_f'];
				echo"
					<tr style='text-align:center'>
						<td style='text-align:center'> $id </td>
						<td style='text-align:center'> $nome_completo </td>
						<td style='text-align:center'> $morada </td>
						<td style='text-align:center'> $email </td>
						<td style='text-align:center'> $telemovel </td>
						<td style='text-align:center'> $nif </td>
						<td style='text-align:center'>
							<a onclick='event.preventDefault(); ConfirmarDelete($id)' href=#>
								<img src='../img/delete.png' height='22em'>
							</a>
              </td>
    					<td style='text-align:center'>
    						<a href='editar_funcionario.php?id=".$id."'>
    							<img src='../img/edit.png' height='22em' />
    						</a>
						</td>
					</tr>";
				}
			echo "
				</tbody>
				</table>";
			}
			$pagLink = "<div class='pagination'>";
			if($paginas_totais>1){
				for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";
				echo $pagLink . "</div>";
		}
	}
}
?>
