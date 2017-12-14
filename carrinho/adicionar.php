<?php

	session_start();

	$servico = $_POST['servico'];
	$produto = $_POST['produto'];
	$dimensoes = $_POST['dimensoes'];
	$peso = $_POST['peso'];
	$quantidade = $_POST['quantidade'];
	$recolha = $_POST['recolha'];
	$destino = $_POST['destino'];
	$custo = $_POST['custo'];
	$ponto_recolha = $_POST['ponto_recolha'];

	$limite_inf = $servico - 1;

	$servico = '>'.$limite_inf.' a '.$servico.'kg';

	$i=0;

	if(isset($_SESSION['carrinho']))
		$i = count($_SESSION["carrinho"]["servico"]);

	$_SESSION["carrinho"]["servico"][$i] = $servico;
	$_SESSION["carrinho"]["produto"][$i] = $produto;
	$_SESSION["carrinho"]["dimensoes"][$i] = $dimensoes;
	$_SESSION["carrinho"]["peso"][$i] = $peso;
	$_SESSION["carrinho"]["quantidade"][$i] = $quantidade;
	$_SESSION["carrinho"]["recolha"][$i] = $recolha;
	$_SESSION["carrinho"]["destino"][$i] = $destino;
	$_SESSION["carrinho"]["custo"][$i] = $custo;
	$_SESSION["carrinho"]["ponto_recolha"][$i] = $ponto_recolha;

?>
