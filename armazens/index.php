<?php include_once('armazens.php'); ?>


<!DOCTYPE html>
<html>
<head>
  <title>Drone2u</title>
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/notificacao.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

<script src='armazens.js' charset='utf-8'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

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
	if ($_SESSION["user_id"] == NULL) header("Location: ../index.php");
	print_r($_SESSION["user_id"]);
	$user_data = user_data_db();
    $user_data1 = $user_data->fetch(PDO::FETCH_ASSOC);
?>
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
		<a href="../login/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Login</a>
  <?php }
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 0) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a class="w3-bar-item w3-button w3-red"><?=$user_data1["username"]?></a>
		<a href="../carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
		<a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
  <?php }
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 1) { ?>
		<a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">Armazéns</a>
		<a href="../gestao_utilizadores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Utilizadores</a>
		<a href="../gestao_funcionarios/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Funcionários</a>
		<a href="../entregas/entregas.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Entregas</a>
		<a href="../financas/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Finanças</a>
		<a href="../kpis/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">KPIs</a>
		<hr style="border-width: 2px; border-color: red">
		<a class="w3-bar-item w3-button w3-hover-red" href="../dados_pessoais/dados_pessoais.php"><?=$user_data1["username"]?></a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Armazéns</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <div class="w3-container">
      <div class="w3-row w3-center">
        <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Dados dos Armazéns');">
          <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Dados dos Armazéns</div>
        </a>
        <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Inserir Armazém');">
          <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Inserir Armazém</div>
        </a>
      </div>


      <div id="Dados dos Armazéns" class="w3-container armazens" style="display:none">
        <p></p>
        <div class="w3-row">
        <table class="w3-table-all">
        <tbody>
      	<tr>
        	<th style='background-color:#f44336; text-align:center'> <font color='white'> Nome do Armazém</th>
        	<th style='background-color:#f44336; text-align:center'> <font color='white'> Morada </th>
        	<th style='background-color:#f44336; text-align:center'> <font color='white'> Lotação atual</th>
        	<th style='background-color:#f44336; text-align:center'> <font color='white'> Lotação máxima </th>
        	<th style='background-color:#f44336; text-align:center'> <font color='white'></th>
      	</tr>
	       <?php armazens(); ?>
      </div>
    </div>

  <div id="Inserir Armazém" class="w3-container armazens" style="display:none">
    <p></p>
  	<form class="w3-container w3-card-4" >
      <p></p>
      <label class="w3-text-red"><b>Nome</b></label>
      <input class="w3-input border" id="nome" name="nome" type="text" placeholder='Inserir nome do armazém' pattern='[a-zA-Z0-9\s]{3,40}' required></p>
      <div id="n_disponivel" style="color:#f44336"></div>
      <p>
      <label class="w3-text-red"><b>Morada</b></label>
      <input class="w3-input w3-border" id="morada_arm" name="morada_arm" type="text" placeholder='Inserir morada do armazém' pattern='[a-zA-Z0-9\s]{3,40}' required></p>
      <p>
      <label class="w3-text-red"><b>Lotação Máxima</b></label>
      <input class="w3-input w3-border" id="lotacao_max" name="lotacao_max" type="text" placeholder=' Inserir lotação máxima do armazém' pattern='[0-9]{1,5}' required></p>
      <p>
      <input class="w3-red w3-input" type='submit' name='btnSubmit' value='Adicionar Novo Armazém' id='btnSubmit' onClick='event.preventDefault(); AdicionarArmazem()'>
    </form>
  </div>

<script>
  function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("armazens");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
       tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.firstElementChild.className += " w3-border-red";
  }
</script>

<script>
  var mybtn = document.getElementById("testbtn");
  mybtn.click();
</script>

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
