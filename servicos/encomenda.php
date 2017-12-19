<?php

	include_once("servicos.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Drone2u</title>
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href="../css/notificacao.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<script src='servicos.js' charset='utf-8'></script>
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
		<a href="../servicos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">Serviços</a>
		<a href="../contactos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
		<a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
  <?php if ($_SESSION["user_id"] == NULL) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a href="../carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
		<a href="../login/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Login</a>
  <?php }
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 0) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["username"]?></a>
		<a href="../carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
		<a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
  <?php }
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 1) { ?>
		<a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Armazéns</a>
		<a href="../gestao_utilizadores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Utilizadores</a>
		<a href="../gestao_funcionarios/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Funcionários</a>
		<a href="../entregas/entregas.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Entregas</a>
		<a href="../financas/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Finanças</a>
		<a href="../kpis/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">KPIs</a>
		<hr style="border-width: 2px; border-color: red">
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["username"]?></a>
		<a href="../carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Encomenda</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <form class="w3-container w3-card-4" id="encomenda" onsubmit="event.preventDefault(); return Adicionado()">
    <p>
    <label class="w3-text-red"><b>Serviço</b></label>
    <select class="w3-select" name="option" id="limite_peso" onChange='VerificaCategoria()' required>
	<?php
		if(isset($_GET['first']))
		{
			echo'<option value="0.5" selected>0 a 0,5 Kg</option>
				 <option value="1">>0,5 a 1 Kg</option>
				 <option value="1.5">>1 a 1,5 kg</option>
				 <option value="2">>1,5 a 2 kg</option>';
		}
		elseif(isset($_GET['second']))
		{
			echo'<option value="0.5">0 a 0,5 Kg</option>
				 <option value="1" selected>>0,5 a 1 Kg</option>
				 <option value="1.5">>1 a 1,5 kg</option>
				 <option value="2">>1,5 a 2 kg</option>';
		}
		elseif(isset($_GET['third']))
		{
			echo'<option value="0.5">0 a 0,5 Kg</option>
				 <option value="1">>0,5 a 1 Kg</option>
				 <option value="1.5" selected>>1 a 1,5 kg</option>
				 <option value="2">>1,5 a 2 kg</option>';
		}
		elseif(isset($_GET['fourth']))
		{
			echo'<option value="0.5">0 a 0,5 Kg</option>
				 <option value="1">>0,5 a 1 Kg</option>
				 <option value="1.5">>1 a 1,5 kg</option>
				 <option value="2" selected>>1,5 a 2 kg</option>';
		}
		else
		{
			echo'<option value="0.5">0 a 0,5 Kg</option>
				 <option value="1">>0,5 a 1 Kg</option>
				 <option value="1.5">>1 a 1,5 kg</option>
				 <option value="2">>1,5 a 2 kg</option>';
		}
	?>
  </select></p>
    <p>
    <label class="w3-text-red"><b>Produto</b></label>
    <select class="w3-select" name="option" id="produto" required>
    <option value="" disabled selected>Escolher</option>
    <option value="1">Artigos tecnológicos</option>
    <option value="2">Relógio</option>
    <option value="3">Vestuário</option>
	<option value="4">Cosméticos</option>
	<option value="5">Artigos de Papelaria</option>
	<option value="6">Brinquedos</option>
	<option value="7">Pequenos Eletrodomésticos</option>
	<option value="8">Artigos de Cuidado Pessoal</option>
  </select> Para mais informações sobre os produtos clique <a target="_blank" href="informacoes.php">aqui</a> </p>
	<p>
    <label class="w3-text-red"><b>Dimensões</b></label>
    <input class="w3-input border" name="dim" id="dim" type="text" placeholder="Dimensões máximas 22x14x4 cm" title='As dimensões devem ser inseridas em centímetros com o seguinte formato comprimentoxlarguraxaltura' onChange='VerificarDimensao()' pattern='([0-9]{1,2})+[x]+([0-9]{1,2})+[x]+([0-9]{1,2})' required></p>
		<div id='dim_errada' style='color:#f44336'></div>
	</p>
	<p>
    <label class="w3-text-red"><b>Peso</b></label>
    <input class="w3-input border" name="peso" id="peso" type="text" placeholder='Insira um peso compreendido no serviço que escolheu' title='Deve ser inserido em quilogramas com o seguinte formato 1.3 ou 1!' onChange= 'VerificaPeso()' pattern='([0-9]+[.]+[0-9])|([0-9])' required></p>
		<div id='peso_errado' style='color:#f44336'></div>
	</p>
	<p>
    <label class="w3-text-red"><b>Quantidade</b></label>
    <input class="w3-input border" name="quant" id="quant" type="text" title='Quantidade de produtos com as características inseridas.' onChange='Quantidade()' pattern='([0-9]{1,2})' required></p>
		<div id='quant_errada' style='color:#f44336'></div>
	</p>
    <p>
    <label class="w3-text-red"><b>Escolha o ponto de recolha:</b></label><p></p>
		<input type="radio" name="ponto_recolha" id="armazem"
		<?php if (isset($ponto_recolha) && $ponto_recolha=="armazem"){
			echo "checked";
		}
		?>
		value = "armazem" onClick='Recolha()'/>Armazém
		<input type="radio" name="ponto_recolha" id="recolha"
		<?php if (isset($ponto_recolha) && $ponto_recolha=="recolha"){
						echo "checked";
					}
		?>
		value = "recolha" onClick='Recolha()' required/>Ponto de Recolha
		<div id="ponto_recolha"> </div>
    <p>
    <label class="w3-text-red"><b>Morada de destino</b></label>
    <select class="w3-select" name="option2" id="destino" required>
    <option value="" disabled selected>Escolher</option>
    <?php MoradaEntrega(); ?>
	</select>
	</p>
    <p>
    <label class="w3-text-red"><b>Preço previsto(€)</b></label></p>
    <p id="custo"> </p>
    <p>
    <input class="w3-input w3-red" name='btnSubmit' id="btnSubmit" type='submit' value='Adicionar ao Carrinho'>
	</p>
  </form>

  <!-- End page content -->
  </div>

  <div id='notification-container' class='notification-container'></div>


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
