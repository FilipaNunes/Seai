<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>

<?php include_once("database/database.php");?>

<?php		

	function armazens(){
		
		$limite = 3;  
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;  
		$inicio = ($page-1) * $limite;  
  	
		$query = "SELECT id_a FROM armazem";
		
		$result = execQuery($query,null,null);

		$num_registos = $result->rowCount($result);
		$paginas_totais = ceil($num_registos / $limite);
		
		
		$query = "SELECT id_a, nome, morada_arm, ocupacao, lotacao_max FROM armazem ORDER BY nome OFFSET $inicio LIMIT $limite";
		$result = execQuery($query,null,null);
		$num_registos = $result->rowCount($result);
	
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$id = $array['id_a'];
			$nome = $array['nome'];
			$morada_arm = $array['morada_arm'];
			$ocupacao = $array['ocupacao'];
			$lotacao_max = $array['lotacao_max'];
				
					
			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $nome </td>
					<td style='text-align:center'> $morada_arm </td>
					<td style='text-align:center'> $ocupacao </td>
					<td style='text-align:center'> $lotacao_max</td>
					<td style='text-align:center'>
						<a onclick='event.preventDefault(); return ConfirmarDelete($id)' href=#>
							<img src='../img/delete.jpg' height='10%'>
						</a>
					</td>
				</tr>
				";
		}
		echo "
			</tbody>
			</table>";
		  
		$pagLink = "<div class='pagination'>";  
		for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";  
		echo $pagLink . "</div>"; 
		
	
	}

?>