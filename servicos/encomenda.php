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
<nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Fechar Menu</a>
  <div class="w3-container w3-center">
    <img src="../img/icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
   <a href="../index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Home</a>
    <a href="../servicos/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Serviços</a>
    <a href="../colaboradores/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
	<a href="../contactos/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Contactos</a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Encomenda</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <form class="w3-container w3-card-4" action="/action_page.php">
    <p>
    <label class="w3-text-red"><b>Serviço</b></label>
    <select class="w3-select" name="option">
	<?php
		if(isset($_GET['first']))
		{
			echo'<option value="1" selected>0 a 1 Kg</option>
				 <option value="2">1 a 2 Kg</option>
				 <option value="3">2 a 3 kg</option>
				 <option value="4">3 a 4 kg</option>';
		}
		elseif(isset($_GET['second']))
		{
			echo'<option value="1">0 a 1 Kg</option>
				 <option value="2" selected>1 a 2 Kg</option>
				 <option value="3">2 a 3 kg</option>
				 <option value="4">3 a 4 kg</option>';
		}
		elseif(isset($_GET['third']))
		{
			echo'<option value="1">0 a 1 Kg</option>
				 <option value="2">1 a 2 Kg</option>
				 <option value="3" selected>2 a 3 kg</option>
				 <option value="4">3 a 4 kg</option>';
		}
		elseif(isset($_GET['fourth']))
		{
			echo'<option value="1">0 a 1 Kg</option>
				 <option value="2">1 a 2 Kg</option>
				 <option value="3">2 a 3 kg</option>
				 <option value="4" selected>3 a 4 kg</option>';
		}
	?>
  </select></p>
    <p>
    <label class="w3-text-red"><b>Produto</b></label>
    <select class="w3-select" name="option">
    <option value="" disabled selected>Escolher</option>
    <option value="1">Artigos tecnológicos</option>
    <option value="2">Relógio</option>
    <option value="3">Vestuário</option>
	<option value="4">Cosméticos</option>
	<option value="5">Artigos de Papelaria</option>
	<option value="6">Brinquedos</option>
	<option value="7">Pequenos Eletrodomésticos</option>
	<option value="8">Artigos de Cuidado Pessoal</option>
  </select> Para mais informações sobre os produtos clique <a target="_blank" href="informacoes.html">aqui</a> </p>
	<p>
    <label class="w3-text-red"><b>Dimensões</b></label>
    <input class="w3-input w3-border" name="dime" type="text" title='As dimensões devem ser inseridas em centímetros com o seguinte formato comprimentoxlarguraxaltura'></p>
	</p>
	<p>
    <label class="w3-text-red"><b>Quantidade</b></label>
    <input class="w3-input w3-border" name="quat" type="text" title='Quantindade de produtos com as características inseridas'></p>
	</p>
    <p>
    <label class="w3-text-red"><b>Ponto de recolha</b></label>
    <select class="w3-select" name="option">
    <option value="" disabled selected>Escolher</option>
    <option value="1">Armazém 1</option>
    <option value="2">Armazém 2</option>
    <option value="3">Armazém 3</option>
    <option value="3">Armazém 4</option>
  </select></p>
    <p>
    <label class="w3-text-red"><b>Morada de destino</b></label>
    <input class="w3-input w3-border" name="first" type="text"></p>
    <p>
    <label class="w3-text-red"><b>Preço previsto</b></label></p>
    <p>...</p>
    <p>
    <button class="w3-btn w3-red">Adicionar ao Carrinho</button></p>
  </form>

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