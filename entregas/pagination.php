<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php

	function Table(){

		$limite = 6;
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
			if(!(is_numeric($page) == 1)) $page = 1;
		}
		else $page=1;
		$inicio = ($page-1) * $limite;

		$query = "SELECT id_e FROM faz
				  WHERE id_e IS NOT NULL";

		$result = execQuery($query,null,null);

		$num_registos = $result->rowCount($result);

		$paginas_totais = ceil($num_registos / $limite);

		$query = "SELECT * FROM faz
				  JOIN encomenda ON faz.id_e=encomenda.id_e
				  JOIN clientes ON faz.id_c=clientes.id_c
				  ORDER BY encomenda.id_e DESC
				  OFFSET $inicio
				  LIMIT $limite";
		$result = execQuery($query,null,null);
		$num_registos = $result->rowCount($result);

		for($i=0;$i<$num_registos;$i++){
			$encomenda = $result->fetch();
			$query = "SELECT morada_arm FROM ponto_entrega_recolha WHERE id_er = :id_entrega";

			$values = array($encomenda["ponto_entrega"]);
			$insert = array(':id_entrega');

			$destino_temp = execQuery($query,$insert,$values);
			$destino = $destino_temp->fetch();

			$query = "SELECT morada_arm FROM ponto_entrega_recolha WHERE id_er = :id_recolha";

			$values = array($encomenda["ponto_recolha"]);
			$insert = array(':id_recolha');

			$destino2_temp = execQuery($query,$insert,$values);
			$destino2 = $destino2_temp->fetch();

			$query = "SELECT morada_arm FROM armazem WHERE id_a = :id_recolha";

			$values = array($encomenda["armazem_recolha"]);
			$insert = array(':id_recolha');

			$destino3_temp = execQuery($query,$insert,$values);
			$destino3 = $destino2_temp->fetch();

			?>

						<tr style='text-align:center'>
						<td style='text-align:center'><?=$encomenda["nome_completo"]?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["tipo_encomenda"].'';?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["custo"].'';?></td>
						<td style='text-align:center'><?php echo ''.$destino['morada_arm'].'';?></td>
						<td style='text-align:center'><?php if ($destino2 != NULL AND $destino3 == NULL) echo ''.$destino2['morada_arm'].'';
								  if ($destino2 == NULL AND $destino3 != NULL) echo ''.$destino3['morada_arm'].'';
								  if ($destino2 == NULL AND $destino3 == NULL) echo 'Indefinido';?></td>
						<td style='text-align:center'><?php if($encomenda["data_env"] != NULL AND $encomenda["hora_env"] != NULL) {$data_env = date('d-m-Y H:i', strtotime(''.$encomenda["data_env"].' '.$encomenda["hora_env"].'')); echo $data_env;}?></td>
						<td style='text-align:center'><?php if($encomenda["data_entr"] != NULL AND $encomenda["hora_entr"] != NULL) {$data_entr = date('d-m-Y H:i', strtotime(''.$encomenda["data_entr"].' '.$encomenda["hora_entr"].'')); echo $data_entr;}?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["estado"].'';?></td>
						<td style='text-align:center'><?php $id = $encomenda["id_e"];
								  if ($encomenda["estado"] == "Pendente") echo"<a onclick='event.preventDefault(); return ConfirmarDelete($id)' href=#><img src='../img/delete.png' height='10%'></a>";?></td>
					  </tr>
					  <?php }
		echo "
			</table>";

		if ($paginas_totais>1) {
		$pagLink = "<div class='pagination'>";
		for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='entregas.php?page=".$i."'>".$i."</a>";
		echo $pagLink . "</div>";
		}


	}

?>
