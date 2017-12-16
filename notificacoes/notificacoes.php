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

echo "<meta HTTP-EQUIV='refresh' CONTENT='5';URL='0'>";


       	$query = "SELECT faz.id_c,faz.id_e,clientes.nome_completo,clientes.telemovel,encomenda.tipo_encomenda,ponto_entrega_recolha.morada_arm,faz.flag FROM faz
JOIN clientes ON faz.id_c=clientes.id_c
JOIN encomenda ON faz.id_e=encomenda.id_e
JOIN ponto_entrega_recolha ON encomenda.ponto_entrega=ponto_entrega_recolha.id_er
WHERE estado='entregue' and flag=false;";

	$result = execQuery($query,null,null);
 	$array = $result->fetch();
 	$id = $array['id_c'];
	$id_e = $array['id_e'];
	$tele = $array['telemovel'];
	$tipo = $array['tipo_encomenda'];
	$morada = $array['morada_arm'];
	$nome = $array['nome_completo'];
	$flag = $array['flag'];

	$num_registos = $result->rowCount($result);


		if($num_registos > 0 && $flag==FALSE)
		{

			// Use the client to do fun stuff like send text messages!
			$client->messages->create(
    			// the number you'd like to send the message to
   			 '+351'.$tele.'',
   			 array(
      			  // A Twilio phone number you purchased at twilio.com/console
    			  'from' => '+351927403826',
      			  // the body of the text message you'd like to send
      			  'body' => " Caro/a $nome a sua encomenda de $tipo com número de identificação $id_e já pode ser levantada na $morada. DRONE2U"
    			      ));


			$query2 ="UPDATE faz SET flag=true WHERE id_e='$id_e';";
			$result2 = execQuery($query2,null,null);



		}


?>
