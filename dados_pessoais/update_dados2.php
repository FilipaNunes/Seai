<!DOCTYPE html>
<html>
<head>
	<title>Drone2u</title>
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="../css/style.css">

<script src='dados_pessoais.js' charset='utf-8'></script>

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
	if ($_SESSION["user_id"] == NULL) header("Location: ../index.php");
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
		<a class="w3-bar-item w3-button w3-red"><?=$user_data1["username"]?></a>
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
		<a class="w3-bar-item w3-button w3-red"><?=$user_data1["username"]?></a>
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
					  <div class="w3-col tablink w3-bottombar w3-hover-light-grey w3-padding">Dados do Utilizador</div>
					</a>
				</div>
				<br>
				<div id="dados1" class="content dados">
				<div class="w3-text-red"><center>A password que introduziu não está correta.<center></div>
				<div style="font-size: 16pt">Dados Pessoais</div>
				<form method="POST" onsubmit="event.preventDefault(); UpdateDados()" autocomplete="on">
				<table>
					<tr>
						<td>
							<b>Nome: </b>
						</td>
						<td>
							<input type="text" class="text-input w3-border" id="name" name="name" value="<?=$user_data1["nome_completo"]?>" title="O nome apenas deve incluir letras e espaços." pattern="([A-zÀ-ž\s]){2,}" placeholder="Nome" required />
						</td>
					</tr>
					<tr>
						<td>
							<b>E-mail: </b>
						</td>
						<td>
							<input type="email" class="text-input w3-border" id="email" name="email" value="<?=$user_data1["email"]?>" size = "46" required readonly/>
						</td>
					</tr>
					<tr>
						<td>
							<b>Nome de Utilizador: </b>
						</td>
						<td>
							<input type="text" class="text-input w3-border" id="user" name="username" size="46" value="<?=$user_data1["username"]?>" required readonly/>
						</td>
					</tr>
					<tr>
                            <td>
                                <b>Password: </b>
                            </td>
                            <td>
                                <input type="password" class="text-input w3-border" id="pass" name="password" placeholder='Insira a sua password atual' size="46" autocomplete="off" required />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <b>Nova Password: </b>
                            </td>
                            <td>
                                <input type="password" class="text-input w3-border" id="n_pass" name="new_password" pattern='^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,}$' title='A password deve ter pelo menos 8 caracteres, incluindo obrigatoriamente uma letra maiúscula, uma letra minúscula e um número!' placeholder='Insira a sua nova password (opcional)' size="46" autocomplete="off" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <b>Confirmar Nova Password: </b>
                            </td>
                            <td>
                                <input type="password" class="text-input w3-border" id="cn_pass" name="confirm_new_password" pattern='^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,}$' title='A password deve ter pelo menos 8 caracteres, incluindo obrigatoriamente uma letra maiúscula, uma letra minúscula e um número!' placeholder='Confirme a sua nova password' size="46" autocomplete="off" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <b>Telemóvel: </b>
                            </td>
                            <td>
                                <input type="text" class="text-input w3-border" id="telephone" name="telephone" placeholder='Nº telemóvel' value="<?=$user_data1["telemovel"]?>" size="9" maxlength="9" pattern="\d{9}" title="O nº de telemóvel deve ter 9 dígitos." required />
                            </td>
                        </tr>
						</table>
						<br>
						<div style="font-size: 16pt">Dados de Faturação</div>
						<table>
						<tr>
                            <td>
                                <b>NIF: </b>
                            </td>
                            <td>
                                <input type="text" class="text-input w3-border" id="nif" name="nif" placeholder='NIF' value="<?=$user_data1["nif"]?>" size="9" maxlength="9" pattern="\d{9}" title="O NIF deve ter 9 dígitos." required />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <b>Morada: </b>
                            </td>
                            <td>
                                <input type="text" class="text-input w3-border" id="morada" placeholder='Morada' name="address" value="<?=$user_data1["morada"]?>" style="width:93%" title="A morada apenas deve incluir letras, espaços, números e o caracter º." pattern="([A-z0-9À-ž\sº.]){2,}" required />
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
