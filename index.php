<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>


<!DOCTYPE html>
<html>
<head>
  <title>Drone 2u</title>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
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
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Fechar Menu</a>
  <div class="w3-container w3-center">
    <img src="img/icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
    <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">Home</a>
    <a href="servicos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Serviços</a>
    <a href="colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
	<a href="contactos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
  </div>
  </br>
    <?php 
	include_once("database/database.php");
	include_once("login/session.php");
	
	if ($_SESSION["user_id"] == NULL){
		echo '<div class="w3-bar-block w3-center">
		<a href="login/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Login</a>
		</div>';
		}
	else {
		
		echo '<div class="w3-bar-block w3-center">
		<a href="carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
		</div>';
		
		echo '<div class="w3-bar-block w3-center">
		<a href="login/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
		</div>';
		}
	?>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Drone2u</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
  <div class="w3-container" style="margin-top:80px" id="showcase">
    <h1 class="w3-xxxlarge w3-text-red"><b>A nossa empresa</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <!-- Photo grid (modal) -->
  <div class="w3-row-padding">
    <div class="w3-half">
      <img src="img/home1.jpg" style="width:100%">
      <div class="w3-container w3-center">
        <p>A Drone2u encontra-se situada na Faculdade de Engenharia da Universidade do Porto (FEUP). Desde Setembro de 2017 que tentámos responder às necessidades do mercado relativas às entregas com drones.</p>
      </div>
      <img src="img/home2.jpg" style="width:100%">
      <div class="w3-container w3-center">
        <p>Possuímos uma frota de drones constituída por quadcopters que nos permitem realizar vôos mais estáveis comparados com os drones de "asa fixa" e também nos permitem fazer vôos de até 30 minutos e percorrer distâncias de até 15 quilômetros.</p>
      </div>
    </div>

    <div class="w3-half">
      <img src="img/home3.jpg" style="width:100%">
      <div class="w3-container w3-center">
        <p>A Drone2u possui um conjunto de armazéns cuja localização foi cuidadosamente estudada pela nossa equipa de colaboradores, de modo a melhorar a qualidade dos serviços prestados aos nossos clientes.</p>
      </div>
      <img src="img/home4.jpg" style="width:100%">
      <div class="w3-container w3-center">
        <p>O nosso sistema é capaz de identificar áreas de vôo e altitudes proibidas e também o estado do clima. Deste modo conseguimos manter, não só a segurança do espaço aéreo, mas também a segurança das pessoas.</p>
      </div>
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
