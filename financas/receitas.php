<?php
  include_once('../database/database.php');
  db();

  global $conn;

  // Fetch the data
  $stmt = $conn->prepare('SELECT "data", "0a1", "1a2", "2a3", "3a4", "outras"
                          FROM "receitas";');
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
