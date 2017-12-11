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
		
		
		$query = "SELECT tmedio_ent_cat, n_enc_cat, entrega_sucesso, n_reclamacoes, entrega_dano FROM kpis ORDER BY tmedio_ent_cat OFFSET $inicio LIMIT $limite";
		$result = execQuery($query,null,null);
		$num_registos = $result->rowCount($result);
	
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$tmedio_ent_cat = $array['tmedio_ent_cat'];
			$n_enc_cat = $array['n_enc_cat'];
			$entrega_sucesso = $array['entrega_sucesso'];
			$n_reclamacoes = $array['n_reclamacoes'];
			$entrega_dano = $array['entrega_dano'];			
					
			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $tmedio_ent_cat </td>
					<td style='text-align:center'> $n_enc_cat </td>
					<td style='text-align:center'> $entrega_sucesso </td>
					<td style='text-align:center'> $n_reclamacoes </td>
					<td style='text-align:center'> $entrega_dano </td>					
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
