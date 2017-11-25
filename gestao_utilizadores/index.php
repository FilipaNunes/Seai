<?php include_once('utilizadores.php'); ?>


<!DOCTYPE html>
<html>
<title>Drone2u</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/notificacao.css"> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

<script src='utilizadores.js' charset='utf-8'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Fechar Menu</a>
  <div class="w3-container w3-center">
    <img src="../img/icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
    <a href="../index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Home</a>
    <a href="../servicos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Serviços</a>
    <a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
	<a href="../contactos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
  </div>
  </br>
    <div class="w3-bar-block w3-center">
      <a href="../login/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Login</a>
    </div>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Gestão de Utilizadores</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  <table class="w3-table-all">
  <tbody>
	<tr >
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Username</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Nome do Cliente</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Morada </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Email</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Contacto Telefónico </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Encomendas</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Eliminar </th>
	</tr>
	<?php Utilizadores(); ?>

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