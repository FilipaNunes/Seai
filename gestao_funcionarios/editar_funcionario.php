<?php include_once('infor_func.php') ?>


<!DOCTYPE html>
<html>
<head>
  <title>Drone2u</title>
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/notificacao.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

  <script src='funcionarios.js' charset='utf-8'></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <style>
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:16px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;}
  </style>
</head>

<body>

<!-- Sidebar/menu -->
<?php
	include_once("../database/database.php");
	include_once("../login/session.php");
	if ($_SESSION["user_id"] == NULL OR check_admin_db() == 0) header("Location: ../index.php");
	$user_data = user_data_db();
  $user_data1 = $user_data->fetch(PDO::FETCH_ASSOC);
  if(!isset($_GET['id'])) header('Location: index.php');
  if(isset($_GET['id']) && (!(is_numeric($_GET['id']) == 1))) header('Location: index.php');
  if(VerificarId($_GET['id']) != true) header('Location: index.php');

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
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["username"]?></a>
		<a href="../carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
		<a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
  <?php }
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 1) { ?>
		<a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Armazéns</a>
		<a href="../gestao_utilizadores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Utilizadores</a>
		<a class="w3-bar-item w3-button w3-red">Gestão de Funcionários</a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Gestão de Funcionários</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round w3-left">
  </div>

	<div class="w3-container">
    <div class="w3-row">
      <p></p>
    	<form class="w3-container w3-card-4" onsubmit='event.preventDefault(); return EditarFuncionario();' method="POST" id="form" accept-charset="UTF-8">
        <?php  $informacoes =  Get_Informacoes($_GET['id']); ?>
        <p>
        <label class="w3-text-red"><b>Nome do Funcionário: </b></label> <?php print_r($informacoes['nome_completo'])?>
        <p>
        <label class="w3-text-red"><b>Morada</b></label>
        <input class="w3-input w3-border" id="morada" name="morada" type="text" placeholder='<?php print_r($informacoes['morada'])?>' pattern='[a-zA-Z0-9\s]{3,40}' required></p>
        <p>
        <label class="w3-text-red"><b>Email</b></label>
        <input class="w3-input border" id="email" name="email" type="email" placeholder='<?php print_r($informacoes['email'])?>' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}' onblur='CheckEmail2(function(){})' required></p>
        <div id="email_indis" style="color:#f44336"></div>
        <p>
        <label class="w3-text-red"><b>Contacto telefónico</b></label>
        <input class="w3-input w3-border" id="telemovel" name="telemovel" type="text" placeholder='<?php print_r($informacoes['telemovel'])?>' pattern='[0-9]{9}'maxlength="9" required></p>
        <p>
         <label class="w3-text-red"><b>NIF: </b></label> <?php print_r($informacoes['nif'])?>
        <p>
        <input class="w3-red w3-input" type='hidden' name='funcionario' value='<?php print_r($_GET['id'])?>' id='funcionario'>
        <input class="w3-red w3-input" type='submit' name='btnSubmit' value='Atualizar Informações Funcionário' id='btnSubmit' onclick='Preencher()'>
      </form>
    </div>
  </div>

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
