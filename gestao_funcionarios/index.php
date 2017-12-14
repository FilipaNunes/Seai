<?php include_once('funcionario.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Drone2u</title>
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/notificacao.css"> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

<script src='armazens.js' charset='utf-8'></script>

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
    <img src="icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
    <a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Armazéns</a>
    <a href="../gestao_funcionarios/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">Gestão de Funcionários</a>
    <a href="../kpis/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">KPI's</a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Gestão de Funcionários</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  
      <div class="w3-container">
  <div class="w3-row w3-center">
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Dados dos Funcionários');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Dados dos Funcionários</div>
    </a>
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Adicionar Funcionário');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Adicionar Funcionário</div>
    </a>
  </div>
  
          <div id="Dados dos Funcionários" class="w3-container funcionarios" style="display:none">
          <div class="w3-row">
    <h1 class=><b></b></h1>
	<h1 class=><b></b></h1>
	<h1 class=><b></b></h1>
			  
  <form method='post' action=''>
  <label class="w3-text-red"><b>Informação Sobre Mês:</b></label>
    <select class="w3-select" name="option">
    <option value="" disabled selected>Escolher</option>
    <option value="1">Janeiro</option>
    <option value="2">Fevereiro</option>
    <option value="3">Março</option>
    <option value="4">Abril</option>
	<option value="5">Maio</option>
    <option value="6">Junho</option>
    <option value="7">Julho</option>
    <option value="8">Agosto</option>
	<option value="9">Setembro</option>
    <option value="10">Outubro</option>
    <option value="11">Novembro</option>
    <option value="12">Dezembro</option>
  </select>
    <h1 class=><b></b></h1>
	<input class="w3-btn w3-red" type='submit' value='Pesquisar'></input>
  </form>
    <h1 class=><b></b></h1>
	<h1 class=><b></b></h1>
	<h1 class=><b></b></h1>  
  <table class="w3-table-all">
  <tbody>
  
	<tr >
	<th style='background-color:#f44336'> <font color='white'> Nome do Funcionário</th>
	<th style='background-color:#f44336'> <font color='white'> Morada </th>
	<th style='background-color:#f44336'> <font color='white'> Email</th>
	<th style='background-color:#f44336'> <font color='white'> Contacto Telefónico </th>
	<th style='background-color:#f44336'> <font color='white'> Faltas Justificadas</th>
	<th style='background-color:#f44336'> <font color='white'> Faltas Injustificadas</th>
	<th style='background-color:#f44336'> <font color='white'> Atrasos</th>
	<th style='background-color:#f44336'> <font color='white'> Cumprimento de Metas</th>
	<th style='background-color:#f44336'> <font color='white'> Salário</th>
	</tr>
	<?php 
	funcionario(); ?>

		
	
	
								</tr>
						</table>
          </div>
		    </br>
		  </br>
		<div class="w3-container" id="chartdiv3"></div>
		</br>
        </div>
      </div>
	  
	        <div id="Adicionar Funcionário" class="w3-container funcionarios" style="display:none">
        <div class="w3-row">
	
		<label class="w3-text-red"><b></b></label>	
	</p>
	
	<form class="w3-container w3-card-4" action="regist_funcionario.php" method="POST" id="form">
	
	<label class="w3-text-black"><b>Adicionar novo Armazém</b></label>	
	</p>

  <p>
  <label class="w3-text-red"><b>Nome do Funcionário</b></label>
  <input class="w3-input w3-border" id="nome_completo" name="nome_completo" type="text" placeholder='Inserir nome do funcionário' pattern='[a-zA-Z0-9\s]{3,40}' required></p>
  <p>
  <label class="w3-text-red"><b>Morada</b></label>
  <input class="w3-input w3-border" id="morada" name="morada" type="text" placeholder='Inserir morada do funcionário' pattern='[a-zA-Z0-9\s]{3,40}' required></p>
  <p>
  <label class="w3-text-red"><b>Email</b></label>
  <input class="w3-input w3-border" id="email" name="email" type="text" placeholder=' Inserir email do funcionário' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$' required></p>
  <p>
  <label class="w3-text-red"><b>Contacto telefónico</b></label>
  <input class="w3-input w3-border" id="telemovel" name="telemovel" type="text" placeholder=' Inserir telemóvel do funcionário' pattern='[0-9]{0,9}' maxlength = "9" required></p>
  <p>
   <label class="w3-text-red"><b>NIF</b></label>
  <input class="w3-input w3-border" id="nif" name="nif" type="text" placeholder=' Inserir NIF do funcionário' pattern='[0-9]{0,9}' maxlength = "9" required></p>
  <p>
  <input class="w3-red w3-input" type='submit' name='btnSubmit' value='Adicionar' id='btnSubmit'>
</form>

  
 

  <script>
  </div>

<script>
var chart = AmCharts.makeChart("chartdiv2", {
    "type": "serial",
    "theme": "light",
    "marginRight":30,
    "legend": {
        "equalWidths": false,
        "periodValueText": "total: [[value.sum]]",
        "position": "top",
        "valueAlign": "left",
        "valueWidth": 100
    },
    "dataLoader": {
    "url": "receitas.php",
    "format": "json"
  },
    "valueAxes": [{
        "stackType": "regular",
        "gridAlpha": 0.07,
        "position": "left",
        "title": "Receitas (€)"
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "0 a 1Kg",
        "valueField": "0a1"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "1 a 2Kg",
        "valueField": "1a2"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "2 a 3Kg",
        "valueField": "2a3"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "3 a 4Kg",
        "valueField": "3a4"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Outras",
        "valueField": "outras"
    }],
    "plotAreaBorderAlpha": 0,
    "marginTop": 10,
    "marginLeft": 0,
    "marginBottom": 0,
    "chartScrollbar": {},
    "chartCursor": {
        "cursorAlpha": 0
    },
    "categoryField": "data",
    "categoryAxis": {
        "startOnAxis": true,
        "axisColor": "#DADADA",
        "gridAlpha": 0.07,
        "title": "Mês/Ano"
    },
    "export": {
    	"enabled": true
     }
});
</script>

<script>
var chart = AmCharts.makeChart("chartdiv3", {
    "type": "serial",
    "theme": "light",
    "marginRight":30,
    "legend": {
        "equalWidths": false,
        "periodValueText": "total: [[value.sum]]",
        "position": "top",
        "valueAlign": "left",
        "valueWidth": 100
    },
    "dataLoader": {
    "url": "despesas.php",
    "format": "json"
  },
    "valueAxes": [{
        "stackType": "regular",
        "gridAlpha": 0.07,
        "position": "left",
        "title": "Despesas (€)"
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Salários",
        "valueField": "salarios"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Água/Gás",
        "valueField": "aguagas"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Energia",
        "valueField": "energia"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Aluguer",
        "valueField": "aluguer"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Manutenção",
        "valueField": "manutencao"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Outras",
        "valueField": "outras"
    }],
    "plotAreaBorderAlpha": 0,
    "marginTop": 10,
    "marginLeft": 0,
    "marginBottom": 0,
    "chartScrollbar": {},
    "chartCursor": {
        "cursorAlpha": 0
    },
    "categoryField": "data",
    "categoryAxis": {
        "startOnAxis": true,
        "axisColor": "#DADADA",
        "gridAlpha": 0.07,
        "title": "Mês/Ano"
    },
    "export": {
    	"enabled": true
     }
});
</script>

<script>
var chart = AmCharts.makeChart("chartdiv5", {
    "type": "serial",
    "theme": "light",
		"titles": [{
	    "text": "Lucros (€)"
	  }, {
	    "text": "Por mês",
	    "bold": false
	  }],
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "lucro",
        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "data",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataLoader": {
    "url": "lucros.php",
    "format": "json"
  }
});

chart.addListener("rendered", zoomChart);

zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}
</script>




<script>
  function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("funcionarios");
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