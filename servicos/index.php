<!DOCTYPE html>
<html>
<title>Drone2u</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
		<a class="w3-bar-item w3-button w3-red">Serviços</a>
		<a href="../contactos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
		<a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
  <?php if ($_SESSION["user_id"] == NULL) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a href="../login/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Login</a>
  <?php } 
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 0) { ?>
		<hr style="border-width: 2px; border-color: red">
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["nome_completo"]?></a>
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
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["nome_completo"]?></a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Serviços</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>Na seleção abaixo pode ver os serviços de entrega que temos disponíveis, para cada serviço pode ainda ver o tipo de encomenda que pode ser transportada e o preçario associado. </p>
  </div>

  <div class="w3-row-padding">
    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-dark-grey w3-xlarge w3-padding-32">0 a 1 Kg</li>
        <li class="w3-padding-16">Tempo médio, em minutos, gasto por km: 1.2</li>
        <li class="w3-padding-16">Se fizer mais que 3 encomendas, tem um desconto de 15% sobre o valor total</li>
        <li class="w3-padding-16">Não pode levar substâncias tóxicas e infeciosas, substâncias radioativas, materiais corrosivos, gases comprimidos, explosivos e materiais inflamáveis.</li>
        <li class="w3-padding-16">
          <h2>€ 19,99</h2>
          <span class="w3-opacity">por encomenda</span>
        </li>
        <li class="w3-light-grey w3-padding-24">
          <form action="encomenda.php" method='get' >
              <button class="w3-button w3-white w3-padding-large w3-hover-black" name='first' type='submit'>Escolher</button>
          </form>
		  
        </li>
      </ul>
    </br>
	<ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-dark-grey w3-xlarge w3-padding-32">>2 a 3 Kg</li>
        <li class="w3-padding-16">Tempo médio, em minutos, gasto por km: 1.2</li>
        <li class="w3-padding-16">Se fizer mais que 3 encomendas, tem um desconto de 15% sobre o valor total</li>
        <li class="w3-padding-16">Não pode levar substâncias tóxicas e infeciosas, substâncias radioativas, materiais corrosivos, gases comprimidos, explosivos e materiais inflamáveis.</li>
        <li class="w3-padding-16">
          <h2>€ 39,99</h2>
          <span class="w3-opacity">por encomenda</span>
        </li>
      <li class="w3-light-grey w3-padding-24">
        <form action="encomenda.php">
            <button class="w3-button w3-white w3-padding-large w3-hover-black" name='third' type='submit'>Escolher</button>
        </form>
      </li>
    </ul>
    </div>

    <div class="w3-half">
      <ul class="w3-ul w3-light-grey w3-center">
      <li class="w3-dark-grey w3-xlarge w3-padding-32">>1 a 2 Kg</li>
      <li class="w3-padding-16">Tempo médio, em minutos, gasto por km: 1.2</li>
        <li class="w3-padding-16">Se fizer mais que 3 encomendas, tem um desconto de 15% sobre o valor total</li>
        <li class="w3-padding-16">Não pode levar substâncias tóxicas e infeciosas, substâncias radioativas, materiais corrosivos, gases comprimidos, explosivos e materiais inflamáveis.</li>
      <li class="w3-padding-16">
        <h2>€ 29,99</h2>
        <span class="w3-opacity">por encomenda</span>
      </li>
        <li class="w3-light-grey w3-padding-24">
          <form action="encomenda.php">
              <button class="w3-button w3-white w3-padding-large w3-hover-black" name='second' type='submit'>Escolher</button>
          </form>
        </li>
      </ul>
    </br>
    <ul class="w3-ul w3-light-grey w3-center">
      <li class="w3-dark-grey w3-xlarge w3-padding-32">>3 a 4 Kg</li>
      <li class="w3-padding-16">Tempo médio, em minutos, gasto por km: 1.2</li>
        <li class="w3-padding-16">Se fizer mais que 3 encomendas, tem um desconto de 15% sobre o valor total</li>
        <li class="w3-padding-16">Não pode levar substâncias tóxicas e infeciosas, substâncias radioativas, materiais corrosivos, gases comprimidos, explosivos e materiais inflamáveis.</li>
      <li class="w3-padding-16">
        <h2>€ 49,99</h2>
        <span class="w3-opacity">por encomenda</span>
      </li>
      <li class="w3-light-grey w3-padding-24">
        <form action="encomenda.php">
            <button class="w3-button w3-white w3-padding-large w3-hover-black" name='fourth' type='submit'>Escolher</button>
        </form>
      </li>
    </ul>
    </div>
  </div>

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
