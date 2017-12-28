<?php
  include_once('../database/database.php');


  function graficos(){

    global $conn;

    $date = getdate();

    $ANO = $date['year'];
    $MES = $date['mon'];

    if (!empty($_POST)){

    $ANO = $_POST["ano2"];
    $MES = $_POST["mes2"];

    }


    $stmt3 = $conn->prepare('SELECT EXISTS(SELECT * FROM "encomenda" WHERE EXTRACT(year from "data_submissao") = ?
                                                                      AND EXTRACT(month from "data_submissao") = ?);');
    $stmt3->execute(array($ANO,$MES));
    $bool = $stmt3->fetch();

    if ($bool["exists"] == false){

    echo"<h3>Não existem valores disponíveis para o mês escolhido.</h3>";

    }

    else {

      $stmt7 = $conn->prepare('SELECT COUNT(*)
                              FROM "encomenda"
                              WHERE EXTRACT(year from "data_submissao") = ?
                              AND EXTRACT(month from "data_submissao") = ?;');
      $stmt7->execute(array($ANO,$MES));
      $num_encom = $stmt7->fetch();
      $num_encomendas = $num_encom['count'];

      echo"<div id=\"Encomendas\" class=\"w3-container kpis\" style=\"display:none\">
          <div class=\"w3-row\">
          <h3>Número de encomendas:</h3>
          <div class=\"w3-container\" id=\"chartdiv5\"></div>
          <h3>Entregas com sucesso:</h3>
          <div class=\"w3-container\" id=\"chartdiv1\"></div>
          <h3>Entregas com danos:</h3>
          <div class=\"w3-container\" id=\"chartdiv2\"></div>
          <h3>Número de reclamações:</h3>
          <div class=\"w3-container\" id=\"chartdiv3\"></div>
          <h3>Tempo médio de entregas:</h3>
          <div class=\"w3-container\" id=\"chartdiv4\"></div>
      </div>
      <h3>Legenda:</h3>
      <p>Barra cinza - Valor atual do KPI</p>
      <p>Risca preta - Objetivo / limite do KPI</p>
      </div>

      <div id=\"Armazens\" class=\"w3-container kpis\" style=\"display:none\">
        <div class=\"w3-row\">
          <h3>Percentagem de ocupação:</h3>
          <div class=\"w3-container\" id=\"chartdiv6\"></div>
          <h3>Tempo médio de expedição:</h3>
          <div class=\"w3-container\" id=\"chartdiv7\"></div>
          <h3>Danos por manuseamento das encomendas:</h3>
          <div class=\"w3-container\" id=\"chartdiv8\"></div>
        </div>
        <h3>Legenda:</h3>
        <p>Barra cinza - Valor atual do KPI</p>
        <p>Risca preta - Objetivo / limite do KPI</p>
      </div>

      <script>
      var chart = AmCharts.makeChart( \"chartdiv1\", {
      \"type\": \"serial\",
      \"rotate\": true,
      \"theme\": \"light\",
      \"autoMargins\": false,
      \"marginTop\": 30,
      \"marginLeft\": 80,
      \"marginBottom\": 30,
      \"marginRight\": 50,
      \"dataProvider\": [ {
        \"category\": \"%\",
        \"bad\": 20,
        \"poor\": 20,
        \"average\": 20,
        \"good\": 20,
        \"excelent\": 20,
        \"limit\": 100,
        \"full\": 100,
        \"bullet\": 90
      } ],
      \"valueAxes\": [ {
        \"maximum\": 100,
        \"stackType\": \"regular\",
        \"gridAlpha\": 0
      } ],
      \"startDuration\": 1,
      \"graphs\": [ {
        \"valueField\": \"full\",
        \"showBalloon\": false,
        \"type\": \"column\",
        \"lineAlpha\": 0,
        \"fillAlphas\": 0.8,
        \"fillColors\": [ \"rgb(251, 35, 22)\", \"rgb(246, 211, 43)\", \"rgb(25, 210, 40)\"  ],
        \"gradientOrientation\": \"horizontal\"
      }, {
        \"clustered\": false,
        \"columnWidth\": 0.3,
        \"fillAlphas\": 1,
        \"lineColor\": \"rgb(241, 241, 241)\",
        \"stackable\": false,
        \"type\": \"column\",
        \"valueField\": \"bullet\"
      }, {
        \"columnWidth\": 0.5,
        \"lineColor\": \"rgb(0, 0, 0)\",
        \"lineThickness\": 3,
        \"noStepRisers\": true,
        \"stackable\": false,
        \"type\": \"step\",
        \"valueField\": \"limit\"
      } ],
      \"columnWidth\": 1,
      \"categoryField\": \"category\",
      \"categoryAxis\": {
        \"gridAlpha\": 0,
        \"position\": \"left\"
      }
    } );

    var chart = AmCharts.makeChart( \"chartdiv2\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"Nº\",
      \"excelent\": 20,
      \"good\": 20,
      \"average\": 20,
      \"poor\": 20,
      \"bad\": 20,
      \"limit\": 0,
      \"full\": 100,
      \"bullet\": 3
    } ],
    \"valueAxes\": [ {
      \"maximum\": 25,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(25, 210, 40)\", \"rgb(246, 211, 43)\", \"rgb(251, 35, 22)\" ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );

    var chart = AmCharts.makeChart( \"chartdiv3\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"Nº\",
      \"excelent\": 20,
      \"good\": 20,
      \"average\": 20,
      \"poor\": 20,
      \"bad\": 20,
      \"limit\": 0,
      \"full\": 100,
      \"bullet\": 2
    } ],
    \"valueAxes\": [ {
      \"maximum\": 25,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(25, 210, 40)\", \"rgb(246, 211, 43)\", \"rgb(251, 35, 22)\" ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );

    var chart = AmCharts.makeChart( \"chartdiv4\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"Min.\",
      \"excelent\": 20,
      \"good\": 20,
      \"average\": 20,
      \"poor\": 20,
      \"bad\": 20,
      \"limit\": 15,
      \"full\": 100,
      \"bullet\": 17
    } ],
    \"valueAxes\": [ {
      \"maximum\": 30,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(25, 210, 40)\", \"rgb(246, 211, 43)\", \"rgb(251, 35, 22)\" ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );

    var chart = AmCharts.makeChart( \"chartdiv5\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"Nº\",
      \"excelent\": 100,
      \"good\": 100,
      \"average\": 100,
      \"poor\": 100,
      \"bad\": 100,
      \"limit\": 400,
      \"full\": 500,
      \"bullet\": $num_encomendas
    } ],
    \"valueAxes\": [ {
      \"maximum\": 500,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(251, 35, 22)\", \"rgb(246, 211, 43)\", \"rgb(25, 210, 40)\"  ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );

    var chart = AmCharts.makeChart( \"chartdiv6\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"%\",
      \"excelent\": 20,
      \"good\": 20,
      \"average\": 20,
      \"poor\": 20,
      \"bad\": 20,
      \"limit\": 95,
      \"full\": 100,
      \"bullet\": 90
    } ],
    \"valueAxes\": [ {
      \"maximum\": 100,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(251, 35, 22)\", \"rgb(246, 211, 43)\", \"rgb(25, 210, 40)\"  ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );

    var chart = AmCharts.makeChart( \"chartdiv7\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"Min.\",
      \"excelent\": 20,
      \"good\": 20,
      \"average\": 20,
      \"poor\": 20,
      \"bad\": 20,
      \"limit\": 10,
      \"full\": 100,
      \"bullet\": 11
    } ],
    \"valueAxes\": [ {
      \"maximum\": 25,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(25, 210, 40)\", \"rgb(246, 211, 43)\", \"rgb(251, 35, 22)\" ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );

    var chart = AmCharts.makeChart( \"chartdiv8\", {
    \"type\": \"serial\",
    \"rotate\": true,
    \"theme\": \"light\",
    \"autoMargins\": false,
    \"marginTop\": 30,
    \"marginLeft\": 80,
    \"marginBottom\": 30,
    \"marginRight\": 50,
    \"dataProvider\": [ {
      \"category\": \"Nº\",
      \"excelent\": 20,
      \"good\": 20,
      \"average\": 20,
      \"poor\": 20,
      \"bad\": 20,
      \"limit\": 5,
      \"full\": 100,
      \"bullet\": 1
    } ],
    \"valueAxes\": [ {
      \"maximum\": 25,
      \"stackType\": \"regular\",
      \"gridAlpha\": 0
    } ],
    \"startDuration\": 1,
    \"graphs\": [ {
      \"valueField\": \"full\",
      \"showBalloon\": false,
      \"type\": \"column\",
      \"lineAlpha\": 0,
      \"fillAlphas\": 0.8,
      \"fillColors\": [ \"rgb(25, 210, 40)\", \"rgb(246, 211, 43)\", \"rgb(251, 35, 22)\" ],
      \"gradientOrientation\": \"horizontal\"
    }, {
      \"clustered\": false,
      \"columnWidth\": 0.3,
      \"fillAlphas\": 1,
      \"lineColor\": \"rgb(241, 241, 241)\",
      \"stackable\": false,
      \"type\": \"column\",
      \"valueField\": \"bullet\"
    }, {
      \"columnWidth\": 0.5,
      \"lineColor\": \"rgb(0, 0, 0)\",
      \"lineThickness\": 3,
      \"noStepRisers\": true,
      \"stackable\": false,
      \"type\": \"step\",
      \"valueField\": \"limit\"
    } ],
    \"columnWidth\": 1,
    \"categoryField\": \"category\",
    \"categoryAxis\": {
      \"gridAlpha\": 0,
      \"position\": \"left\"
    }
    } );
      </script>";

        }
  }

?>
