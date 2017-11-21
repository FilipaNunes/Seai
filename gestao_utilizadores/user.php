<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>



<?php

	function Utilizadores(){
	
		$query = "SELECT username, morada, email, telemovel FROM clientes";
		$query2 = "SELECT COUNT(id_e),id_c FROM faz GROUP BY id_c ORDER BY id_c ASC";
		
		$result = execQuery($query,null,null);
		$result2 = execQuery($query2,null,null);
		
		$num_registos = $result->rowCount($result);
		
		for($i=0;$i<$num_registos;$i++){
			$array = $result->fetch();
			$username = $array['username'];
			$morada = $array['morada'];
			$email = $array['email'];
			$telemovel = $array['telemovel'];
			$n_encomendas = $result2->fetch();
			$encomendas = $n_encomendas['count'];
			
			echo"
				<tr style='text-align:center'>
					<td style='text-align:center'> $username </td>
					<td style='text-align:center'> $morada </td>
					<td style='text-align:center'> $email </td>
					<td style='text-align:center'> $telemovel </td>
					<td style='text-align:center'> $encomendas</td>
					<td style='text-align:center'><img src='../img/delete.jpg' height='10%'></td>
				</tr>
			";
		}
	}

?>
