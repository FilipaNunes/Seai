<?php
  include_once('../database/database.php');

global $conn;

$ANO = $_POST["ano"];
$MES = $_POST["mes"];
$SALARIOS = $_POST["salarios"];
$AGUAGAS = $_POST["aguagas"];
$ENERGIA = $_POST["energia"];
$ALUGUER = $_POST["aluguer"];
$MANUTENCAO = $_POST["manutencao"];
$OUTRAS = $_POST["outras"];


$dateString = $ANO . "-" . $MES . "-01";

$stmt3 = $conn->prepare('SELECT EXISTS(SELECT * FROM despesas WHERE data=?)');
$stmt3->execute(array($dateString));
$bool = $stmt3->fetch();

if ($bool["exists"] == false){

  $stmt4 = $conn->prepare('INSERT INTO despesas (data, salarios, aguagas, energia, aluguer, manutencao, outras)
                          VALUES (?,0,0,0,0,0,0) ');
  $stmt4->execute(array($dateString));

}

$stmt = $conn->prepare('SELECT *
                        FROM despesas
                        WHERE data = ?');
$stmt->execute(array($dateString));
$valoresAtuais = $stmt->fetch();

$valoresAtuais["salarios"] = sprintf("%.2f", $valoresAtuais["salarios"]+$SALARIOS);
$valoresAtuais["aguagas"] = sprintf("%.2f", $valoresAtuais["aguagas"]+$AGUAGAS);
$valoresAtuais["energia"] = sprintf("%.2f", $valoresAtuais["energia"]+$ENERGIA);
$valoresAtuais["aluguer"] = sprintf("%.2f", $valoresAtuais["aluguer"]+$ALUGUER);
$valoresAtuais["manutencao"] = sprintf("%.2f", $valoresAtuais["manutencao"]+$MANUTENCAO);
$valoresAtuais["outras"] = sprintf("%.2f", $valoresAtuais["outras"]+$OUTRAS);

$stmt2 = $conn->prepare('UPDATE despesas SET salarios=?, aguagas=?, energia=?, aluguer=?, manutencao=?, outras=? WHERE data=?');
$stmt2->execute(array($valoresAtuais["salarios"],$valoresAtuais["aguagas"],$valoresAtuais["energia"],$valoresAtuais["aluguer"],$valoresAtuais["manutencao"],$valoresAtuais["outras"],$dateString));


header("Location: index.php");

 ?>
