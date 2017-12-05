<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>

<?php include_once("database/database.php");?>

<?php		

	function funcionario(){
		
		$limite = 3;  
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;  
		$inicio = ($page-1) * $limite;  
  

		if(isset($_POST['option'])){

			$mes=$_POST['option'];

			$query = "SELECT nif FROM funcionario";
			
			$result = execQuery($query,null,null);
			
			$num_registos = $result->rowCount($result);
			$paginas_totais = ceil($num_registos / $limite);
			
			$query = "Select * FROM funcionario WHERE mes = ".$mes.";";
			$result = execQuery($query,null,null);
			$num_registos = $result->rowCount($result);
		
			for($i=0;$i<$num_registos;$i++){
				$array = $result->fetch();
				$nome_completo = $array['nome_completo'];
				$morada = $array['morada'];
				$email = $array['email'];
				$telemovel = $array['telemovel'];
				$n_faltas_just = $array['n_faltas_just'];
				$n_faltas_injust = $array['n_faltas_injust'];
				$atrasos = $array['atrasos'];
				$atingiu_obj = $array['atingiu_obj'];
				$salario = $array['salario'];
			}

			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $nome_completo </td>
					<td style='text-align:center'> $morada </td>
					<td style='text-align:center'> $email </td>
					<td style='text-align:center'> $telemovel </td>
					<td style='text-align:center'> $n_faltas_just </td>
					<td style='text-align:center'> $n_faltas_injust </td>
					<td style='text-align:center'> $atrasos </td>
					<td style='text-align:center'> $atingiu_obj </td>
					<td style='text-align:center'> $salario </td>
				
						</a>
					</td>
				</tr>
				";

			unset($_POST['option']);
		}

		else{

			$query = "SELECT nif FROM funcionario";
			
			$result = execQuery($query,null,null);
			
			$num_registos = $result->rowCount($result);
			$paginas_totais = ceil($num_registos / $limite);
		
			$query = "SELECT nome_completo, morada, email, telemovel, SUM(n_faltas_just) AS n_faltas_just, SUM(n_faltas_injust) AS n_faltas_injust, SUM(atrasos) AS atrasos, salario, atingiu_obj FROM funcionario GROUP BY nome_completo, nome_completo, morada, email, telemovel, salario, atingiu_obj";
			$result = execQuery($query,null,null);
			$num_registos = $result->rowCount($result);
		
			for($i=0;$i<$num_registos;$i++){
				$array = $result->fetch();
				$nome_completo = $array['nome_completo'];
				$morada = $array['morada'];
				$email = $array['email'];
				$telemovel = $array['telemovel'];
				$n_faltas_just = $array['n_faltas_just'];
				$n_faltas_injust = $array['n_faltas_injust'];
				$atrasos = $array['atrasos'];
				$atingiu_obj = $array['atingiu_obj'];
				$salario = $array['salario'];
			}
				
					
			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $nome_completo </td>
					<td style='text-align:center'> $morada </td>
					<td style='text-align:center'> $email </td>
					<td style='text-align:center'> $telemovel </td>
					<td style='text-align:center'> $n_faltas_just </td>
					<td style='text-align:center'> $n_faltas_injust </td>
					<td style='text-align:center'> $atrasos </td>
					<td style='text-align:center'> $atingiu_obj </td>
					<td style='text-align:center'> $salario </td>
				
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
