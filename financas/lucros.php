<?php
  include_once('../database/database.php');
	db();
  global $conn;

  // Fetch the data
  $stmt = $conn->prepare('SELECT "data", "totalReceitas"- "totalDespesas"
                          as "lucro"
                          FROM (SELECT "receitas"."data"
                                as "data", "salarios" + "aguagas" + "energia" + "aluguer" + "manutencao" + "despesas"."outras"
                                as "totalDespesas", "0a1" + "1a2" + "2a3" + "3a4" + "receitas"."outras"
                                as "totalReceitas"
                                FROM "despesas"
                                JOIN "receitas"
                                ON ("despesas"."data" = "receitas"."data"))
                                as lucros;');
  $stmt->execute();


  // Set proper HTTP response headers
  header( 'Content-Type: application/json' );

  // Print out rows
  $datas = array();
  while ( $row = $stmt->fetch() ) {
    $datas[] = $row;
  }
  echo json_encode( $datas, JSON_NUMERIC_CHECK );

  #var_dump(round($media[*], 2));



  ?>
