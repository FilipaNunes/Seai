<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php

	function Utilizadores(){

		$limite = 8;
		if (isset($_GET["page"])) $page  = $_GET["page"];
		else $page=1;
		$inicio = ($page-1) * $limite;

		$query = "SELECT id_c FROM clientes";
		$query2 = "SELECT COUNT(id_e),id_c FROM faz GROUP BY id_c ";

		$result = execQuery($query,null,null);
		$result2 = execQuery($query2,null,null);

		$num_registos = $result->rowCount($result);
		$n_encomendas = $result2->fetchAll();

		$paginas_totais = ceil($num_registos / $limite);

		$query = "SELECT id_c,username, nome_completo, morada, email, telemovel FROM clientes ORDER BY username OFFSET $inicio LIMIT $limite";
		$result = execQuery($query,null,null);
		$num_registos = $result->rowCount($result);

		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$id = $array['id_c'];
			$username = $array['username'];
			$nome = $array['nome_completo'];
			$morada = $array['morada'];
			$email = $array['email'];
			$telemovel = $array['telemovel'];

			$key = array_search($id,array_column($n_encomendas,'id_c'));

			if($key===false)$encomendas = 0;
			else $encomendas = $n_encomendas[$key]['count'];

			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $username </td>
					<td style='text-align:center'> $nome </td>
					<td style='text-align:center'> $morada </td>
					<td style='text-align:center'> $email </td>
					<td style='text-align:center'> $telemovel </td>
					<td style='text-align:center'> $encomendas </td>
					<td style='text-align:center'>
						<a onclick='event.preventDefault(); ConfirmarDelete($id)' href=#>
							<img src='../img/delete.png' height='10%'>
						</a>
					</td>
				</tr>
				";
		}
		echo "
			</tbody>
			</table>";

		$pagLink = "<div class='pagination'>";
		if($paginas_totais>1) {
			for ($i=1; $i<=$paginas_totais; $i++) $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";
			echo $pagLink . "</div>";
		}


	}

?>
