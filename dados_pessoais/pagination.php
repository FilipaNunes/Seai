<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php		

	function Table(){
		
		$limite = 6;  
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;  
		$inicio = ($page-1) * $limite;  
		
		$user_id = $_SESSION["user_id"];
		
		$query = "SELECT id_c FROM faz
				  WHERE id_c=:id";
				  
		$values = array($user_id);
		$insert = array(':id');
  	
		$result = execQuery($query,$insert,$values);
		
		$num_registos = $result->rowCount($result);
		
		$paginas_totais = ceil($num_registos / $limite);
		
		$query = "SELECT * FROM faz
				  JOIN encomenda ON faz.id_e=encomenda.id_e
				  WHERE id_c = :id
				  ORDER BY encomenda.id_e DESC
				  OFFSET $inicio
				  LIMIT $limite";
				  
		$values = array($user_id);
		$insert = array(':id');
		
		$result = execQuery($query,$insert,$values);
		$num_registos = $result->rowCount($result);
	
		for($i=0;$i<$num_registos;$i++){
			$encomenda = $result->fetch(); ?>
					
						<tr style='text-align:center'>
						<td style='text-align:center'><?php if(0 < $encomenda["peso"] AND 1 >= $encomenda["peso"]) echo "0 a 1 Kg";
								  if(1 < $encomenda["peso"] AND 2 >= $encomenda["peso"]) echo "1 a 2 Kg";
								  if(2 < $encomenda["peso"] AND 3 >= $encomenda["peso"]) echo "2 a 3 Kg";
								  if(3 < $encomenda["peso"] AND 4 >= $encomenda["peso"]) echo "3 a 4 Kg";?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["tipo_encomenda"].'';?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["custo"].'';?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["morada_destino"].'';?></td>
						<td style='text-align:center'><?php if($encomenda["data_env"] != NULL AND $encomenda["hora_env"] != NULL) {$data_env = date('d-m-Y H:i', strtotime(''.$encomenda["data_env"].' '.$encomenda["hora_env"].'')); echo $data_env;}?></td>
						<td style='text-align:center'><?php if($encomenda["data_entr"] != NULL AND $encomenda["hora_entr"] != NULL) {$data_entr = date('d-m-Y H:i', strtotime(''.$encomenda["data_entr"].' '.$encomenda["hora_entr"].'')); echo $data_entr;}?></td>
						<td style='text-align:center'><?php echo ''.$encomenda["estado"].'';?></td>
						<td style='text-align:center'><?php $id = $encomenda["id_e"];
								  if ($encomenda["estado"] == "Pendente") echo"<a href='update_encomenda.php?id=$id'><img src='../img/edit.png' height='10%'></a><a onclick='event.preventDefault(); return ConfirmarDelete($id)' href=#><img src='../img/delete.png' height='10%'></a>";?></td>
					  </tr>
					  <?php }
		echo "
			</table>";
		
		if ($paginas_totais>1) {
		$pagLink = "<div class='pagination'>";  
		for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='dados_pessoais2.php?page=".$i."'>".$i."</a>";  
		echo $pagLink . "</div>";  
		}
		
	
	}

?>
