<!DOCTYPE html>
<html>
<head>
  <title>Drone 2u</title>
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
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
    <img src="../img/icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
    <a href="../index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Home</a>
    <a href="../servicos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Serviços</a>
    <a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">Colaboradores</a>
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

  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Colaboradores</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>O conhecimento e as competências da Drone 2u provêm da experiência académica dos seus colaboradores:</p>
  </br>
  </div>

  <!-- The Team -->
  <div class="w3-row-padding">
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/ana.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Ana Neto</h3>
          <p class="w3-opacity">Facilitadora / Equipa de Base de Dados</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Robótica e Sistemas</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
      <img src="../img/daniel.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Daniel Leal</h3>
          <p class="w3-opacity">Equipa de Planeamento de Rotas</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Microeletrónica e Sistemas Embarcados</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/filipa.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Filipa Nunes</h3>
          <p class="w3-opacity">Revisora / Equipa de Website</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Gestão Industrial</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

  </div>
  <div class="w3-row-padding">
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/joao.jpg" style="width:100%">
        <div class="w3-container">
          <h3>João Mesquita</h3>
          <p class="w3-opacity">Equipa de Planeamento de Rotas</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Microeletrónica e Sistemas Embarcados</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/joni.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Jóni Gonçalves</h3>
          <p class="w3-opacity">Revisor / Equipa de Planeamento de Rotas</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Eletrónica e Sistemas</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/paulo.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Paulo Fontes</h3>
          <p class="w3-opacity">Equipa de Website</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Gestão Industrial</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
      <img src="../img/pedro.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Pedro Guedes</h3>
          <p class="w3-opacity">Líder / Equipa de Planeamento de Rotas</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Robótica e Sistemas</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/rui.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Rui Mendonça</h3>
          <p class="w3-opacity">Secretário / Equipa de Website</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Gestão Industrial</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/sergio.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Sérgio Fernandes</h3>
          <p class="w3-opacity">Equipa de Website</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Gestão Industrial</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
      <img src="../img/fraga.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Vasco Fraga</h3>
          <p class="w3-opacity">Equipa de Base de Dados</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Robótica e Sistemas</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
      </div>
    </div>

    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="../img/vasco.jpg" style="width:100%">
        <div class="w3-container">
          <h3>Vasco Pinto</h3>
          <p class="w3-opacity">Secretário / Equipa de Base de Dados</p>
          <p>Actualmente a frequentar o <b>5º ano</b> do curso Mestrado Integrado em Engenharia Eletrotécnica e Computadores (<b>MIEEC</b>) na especialização de <b>Robótica e Sistemas</b>, na Faculdade de Engenharia da Universidade do Porto (<b>FEUP</b>).</p>
        </div>
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