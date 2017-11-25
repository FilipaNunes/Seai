<!DOCTYPE html>
<html>
<head>
	<title>Drone 2u</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="../css/style.css">
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
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

	<div class="w3-container" id="packages" style="margin-top:75px">
	</div>

     <?php 
		include_once("../database/database.php");
		include_once("../login/session.php");
        $user_data = user_data_db();
        $user_data1 = $user_data->fetch(PDO::FETCH_ASSOC);
    ?> 
	
				<div class="w3-row w3-center">
					<a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'dados1');">
					  <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Dados do Utilizador</div>
					</a>
					<a href="javascript:void(0)" onclick="openTab(event, 'historico');">
					  <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Histórico de Encomendas</div>
					</a>
				</div>
				<br>
				<div id="dados1" class="content dados">
				<div class="w3-text-red"><center>A password que introduziu não está correta.<center></div>
				<div style="font-size: 16pt">Dados Pessoais</div>
				<p>
                    <b>Nome: </b>&nbsp
					<?=$user_data1["nome_completo"]?>
                </p>
                <p>
                    <b>E-mail: </b>&nbsp
                    <?=$user_data1["email"]?>
                </p>
                <p>
                    <b>Nome de utilizador: </b>&nbsp
                    <?=$user_data1["username"]?>
                </p>
                <p>
                    <b>Telemóvel: </b>&nbsp
                    <?=$user_data1["telemovel"]?>
                </p>
				<br><br>
				<div style="font-size: 16pt">Dados de Faturação</div>
                <p>
                    <b>NIF: </b>&nbsp
                    <?=$user_data1["nif"]?>
                </p>
                <p>
                    <b>Morada: </b>&nbsp
                    <?=$user_data1["morada"]?>
                </p>
				<br>
				<div style="text-align: right"><a class="button" href="update_dados.php">Alterar</a></div>
				</div>
				
				<div id="historico" class="dados">
				<div class="w3-container">
					<table class="w3-table-all">
					  <thead>
						<tr class="w3-red">
						  <th>Serviço</th>
						  <th>Produto</th>
						  <th>Custo</th>
						  <th>Envio</th>
						  <th>Entrega</th>
						  <th>Estado</th>
						</tr>
					  </thead>
					  <tr>
						<td>0 a 1 Kg</td>
						<td>Livro</td>
						<td>19,99 €</td>
						<td>04/11/2017 14:02</td>
						<td>04/11/2017 14:15</td>
						<td>Entregue</td>
					  </tr>
					  <tr>
						<td>2 a 3 Kg</td>
						<td>Telemovel</td>
						<td>39,99 €</td>
						<td>04/11/2017 14:05</td>
						<td>04/11/2017 14:18</td>
						<td>Entregue</td>
					  </tr>
					  <tr>
						<td>1 a 2 Kg</td>
						<td>Relógio</td>
						<td>29,99 €</td>
						<td>08/11/2017 17:01</td>
						<td>08/11/2017 17:20</td>
						<td>Entregue</td>
					  </tr>
					</table>
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
  
   <script>
  function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("dados");
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

  </body>
  </html>