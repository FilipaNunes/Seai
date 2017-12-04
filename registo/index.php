<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<!DOCTYPE html>
<html>
<title>Drone2u</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='../css/notificacao.css'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

<script src='registo.js' charset='utf-8'></script>

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
		<a href="../contactos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
		<a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
		<hr style="border-width: 2px; border-color: red">
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

  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Registo</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">

<form class="w3-container w3-card-4" action="registo.php" method="post" id="form">

  <p>
  <label class="w3-text-red"><b>Username</b></label>
  <input class="w3-input w3-border" id="user" name="user" type="text" placeholder='Nome pretendido para o utilizador' pattern='[a-z0-9_-]{3,20}' title='O username deve ter entre 3 e 20 caracteres, incluindo letras, números, hífen ou underscore!' onfocus = 'Disable()' onblur = 'CheckUsername()' required></p>
  <p>
  <label class="w3-text-red"><b>Password</b></label>
  <input class="w3-input w3-border" id="pass" name="pass" type="password" placeholder='Insira Password' pattern='[a-zA-Z0-9_-]{6,20}' title='A password deve ter entre 6 e 20 caracteres, incluindo letras, números, hífen ou underscore!' onfocus = 'Disable()' onblur = 'ValidatePassword()' required></p>
  <p>
  <label class="w3-text-red"><b>Confirmar Password</b></label>
  <input class="w3-input w3-border" id="c_pass" name="c_pass" type="password" placeholder='Repita a Password' pattern='[a-zA-Z0-9_-]{6,20}' title='Repita a password inserida acima.' onfocus = 'Disable()' onblur = 'ValidatePassword()' required></p>
  <p>
  <label class="w3-text-red"><b>Email</b></label>
  <input class="w3-input w3-border" id="email" name="email" type="email" placeholder='Insira o email para o registo' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title='Introduza o email com este formato email@email.com' onfocus = 'Disable()' onblur = 'CheckEmail()' required></p>
  <p>
  <button class="w3-red w3-btn" type='submit' name='btnSubmit' id='btnSubmit' onClick='event.preventDefault(); RegistoFeito()' disabled>Registo</button></p>
</form>

  <!-- End page content -->
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
