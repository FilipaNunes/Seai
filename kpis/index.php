<?php include_once('kpis.php') ;?>
<?php include_once('kpis3.php') ;?>



<!DOCTYPE html>
<html>
<title>Drone 2u</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../css/notificacao.css"> 

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

   
   <!-- Styles -->
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;}
#chartdiv {
	width	: 100%;
	height	: 500px;
}	
#chartdiv2 {
	width	: 100%;
	height	: 500px;
}															
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/gauge.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>


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

    <div class="w3-container">
  <div class="w3-row w3-center">
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Encomendas');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Encomendas</div>
    </a>
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Armazéns');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Armazéns</div>
    </a>
  </div>

        <div id="Encomendas" class="w3-container kpis" style="display:none">
          <div class="w3-row">	
  
  
    <table class="w3-table-all">
  <tbody>
	<tr >
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Tempo médio de entrega por categoria / Valor esperado </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Número de encomendas por categoria / Valor esperado </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Entregas com sucesso / Valor esperado </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Número de reclamações / Valor esperado</th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Entregas com danos / Valor esperado</th>
	</tr>
	<?php kpis(); ?>

          </div>
		    </br>
			<h1 class="w3-xlarge w3-text-red"><b>Média de KPI's atingidos</b></h1>
		  </br>
			<div id="chartdiv"></div> 
			</br>
		</div>
 </div>

      <div id="Armazéns" class="w3-container kpis" style="display:none">
        <div class="w3-row">	
		
    <table class="w3-table-all">
  <tbody>
	<tr>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Percentagem de ocupação </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Tempo de expedição média </th>
	<th style='background-color:#f44336; text-align:center'> <font color='white'> Danos por manuseamento de encomendas</th>
	</tr>
	<?php kpis3(); ?>
 
 
 
 
          </div>
		    </br>
			    <h1 class="w3-xlarge w3-text-red"><b>Média de KPI's atingidos</b></h1>
		  </br>
			<div id="chartdiv2"></div>
			</br>
        </div>



  <!-- End page content -->
   </div>

<style>
#chartdiv {
	width	: 100%;
	height	: 500px;
}															
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/gauge.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var gaugeChart = AmCharts.makeChart( "chartdiv", {
  "type": "gauge",
  "theme": "light",
  "axes": [ {
    "axisThickness": 1,
    "axisAlpha": 0.2,
    "tickAlpha": 0.2,
    "valueInterval": 10,
    "bands": [ {
      "color": "#cc4748",
      "endValue": 50,
      "startValue": 0
    }, {
      "color": "#fdd400",
      "endValue": 75,
      "startValue": 50
    }, {
      "color": "#84b761",
      "endValue": 100,
      "innerRadius": "95%",
      "startValue": 75
    } ],
    "endValue": 100
  } ],
  "arrows": [ {} ],
  "export": {
    "enabled": true
  }
} );

setInterval( randomValue, 2000 );

// set random value
function randomValue() {
  var value = 55;
  if ( gaugeChart ) {
    if ( gaugeChart.arrows ) {
      if ( gaugeChart.arrows[ 0 ] ) {
        if ( gaugeChart.arrows[ 0 ].setValue ) {
          gaugeChart.arrows[ 0 ].setValue( value );
          gaugeChart.axes[ 0 ].setBottomText( value + "%" );
        }
      }
    }
  }
}

var gaugeChart2 = AmCharts.makeChart( "chartdiv2", {
  "type": "gauge",
  "theme": "light",
  "axes": [ {
    "axisThickness": 1,
    "axisAlpha": 0.2,
    "tickAlpha": 0.2,
    "valueInterval": 10,
    "bands": [ {
      "color": "#cc4748",
      "endValue": 50,
      "startValue": 0
    }, {
      "color": "#fdd400",
      "endValue": 75,
      "startValue": 50
    }, {
      "color": "#84b761",
      "endValue": 100,
      "innerRadius": "95%",
      "startValue": 75
    } ],
    "endValue": 100
  } ],
  "arrows": [ {} ],
  "export": {
    "enabled": true
  }
} );

setInterval( randomValue2, 2000 );

// set random value for chart 2
function randomValue2() {
  var value = 80;
  if ( gaugeChart2 ) {
    if ( gaugeChart2.arrows ) {
      if ( gaugeChart2.arrows[ 0 ] ) {
        if ( gaugeChart2.arrows[ 0 ].setValue ) {
          gaugeChart2.arrows[ 0 ].setValue( value );
          gaugeChart2.axes[ 0 ].setBottomText( value + "%" );
        }
      }
    }
  }
}

</script>
    




<script>
  function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("kpis");
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