<?php include_once("../database/database.php");?>

<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require '../lib/twilio-php-master/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC1cef75aa9488e1ad24937745479799aa';
$token = '9de3962b16062aff92f5748e9b0fbe1f';
$client = new Client($sid, $token);

$query = "SELECT * FROM armazem";
	$result = execQuery($query,null,null);

  $num_registos = $result->rowCount($result);

  $array = $result->fetch();

  $id = $array['id_a'];
  $nome = $array['nome'];
  $morada_arm = $array['morada_arm'];
  $ocupacao = $array['ocupacao'];
  $lotacao_max = $array['lotacao_max'];

  print_r($id);


// Use the client to do fun stuff like send text messages!
/*client->messages->create(
    // the number you'd like to send the message to
    '+351916277515',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+351927403826',
        // the body of the text message you'd like to send
        'body' => "Encomenda entregue!"
    )
);*/
?>
