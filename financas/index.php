<!DOCTYPE html>
<html>
<head>
  <title>Drone 2u</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<?php
    include_once('../database/database.php');
 ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;}

#chartdiv {
	width: 70%;
	height: 500px;
  margin:auto;
}
#chartdiv2 {
	width		: 80%;
	height		: 500px;
	font-size	: 11px;
  margin:auto;
}

#chartdiv4 {
	width: 70%;
	height: 500px;
  margin:auto;
}
#chartdiv3 {
	width		: 80%;
	height		: 500px;
	font-size	: 11px;
  margin:auto;
}

#chartdiv5 {
	width	: 80%;
	height	: 500px;
  margin:auto;
}
</style>
<body>

<!-- Sidebar/menu -->

<!-- CUIDADO - Não esquecer mostrar finanças só ao ADMIN - FALTA FAZER -->

<nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container w3-center">
    <img src="../img/icone.png" style="width:80%">
  </div>
  <div class="w3-bar-block w3-center">
  </br>
   <a href="../index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Home</a>
    <a href="../servicos/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Serviços</a>
    <a href="../colaboradores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Colaboradores</a>
    <a href="../financas/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-red">Finanças</a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>Finanças</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <div class="w3-container">
  <div class="w3-row w3-center">
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Receitas');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Receitas</div>
    </a>
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Despesas');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Despesas</div>
    </a>
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Lucros');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Lucros</div>
    </a>
  </div>

      <div id="Receitas" class="w3-container financas" style="display:none">
          <div class="w3-row">
      <h2>Este mês:</h2>
      <div class="w3-padding">
          <table class="w3-table-all w3-centered">
            <thead>
              <tr class="w3-red">
                <th>0 a 1Kg</th>
                <th>1 a 2Kg</th>
                <th>2 a 3Kg</th>
                <th>3 a 4kg</th>
                <th>Outras</th>
                <th>Total</th>
              </tr>
            </thead>
            <tr>
              <?php
                $data = getMonthReceitas();
                echo "<td>". number_format(round($data["0a1"],2),2) ." €</td>";
                echo "<td>". number_format(round($data["1a2"],2),2) ." €</td>";
                echo "<td>". number_format(round($data["2a3"],2),2) ." €</td>";
                echo "<td>". number_format(round($data["3a4"],2),2) ." €</td>";
                echo "<td>". number_format(round($data["outras"],2),2) ." €</td>";
                echo "<td>". number_format(round(($data["0a1"] + $data["1a2"] + $data["2a3"] + $data["3a4"] + $data["outras"]),2),2) ." €</td>";
              ?>
            </tr>
          </table>
      </div>

      <h2>Média / mês:</h2>
      <div class="w3-padding">
          <table class="w3-table-all w3-centered">
            <thead>
              <tr class="w3-red">
                <th>0 a 1Kg</th>
                <th>1 a 2Kg</th>
                <th>2 a 3Kg</th>
                <th>3 a 4kg</th>
                <th>Outras</th>
                <th>Total</th>
              </tr>
            </thead>
            <tr>
              <?php
                $data2 = getAverageReceitas();
                echo "<td>".  number_format(round($data2["0a1"],2),2) ." €</td>";
                echo "<td>".  number_format(round($data2["1a2"],2),2) ." €</td>";
                echo "<td>".  number_format(round($data2["2a3"],2),2) ." €</td>";
                echo "<td>".  number_format(round($data2["3a4"],2),2) ." €</td>";
                echo "<td>".  number_format(round($data2["outras"],2),2) ." €</td>";
                echo "<td>".  number_format(round(($data2["0a1"] + $data2["1a2"] + $data2["2a3"] + $data2["3a4"] + $data2["outras"]),2),2) ." €</td>";
              ?>
            </tr>
          </table>
      </div>
    </br>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </br>
<div class="w3-container" id="chartdiv2"></div>
</br>
    </div>
  </div>

      <div id="Despesas" class="w3-container financas" style="display:none">
        <div class="w3-row">
          <h2>Este mês:</h2>
          <div class="w3-padding">
              <table class="w3-table-all w3-centered">
                <thead>
                  <tr class="w3-red">
                    <th>Salários</th>
                    <th>Água/Gás</th>
                    <th>Energia</th>
                    <th>Aluguer</th>
                    <th>Manutenção</th>
                    <th>Outras</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $data3 = getMonthDespesas();
                    echo "<td>". number_format(round($data3["salarios"],2),2) ." €</td>";
                    echo "<td>". number_format(round($data3["aguagas"],2),2) ." €</td>";
                    echo "<td>". number_format(round($data3["energia"],2),2) ." €</td>";
                    echo "<td>". number_format(round($data3["aluguer"],2),2) ." €</td>";
                    echo "<td>". number_format(round($data3["manutencao"],2),2) ." €</td>";
                    echo "<td>". number_format(round($data3["outras"],2),2) ." €</td>";
                    echo "<td>". number_format(round(($data3["salarios"] + $data3["aguagas"] + $data3["energia"] + $data3["aluguer"] + $data3["manutencao"] + $data3["outras"]),2),2) ." €</td>";
                  ?>
                </tr>
              </table>
          </div>

          <h2>Média / mês:</h2>
          <div class="w3-padding">
						<table class="w3-table-all w3-centered">
							<thead>
								<tr class="w3-red">
									<th>Salários</th>
									<th>Água/Gás</th>
									<th>Energia</th>
									<th>Aluguer</th>
									<th>Manutenção</th>
									<th>Outras</th>
									<th>Total</th>
								</tr>
							</thead>
							<tr>
                <?php
                  $data4 = getAverageDespesas();
                  echo "<td>". number_format(round($data4["salarios"],2),2) ." €</td>";
                  echo "<td>". number_format(round($data4["aguagas"],2),2) ." €</td>";
                  echo "<td>". number_format(round($data4["energia"],2),2) ." €</td>";
                  echo "<td>". number_format(round($data4["aluguer"],2),2) ." €</td>";
                  echo "<td>". number_format(round($data4["manutencao"],2),2) ." €</td>";
                  echo "<td>". number_format(round($data4["outras"],2),2) ." €</td>";
                  echo "<td>". number_format(round(($data4["salarios"] + $data4["aguagas"] + $data4["energia"] + $data4["aluguer"] + $data4["manutencao"] + $data4["outras"]),2),2) ." €</td>";
                ?>
							</tr>
						</table>
          </div>
		    </br>
		    <hr style="width:50px;border:5px solid red" class="w3-round">
		  </br>
		<div class="w3-container" id="chartdiv3"></div>
		</br>
        </div>
      </div>

      <div id="Lucros" class="w3-container financas" style="display:none">
        <div class="w3-row">
          <h2></h2>
          <div class="w3-padding">
              <table class="w3-table-all w3-centered">
                <thead>
                  <tr class="w3-red">
                    <th>Este mês</th>
                    <th>Médio/mês</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    echo "<td>". number_format(round((($data["0a1"] + $data["1a2"] + $data["2a3"] + $data["3a4"] + $data["outras"])-($data3["salarios"]
                     + $data3["aguagas"] + $data3["energia"] + $data3["aluguer"] + $data3["manutencao"] + $data3["outras"])),2),2) ." €</td>";
                     echo "<td>". number_format(round((($data2["0a1"] + $data2["1a2"] + $data2["2a3"] + $data2["3a4"] + $data2["outras"])-($data4["salarios"]
                      + $data4["aguagas"] + $data4["energia"] + $data4["aluguer"] + $data4["manutencao"] + $data4["outras"])),2),2) ." €</td>";
                      ?>
                </tr>
              </table>
          </div>
		    </br>
		    <hr style="width:50px;border:5px solid red" class="w3-round">
		  </br>
		<div class="w3-container" id="chartdiv5"></div>
        </div>
      </div>
</div>



  <!-- End page content -->
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
    x = document.getElementsByClassName("financas");
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