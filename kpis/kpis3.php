<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>

<?php include_once("database/database.php");?>

<?php		

	function kpis3(){
		
		$limite = 3;  
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;  
		$inicio = ($page-1) * $limite;  
  	
		$query = "SELECT id_k FROM kpis";
		
		$result = execQuery($query,null,null);

		$num_registos = $result->rowCount($result);
		$paginas_totais = ceil($num_registos / $limite);
		
		
		$query = "SELECT percen_ocupacao, tempo_exp_medio, danos_man_encomenda FROM kpis ORDER BY percen_ocupacao OFFSET $inicio LIMIT $limite";
		$result = execQuery($query,null,null);
		$num_registos = $result->rowCount($result);
	
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$percen_ocupacao = $array['percen_ocupacao'];
			$tempo_exp_medio = $array['tempo_exp_medio'];
			$danos_man_encomenda = $array['danos_man_encomenda'];
		
					
			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $percen_ocupacao </td>
					<td style='text-align:center'> $tempo_exp_medio</td>
					<td style='text-align:center'> $danos_man_encomenda </td>
					
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
