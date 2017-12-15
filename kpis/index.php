<!DOCTYPE html>
<html>
<head>
  <title>Drone2u</title>
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
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

#chartdiv1 {
  width: 80%;
  height: 130px;
}
#chartdiv2 {
  width: 80%;
  height: 130px;
}
#chartdiv3 {
  width: 80%;
  height: 130px;
}
#chartdiv4 {
  width: 80%;
  height: 130px;
}
#chartdiv5 {
  width: 80%;
  height: 130px;
}
#chartdiv6 {
  width: 80%;
  height: 130px;
}
#chartdiv7 {
  width: 80%;
  height: 130px;
}
#chartdiv8 {
  width: 80%;
  height: 130px;
}
</style>
<body>

<!-- Sidebar/menu -->
<?php
	include_once("../login/session.php");
	if ($_SESSION["user_id"] == NULL OR check_admin_db() == 0) header("Location: ../index.php");
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
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["username"]?></a>
		<a href="../carrinho/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Carrinho</a>
		<a href="../logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Logout</a>
  <?php }
		elseif ($_SESSION["user_id"] != NULL AND check_admin_db() == 1) { ?>
		<a href="../armazens/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Armazéns</a>
		<a href="../gestao_utilizadores/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Utilizadores</a>
		<a href="../gestao_funcionarios/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Gestão de Funcionários</a>
		<a href="../entregas/entregas.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Entregas</a>
    <a href="../financas/index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red">Finanças</a>
		<a class="w3-bar-item w3-button w3-red">KPIs</a>
		<hr style="border-width: 2px; border-color: red">
		<a href="../dados_pessoais/dados_pessoais.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-red"><?=$user_data1["username"]?></a>
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
    <h1 class="w3-xxxlarge w3-text-red"><b>KPI's deste mês</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>

  <div class="w3-container">
  <div class="w3-row w3-center">
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Encomendas');">
      <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Encomendas</div>
    </a>
    <a href="javascript:void(0)" id="testbtn" onclick="openTab(event, 'Armazens');">
      <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Armazéns</div>
    </a>
  </div>

      <div id="Encomendas" class="w3-container kpis" style="display:none">
          <div class="w3-row">
          <h3>Entregas com sucesso:</h3>
          <div class="w3-container" id="chartdiv1"></div>
          <h3>Entregas com danos:</h3>
          <div class="w3-container" id="chartdiv2"></div>
          <h3>Número de reclamações:</h3>
          <div class="w3-container" id="chartdiv3"></div>
          <h3>Tempo médio de entregas:</h3>
          <div class="w3-container" id="chartdiv4"></div>
          <h3>Número de encomendas:</h3>
          <div class="w3-container" id="chartdiv5"></div>
    </div>
  </div>

      <div id="Armazens" class="w3-container kpis" style="display:none">
        <div class="w3-row">
          <h3>Percentagem de ocupação:</h3>
          <div class="w3-container" id="chartdiv6"></div>
          <h3>Tempo médio de expedição:</h3>
          <div class="w3-container" id="chartdiv7"></div>
          <h3>Danos por manuseamento das encomendas:</h3>
          <div class="w3-container" id="chartdiv8"></div>
        </div>
      </div>

  </div>



  <!-- End page content -->
  </div>

  <script>
  var chart = AmCharts.makeChart( "chartdiv1", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
    "category": "%",
    "bad": 20,
    "poor": 20,
    "average": 20,
    "good": 20,
    "excelent": 20,
    "limit": 100,
    "full": 100,
    "bullet": 90
  } ],
  "valueAxes": [ {
    "maximum": 100,
    "stackType": "regular",
    "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
    "valueField": "full",
    "showBalloon": false,
    "type": "column",
    "lineAlpha": 0,
    "fillAlphas": 0.8,
    "fillColors": [ "#fb2316", "#f6d32b", "#19d228"  ],
    "gradientOrientation": "horizontal",
  }, {
    "clustered": false,
    "columnWidth": 0.3,
    "fillAlphas": 1,
    "lineColor": "#f1f1f1",
    "stackable": false,
    "type": "column",
    "valueField": "bullet"
  }, {
    "columnWidth": 0.5,
    "lineColor": "#000000",
    "lineThickness": 3,
    "noStepRisers": true,
    "stackable": false,
    "type": "step",
    "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
    "gridAlpha": 0,
    "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv2", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "Nº",
  "excelent": 20,
  "good": 20,
  "average": 20,
  "poor": 20,
  "bad": 20,
  "limit": 0,
  "full": 100,
  "bullet": 3
  } ],
  "valueAxes": [ {
  "maximum": 25,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#19d228", "#f6d32b", "#fb2316" ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv3", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "Nº",
  "excelent": 20,
  "good": 20,
  "average": 20,
  "poor": 20,
  "bad": 20,
  "limit": 0,
  "full": 100,
  "bullet": 2
  } ],
  "valueAxes": [ {
  "maximum": 25,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#19d228", "#f6d32b", "#fb2316" ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv4", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "Min.",
  "excelent": 20,
  "good": 20,
  "average": 20,
  "poor": 20,
  "bad": 20,
  "limit": 15,
  "full": 100,
  "bullet": 17
  } ],
  "valueAxes": [ {
  "maximum": 30,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#19d228", "#f6d32b", "#fb2316" ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv5", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "Nº",
  "excelent": 400,
  "good": 400,
  "average": 400,
  "poor": 400,
  "bad": 400,
  "limit": 1800,
  "full": 2000,
  "bullet": 1500
  } ],
  "valueAxes": [ {
  "maximum": 2000,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#fb2316", "#f6d32b", "#19d228"  ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv6", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "%",
  "excelent": 20,
  "good": 20,
  "average": 20,
  "poor": 20,
  "bad": 20,
  "limit": 95,
  "full": 100,
  "bullet": 90
  } ],
  "valueAxes": [ {
  "maximum": 100,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#fb2316", "#f6d32b", "#19d228"  ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv7", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "Min.",
  "excelent": 20,
  "good": 20,
  "average": 20,
  "poor": 20,
  "bad": 20,
  "limit": 10,
  "full": 100,
  "bullet": 11
  } ],
  "valueAxes": [ {
  "maximum": 25,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#19d228", "#f6d32b", "#fb2316" ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );

  var chart = AmCharts.makeChart( "chartdiv8", {
  "type": "serial",
  "rotate": true,
  "theme": "light",
  "autoMargins": false,
  "marginTop": 30,
  "marginLeft": 80,
  "marginBottom": 30,
  "marginRight": 50,
  "dataProvider": [ {
  "category": "Nº",
  "excelent": 20,
  "good": 20,
  "average": 20,
  "poor": 20,
  "bad": 20,
  "limit": 5,
  "full": 100,
  "bullet": 1
  } ],
  "valueAxes": [ {
  "maximum": 25,
  "stackType": "regular",
  "gridAlpha": 0
  } ],
  "startDuration": 1,
  "graphs": [ {
  "valueField": "full",
  "showBalloon": false,
  "type": "column",
  "lineAlpha": 0,
  "fillAlphas": 0.8,
  "fillColors": [ "#19d228", "#f6d32b", "#fb2316" ],
  "gradientOrientation": "horizontal",
  }, {
  "clustered": false,
  "columnWidth": 0.3,
  "fillAlphas": 1,
  "lineColor": "#f1f1f1",
  "stackable": false,
  "type": "column",
  "valueField": "bullet"
  }, {
  "columnWidth": 0.5,
  "lineColor": "#000000",
  "lineThickness": 3,
  "noStepRisers": true,
  "stackable": false,
  "type": "step",
  "valueField": "limit"
  } ],
  "columnWidth": 1,
  "categoryField": "category",
  "categoryAxis": {
  "gridAlpha": 0,
  "position": "left"
  }
  } );
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
