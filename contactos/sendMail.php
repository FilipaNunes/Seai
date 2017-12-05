<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Europe/Lisbon');

require "../lib/PHPMailer_5.2.4/class.phpmailer.php";
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$NOME = $_POST["nome"];
$EMAIL = $_POST["email"];
$ASSUNTO = $_POST["assunto"];
$MENSAGEM = $_POST["mensagem"];


$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "seai.2017.equipa.c@gmail.com";
$mail->Password = "somososmaiores";
$mail->SetFrom($EMAIL, $NOME);
$mail->Subject = $ASSUNTO;
$mail->Body = $MENSAGEM;
$mail->AddAddress("seai.2017.equipa.c@gmail.com", 'Drone2u');

//meter notificações

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {

  header("Location: index.php");
}
?>
