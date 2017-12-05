<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>

<?php include_once("database/database.php");?>

<?php		

	function kpis(){
		
		$limite = 3;  
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;  
		$inicio = ($page-1) * $limite;  
  	
		$query = "SELECT id_k FROM kpis";
		
		$result = execQuery($query,null,null);

		$num_registos = $result->rowCount($result);
		$paginas_totais = ceil($num_registos / $limite);
		
		
		$query = "SELECT mes, esperados, atingidos FROM kpis ORDER BY mes OFFSET $inicio LIMIT $limite";
		$result = execQuery($query,null,null);
		$num_registos = $result->rowCount($result);
	
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$mes = $array['mes'];
			$esperados = $array['esperados'];
			$atingidos = $array['atingidos'];
			
					
			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $mes </td>
					<td style='text-align:center'> $esperados </td>
					<td style='text-align:center'> $atingidos </td>
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
