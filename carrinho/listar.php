<?php

function ListaCarrinho(){
	
	if(isset($_SESSION['carrinho'])){
		$custo_total = 0;
		$limite = count($_SESSION["carrinho"]["servico"]);
		for($i=0;$i<$limite;$i++){
			$custo_total = $custo_total + ($_SESSION['carrinho']['custo'][$i]);
			echo" 
				  <tr>
				  <td style='text-align:center'>"; print_r($_SESSION['carrinho']['servico'][$i]);
			echo" </td>
				  <td style='text-align:center'>";print_r($_SESSION['carrinho']['produto'][$i]);
			echo" </td>
				  <td style='text-align:center'>";print_r($_SESSION['carrinho']['peso'][$i]);
			echo" </td>
				  <td style='text-align:center'>";print_r($_SESSION['carrinho']['dimensoes'][$i]);
			echo" </td>
				  <td style='text-align:center'>";print_r($_SESSION['carrinho']['recolha'][$i]);
			echo" </td>
				  <td style='text-align:center'>"; print_r($_SESSION['carrinho']['destino'][$i]);
			echo" </td>
				  <td style='text-align:center'>"; print_r($_SESSION['carrinho']['custo'][$i]);
			echo" </td>
				  <td style='text-align:center'>"; print_r($_SESSION['carrinho']['quantidade'][$i]);
			echo" </td>
				  <td>
					<a onclick='event.preventDefault(); return ConfirmarDelete($i)' href=#>
							<img src='../img/delete.png' height='22em'>
					</a>
				  </td>
				  </tr>";
		}
		echo" </tbody>
			  </table>
			  <p font-color='#f44336'> Custo Total: "; print_r($custo_total); echo"€</p>";
			  
	}
}

function Campos($id){
	
	$query = "SELECT nome_completo,morada,telemovel,nif FROM clientes WHERE id_c= :id";
	
	$values = array($id);
	$insert = array(':id');
	
	$result = execQuery($query,$insert,$values);
	
	$dados = $result->fetch();
	
	if($dados['nome_completo'] == null || $dados['morada'] == null || $dados['telemovel'] == null || $dados['nif'] == null) return false;
	else return true;
	
	
}

?>