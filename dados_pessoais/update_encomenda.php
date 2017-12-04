<!DOCTYPE html>
<html>
<head>
	<title>Drone2u</title>
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
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
		<a class="w3-bar-item w3-button w3-red"><?=$user_data1["nome_completo"]?></a>
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
		<a class="w3-bar-item w3-button w3-red"><?=$user_data1["nome_completo"]?></a>
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

  <div class="w3-container" id="packages" style="margin-top:75px">
  </div>	
				<div class="w3-row w3-center">
					<a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'dados1');">
					  <div class="w3-col tablink w3-bottombar w3-hover-light-grey w3-padding">Atualização de Encomenda</div>
					</a>
				</div>
				<br>
				<?php
					$id = $_GET["id"];
					
					$encomendas = get_encomendas2_db($id);
					$encomenda = $encomendas->fetch(PDO::FETCH_ASSOC); 
				?>
				<div id="dados1" class="content dados">
				<div style="font-size: 16pt">Dados da encomenda</div>
				<form method="POST" action="action_update_encomenda.php" autocomplete="on">
				<table>
					<input type="hidden" name="id" value="<?=$id?>" />
					<tr>
						<td>
							<b>Produto: </b>
						</td>
						<td>
							<input type="text" class="text-input w3-border" name="produto" value="<?=$encomenda["tipo_encomenda"]?>" size="46" required />
						</td>
					</tr>
					<tr>
						<td>
							<b>Peso: </b> &nbsp (máx. 4.0 Kg)
						</td>
						<td>
							<input type="text" class="text-input w3-border" name="peso" value="<?=$encomenda["peso"]?>" size = "46" pattern="([0-3][.][1-9])|([4][.][0])|([1-4])" required />
						</td>
					</tr>
					<tr>
						<td>
							<b>Dimensão: </b> &nbsp (máx. 30x30x30 cm)
						</td>
						<td>
							<input type="text" class="text-input w3-border" name="dimensao" size="46" value="<?=$encomenda["dimensao"]?>" pattern="([0-2][0-9]|[0-3][0])[x]([0-2][0-9]|[0-3][0])[x]([0-2][0-9]|[0-3][0])" required />
						</td>
					</tr>
					<tr>
                            <td>
                                <b>Morada de Destino: </b>
                            </td>
                            <td>
                                <input type="text" class="text-input w3-border" name="destino" value="<?=$encomenda["morada_destino"]?>" size="46" required />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <b>Características: </b>
                            </td>
                            <td>
                                <input type="text" class="text-input w3-border" name="caracteristicas" value="<?=$encomenda["caracteristicas"]?>" placeholder="Características da encomenda (opcional)" size="46" />
                            </td>
                        </tr>
						
						</table>
						<br>
						<div style="text-align: right"><input type="submit" class="button" name="update" value="Guardar"/></div>
					</form>
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
