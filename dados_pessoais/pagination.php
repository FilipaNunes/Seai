<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");
include_once("login/session.php");
?>

<?php

	function Table(){

		if(!isset($_GET["page"])) {
			unset($_SESSION["estado"]);
		}

		$limite = 6;
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
			if(!(is_numeric($page) == 1)) $page = 1;
		}
		else $page=1;
		$inicio = ($page-1) * $limite;

		$user_id = $_SESSION["user_id"];

		if (!isset($_SESSION["estado"])) {
			$query = "SELECT id_c FROM faz
					  WHERE id_c=:id";
		}

		else {
			$estado = $_SESSION["estado"];

			$query = "SELECT * FROM faz
					  JOIN encomenda ON faz.id_e=encomenda.id_e
					  WHERE faz.id_c = :id AND estado='$estado'";

		}

		$values = array($user_id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);

		$num_registos = $result->rowCount($result);

		if ($num_registos == 0) {
			if (!isset($_SESSION["estado"])) echo "<center>Não foi efetuada nenhuma encomenda.</center>";
			else {
				echo "<center>Nenhuma encomenda se encontra nesse estado.</center>";
				?> <hr style="width:50px;border:5px solid red" class="w3-round">
				   <h2 class="w3-text-red"><b>Pesquisar Informações</b></h2>
					<form style="display:inline;" method='post' action='filter.php'>
						<select class="w3-select" id="estado" name="estado" required>
						  <option value="" disabled selected>Estado</option>
						  <option value="Pendente">Pendente</option>
						  <option value="Enviada">Enviada</option>
						  <option value="Entregue">Entregue</option>
						</select>
					<p></p>
						  <input class="w3-btn w3-red" type='submit' name='pesquisar' value='Pesquisar'></input>
					</form> <?php if (isset($_SESSION["estado"])) { ?> <a class="w3-btn w3-red" href="dados_pessoais2.php">Mostrar todas</a>


	 <?php
					}
			}
		}
		else { ?>
			<table class="w3-table-all">
					  <thead>
						<tr class="w3-red">
						  <th style='text-align:center'>Serviço</th>
						  <th style='text-align:center'>Produto</th>
						  <th style='text-align:center'>Custo (€)</th>
						  <th style='text-align:center'>Destino</th>
						  <th style='text-align:center'>Recolha</th>
							<th style='text-align:center'>Submissão</th>
						  <th style='text-align:center'>Envio</th>
						  <th style='text-align:center'>Entrega</th>
						  <th style='text-align:center'>Estado</th>
						  <th style='text-align:center'></th>
						</tr>
					  </thead>

		<?php $paginas_totais = ceil($num_registos / $limite);

		if (!isset($_SESSION["estado"])) {
			$query = "SELECT * FROM faz
					  JOIN encomenda ON faz.id_e=encomenda.id_e
					  WHERE faz.id_c = :id
					  ORDER BY encomenda.id_e DESC
					  OFFSET $inicio
					  LIMIT $limite";
		}

		else {
			$query = "SELECT * FROM faz
					  JOIN encomenda ON faz.id_e=encomenda.id_e
					  WHERE faz.id_c = :id AND estado = '$estado'
					  ORDER BY encomenda.id_e DESC
					  OFFSET $inicio
					  LIMIT $limite";
		}

		$values = array($user_id);
		$insert = array(':id');

		$result = execQuery($query,$insert,$values);
		$num_registos = $result->rowCount($result);

		for($i=0;$i<$num_registos;$i++){
			$encomenda = $result->fetch();
			$query = "SELECT nome,morada_arm FROM ponto_entrega_recolha WHERE id_er = :id_entrega";

			$values = array($encomenda["ponto_entrega"]);
			$insert = array(':id_entrega');

			$destino_temp = execQuery($query,$insert,$values);
			$destino = $destino_temp->fetch();

			$query = "SELECT nome,morada_arm FROM ponto_entrega_recolha WHERE id_er = :id_recolha";

			$values = array($encomenda["ponto_recolha"]);
			$insert = array(':id_recolha');

			$destino2_temp = execQuery($query,$insert,$values);
			$destino2 = $destino2_temp->fetch();

			$query = "SELECT nome,morada_arm FROM armazem WHERE id_a = :id_recolha";

			$values = array($encomenda["armazem_recolha"]);
			$insert = array(':id_recolha');

			$destino3_temp = execQuery($query,$insert,$values);
			$destino3 = $destino3_temp->fetch();
			?>

						<tr style='text-align:center'>
						<td style='text-align:center'><?php if(0 < $encomenda["peso"] AND 0.5 >= $encomenda["peso"]) echo "0 a 0,5 Kg";
								  if(0.5 < $encomenda["peso"] AND 1 >= $encomenda["peso"]) echo ">0,5 a 1 Kg";
								  if(1 < $encomenda["peso"] AND 1.5 >= $encomenda["peso"]) echo ">1 a 1,5 Kg";
								  if(1.5 < $encomenda["peso"] AND 2 >= $encomenda["peso"]) echo ">1,5 a 2 Kg";?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["tipo_encomenda"].'';?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["custo"].'';?></td>
						<td style='text-align:center' class="morada"><?php echo ''.$destino['nome'].'';?>
								<span class="moradatexto"><?php echo ''.$destino['morada_arm'].'';?></span>
						</td>
						<td style='text-align:center' class="morada"><?php
									if ($destino2 != NULL AND $destino3 == NULL){
										echo ''.$destino2['nome'].'';?>
										<span class="moradatexto"><?php echo ''.$destino2['morada_arm'].'';?></span>
									<?php }
								  if ($destino2 == NULL AND $destino3 != NULL){
										echo ''.$destino3['nome'].'';?>
										<span class="moradatexto"><?php echo ''.$destino3['morada_arm'].'';?></span>
									<?php }
								  if ($destino2 == NULL AND $destino3 == NULL) echo 'Indefinido';?>
							</td>
						<td style='text-align:center'><?php $data_sub = date('d-m-Y H:i', strtotime(''.$encomenda["data_submissao"].' '.$encomenda["hora_submissao"].'')); echo $data_sub;?>
						<td style='text-align:center'><?php if($encomenda["data_env"] != NULL AND $encomenda["hora_env"] != NULL) {$data_env = date('d-m-Y H:i', strtotime(''.$encomenda["data_env"].' '.$encomenda["hora_env"].'')); echo $data_env;}?></td>
						<td style='text-align:center'><?php if($encomenda["data_entr"] != NULL AND $encomenda["hora_entr"] != NULL) {$data_entr = date('d-m-Y H:i', strtotime(''.$encomenda["data_entr"].' '.$encomenda["hora_entr"].'')); echo $data_entr;}?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["estado"].'';?></td>
						<td style='text-align:center'><?php $id = $encomenda["id_e"];
								  if ($encomenda["estado"] == "Pendente") echo"<a onclick='event.preventDefault(); return ConfirmarDelete($id)' href=#><img src='../img/delete.png' height='22em'></a>";?></td>
					  </tr>
					  <?php }
		echo "
			</table>";



		if ($paginas_totais>1) {
		$pagLink = "<div class='pagination'>";
		for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='dados_pessoais2.php?page=".$i."'>".$i."</a>";
		echo $pagLink . "</div>";
		}
		      ?> <hr style="width:50px;border:5px solid red" class="w3-round">
			<h2 class="w3-text-red"><b>Pesquisar Informações</b></h2>
				<form style="display:inline;" method='post' action='filter.php'>
					<select class="w3-select" id="estado" name="estado" required>
					  <option value="" disabled selected>Estado</option>
					  <option value="Pendente">Pendente</option>
					  <option value="Enviada">Enviada</option>
					  <option value="Entregue">Entregue</option>
					</select>
				<p></p>
					  <input class="w3-btn w3-red" type='submit' name='pesquisar' value='Pesquisar'></input><p></p>
				</form> <?php if (isset($_SESSION["estado"])) { ?> <a class="w3-btn w3-red" href="dados_pessoais2.php">Mostrar todas</a>

	 <?php
				}
	  }

	}

?>
