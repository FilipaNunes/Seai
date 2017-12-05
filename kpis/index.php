<?php include_once('kpis.php'); ?>


<!DOCTYPE html>
<html>
<title>Drone 2u</title>
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
<nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container w3-center">
    <img src="icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
    <a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Armazéns</a>
    <a href="../gestao_funcionarios/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Funcionários</a>
    <a href="../kpis/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">KPI's</a>
  </div>
  </br>
    <div class="w3-bar-block w3-center">

    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Company Name</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Packages / Pricing Tables -->
  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>KPI's</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>


	
  
  
    <table class="w3-table-all">
  <tbody>
	<tr >
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Mês</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Número de KPI's esperados </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Número de KPI's cumpridos</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Lotação máxima </th>
	</tr>
	<?php kpis(); ?>

	

 

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