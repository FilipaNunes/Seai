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
				  </tr>";
		}
		echo" </tbody>
			  </table>
			  <p font-color='#f44336'> Custo Total: "; print_r($custo_total); echo"€</p>";
			  
	}
}

?>