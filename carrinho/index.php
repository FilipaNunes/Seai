<?php 
		include_once('listar.php');
?>

<!DOCTYPE html>
<html>
<title>Drone2u</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<script src='carrinho.js' charset='utf-8'></script>

<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;}
</style>
<body>

<!-- Sidebar/menu -->
<?php 
	include_once("../database/database.php");
	include_once("../login/session.php"); 
	$user_data = user_data_db();
    $user_data1 = $user_data->fetch(PDO::FETCH_ASSOC); ?>
<nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Fechar Menu</a>
  <div class="w3-container w3-center">
    <img src="../img/icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
		<a href="../index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Home</a>
		<a href="../servicos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Serviços</a>
		<a href="../contactos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
		<a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
  <?php if ($_SESSION["user_id"] == NULL) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a href="../login/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Login</a>
  <?php } 
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 0) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["nome_completo"]?></a>
		<a class="w3-bar-item w3-button w3-red">Carrinho</a>
		<a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
  <?php } 
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 1) { ?>
		<a href="../frotas/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Frota</a>
		<a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Armazéns</a>
		<a href="../gestao_utilizadores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Utilizadores</a>
		<a href="../gestao_funcionarios/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Funcionários</a>
		<a href="../entregas/entregas.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Entregas</a>
		<a href="../financas/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Finanças</a>
		<a href="../kpis/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">KPIs</a>
		<hr style="border-width: 2px; border-color: red">
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["nome_completo"]?></a>
		<a class="w3-bar-item w3-button w3-red">Carrinho</a>
		<a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
  <?php } ?>
  </div>
  </br>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Drone2u</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="Fechar Menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Packages / Pricing Tables -->
  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Carrinho</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <?php
		if($_SESSION["carrinho"] == NULL){
			
			echo"
				<p>O carrinho está vazio!</p>
			";
			
			
		}else{
				echo"
				  <table class='w3-table-all'>
				  <tbody>
					<tr >
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Serviço</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Produto</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Peso</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Dimensões</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Ponto Recolha</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Morada de Destino</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Preço Previsto</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> Quantidade</th>
					<th style='background-color:#f44336; text-align:center'> <font color='white'> </th>
					</tr>
					";ListaCarrinho();
				  echo"<p></p>";

				if($_SESSION["user_id"] == NULL){
					echo"
						<a href='../login/index.html'><button class='w3-btn w3-red'>Tem de fazer login para finalizar a encomenda!</button></a>
					";
				}else{
					echo"
						<form action='finalizar.php' id='finalizar'>
							<button type='submit' form='finalizar' class='w3-btn w3-red' id='btnSubmit' onClick='event.preventDefault(); Finalizar()'>Finalizar Compra</button>
						</form>
					";
				}
		}
  ?>
  <!-- End page content -->
  </div>
  
  <script>
  // Script to open and close sidebar
  function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
  }

  function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
  }

  </script>

  </body>
  </html>
