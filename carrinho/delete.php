<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php
	session_start();
	include_once("database/database.php");
?>

<?php		
	 if(isset($_GET['id'])){
		 
        $id=$_GET['id'];
		$limite = count($_SESSION["carrinho"]["servico"]);
				
		for($i=$id;$i<$limite;$i++){
			$next = $i + 1;
			$_SESSION['carrinho']['servico'][$i] = $_SESSION['carrinho']['servico'][$next];
			$_SESSION['carrinho']['produto'][$i] = $_SESSION['carrinho']['produto'][$next];
			$_SESSION['carrinho']['peso'][$i] = $_SESSION['carrinho']['peso'][$next];
			$_SESSION['carrinho']['dimensoes'][$i] = $_SESSION['carrinho']['dimensoes'][$next];
			$_SESSION['carrinho']['recolha'][$i] = $_SESSION['carrinho']['recolha'][$next];
			$_SESSION['carrinho']['destino'][$i] = $_SESSION['carrinho']['destino'][$next];
			$_SESSION['carrinho']['custo'][$i] = $_SESSION['carrinho']['custo'][$next];
			$_SESSION['carrinho']['quantidade'][$i] = $_SESSION['carrinho']['quantidade'][$next];
		}
		
		array_pop($_SESSION['carrinho']['servico']);
		array_pop($_SESSION['carrinho']['produto']);
		array_pop($_SESSION['carrinho']['peso']);
		array_pop($_SESSION['carrinho']['dimensoes']);
		array_pop($_SESSION['carrinho']['recolha']);
		array_pop($_SESSION['carrinho']['destino']);
		array_pop($_SESSION['carrinho']['custo']);
		array_pop($_SESSION['carrinho']['quantidade']);
		
		$limite = count($_SESSION["carrinho"]["servico"]);
		print_r($limite);

		if($limite === 0) $_SESSION['carrinho'] = array();
		
        header('location:index.php');
      }

?>
