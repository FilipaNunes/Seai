<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php		

	function Table(){
		
		$limite = 6;  
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;  
		$inicio = ($page-1) * $limite;  
  	
		$query = "SELECT id_e FROM faz";
		
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
			$encomenda = $result->fetch(); ?>
					
						<tr style='text-align:center'>
						<td style='text-align:center'><?=$encomenda["nome_completo"]?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["tipo_encomenda"].'';?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["custo"].'';?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["morada_destino"].'';?></td>
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