<?php
  include_once('../database/database.php');
db();
global $conn;

$ANO = $_POST["ano"];
$MES = $_POST["mes"];
$CATEGORIA = $_POST["categoria"];
$VALOR = $_POST["valor"];


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

$valoresAtuais[$CATEGORIA] = sprintf("%.2f", $valoresAtuais[$CATEGORIA]+$VALOR);

$stmt2 = $conn->prepare('UPDATE despesas SET salarios=?, aguagas=?, energia=?, aluguer=?, manutencao=?, outras=? WHERE data=?');
$stmt2->execute(array($valoresAtuais["salarios"],$valoresAtuais["aguagas"],$valoresAtuais["energia"],$valoresAtuais["aluguer"],$valoresAtuais["manutencao"],$valoresAtuais["outras"],$dateString));


header("Location: index.php");

 ?>
