<?php
  include_once('funcionario.php');
?>

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
    <div class="w3-row w3-center">
      <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Listagem dos Funcionários');">
        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Listagem dos Funcionários</div>
      </a>
      <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Adicionar Funcionário');">
        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Adicionar Funcionário</div>
      </a>
      <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Inserir Dados dos Funcionários');">
        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Inserir Dados dos Funcionários</div>
      </a>
    </div>

    <div id="Listagem dos Funcionários" class="w3-container funcionarios" style="display:none">
      <div class="w3-row">
        <p></p>
        <?php funcionario(); ?>
      </div>

      <p></p>
      <hr style="width:50px;border:5px solid red" class="w3-round w3-left">
	<br><br>
      <h2 class="w3-text-red"><b>Pesquisar Informações</b></h2>
        <form method='post' action='index.php'>
            <select class="w3-select" id="ano2" name="ano2" required>
              <option value="" disabled selected>Ano</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
            </select>
            <select class="w3-select" id="mes2" name="mes2" required>
              <option value="" disabled selected>Mês</option>
              <option value="01">Janeiro</option>
              <option value="02">Fevereiro</option>
              <option value="03">Março</option>
              <option value="04">Abril</option>
          	  <option value="05">Maio</option>
              <option value="06">Junho</option>
              <option value="07">Julho</option>
              <option value="08">Agosto</option>
          	  <option value="09">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
            </select>
            <p></p>
    	      <input class="w3-btn w3-red" type='submit' value='Pesquisar'></input>
		<p></p>
      </form>
    </div>

	<div id="Adicionar Funcionário" class="w3-container funcionarios" style="display:none">
    <div class="w3-row">
      <p></p>
    	<form class="w3-container w3-card-4" onsubmit='event.preventDefault(); return AdicionarFuncionario();' method="POST" id="form" accept-charset="UTF-8">
        <p>
        <label class="w3-text-red"><b>Nome do Funcionário</b></label>
        <input class="w3-input w3-border" id="nome_completo" name="nome_completo" type="text" placeholder='Inserir nome do funcionário' title="O nome tem de ter entre 3 e 40 caracteres" pattern='[a-zA-ZÀ-ž0-9\s]{3,40}' required></p>
        <p>
        <label class="w3-text-red"><b>Morada</b></label>
        <input class="w3-input w3-border" id="morada" name="morada" type="text" placeholder='Inserir morada do funcionário' pattern='[a-zA-ZÀ-ž0-9º.\s]{3,40}' required></p>
        <p>
        <label class="w3-text-red"><b>Email</b></label>
        <input class="w3-input border" id="email" name="email" type="email" placeholder=' Inserir email do funcionário' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}' onblur='CheckEmail(function(){})' required></p>
        <div id="email_indis" style="color:#f44336"></div>
        <p>
        <label class="w3-text-red"><b>Contacto telefónico</b></label>
        <input class="w3-input w3-border" id="telemovel" name="telemovel" type="text" placeholder=' Inserir telemóvel do funcionário' pattern='[0-9]{9}'maxlength="9" required></p>
        <p>
         <label class="w3-text-red"><b>NIF</b></label>
        <input class="w3-input border" id="nif" name="nif" type="text" placeholder=' Inserir NIF do funcionário' pattern='[0-9]{9}' maxlength="9" onblur='CheckNif(function(){})' required></p>
        <div id="nif_indis" style="color:#f44336"></div>
        <p>
        <input class="w3-red w3-input" type='submit' name='btnSubmit' value='Adicionar' id='btnSubmit'>
      </form>
    </div>
  </div>

  <div id="Inserir Dados dos Funcionários" class="w3-container funcionarios" style="display:none">
    <div class="w3-row">
      <p></p>
    	<form class="w3-container w3-card-4" onsubmit='event.preventDefault(); return AdicionarDados();' method="POST" id="form" accept-charset="UTF-8">
        <select class="w3-select" id="ano" name="option" required>
          <option value="" disabled selected>Ano</option>
          <option value="1">2017</option>
          <option value="2">2018</option>
        </select>
        <select class="w3-select" id="mes" name="option2" required>
          <option value="" disabled selected>Mês</option>
          <option value="01">Janeiro</option>
          <option value="02">Fevereiro</option>
          <option value="03">Março</option>
          <option value="04">Abril</option>
          <option value="05">Maio</option>
          <option value="06">Junho</option>
          <option value="07">Julho</option>
          <option value="08">Agosto</option>
          <option value="09">Setembro</option>
          <option value="10">Outubro</option>
          <option value="11">Novembro</option>
          <option value="12">Dezembro</option>
        </select>
        <p></p>
        <label class="w3-text-red"><b>Número do Funcionário</b></label>
        <input class="w3-input border" id="func" name="func" type="text" placeholder='Inserir o número do funcionário' pattern='[0-9]{1,5}' maxlength="5" onBlur='NumFuncionario(function(){})' required></p>
        <div id="num_indis" style="color:#f44336"></div>
        <p>
        <label class="w3-text-red"><b>Número Faltas Justificadas</b></label>
        <input class="w3-input border" id="falta_jus" name="falta_jus" type="text" placeholder='Inserir o número de faltas justificadas' pattern='[0-9]{1,2}' maxlength="2" onBlur='FaltasJustificadas(function(){})' required></p>
        <div id="falta_jus_in" style="color:#f44336"></div>
        <p>
        <label class="w3-text-red"><b>Número Faltas Injustificadas</b></label>
        <input class="w3-input border" id="falta_injus" name="falta_injus" type="text" placeholder='Inserir o número de faltas injustificadas' pattern='[0-9]{1,2}' maxlength="2" onBlur='FaltasInjustificadas(function(){})' required></p>
        <div id="falta_injus_in" style="color:#f44336"></div>
        <p>
        <label class="w3-text-red"><b>Número Atrasos</b></label>
        <input class="w3-input border" id="atrasos" name="atrasos" type="text" placeholder='Inserir o número de atrasos' pattern='[0-9]{1,2}' maxlength="2" onBlur='Atrasos(function(){})' required></p>
        <div id="atrasos_in" style="color:#f44336"></div>
        <p>
        <label class="w3-text-red"><b>Salário(€)</b></label>
        <input class="w3-input w3-border" id="salario" name="salario" type="text" placeholder=' Inserir o salário' pattern='[0-9]{1,10}' required></p>
        <p>
        <input class="w3-red w3-input" type='submit' name='btnSubmit' value='Adicionar' id='btnSubmit'>
        <p>OBS: Este formulário também pode ser usado para atualizar os dados já existentes</p>
      </form>
    </div>
  </div>

</div>

<div id='notification-container' class='notification-container'></div>



<script>
  function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("funcionarios");
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
