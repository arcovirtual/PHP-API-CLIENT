<?php
/**
 * Pagina del comercio para redireccion del pagador
 * A esta página Flow redirecciona al pagador pasando vía POST
 * el token de la transacción. En esta página el comercio puede
 * mostrar su propio comprobante de pago
 */
require(__DIR__ . "/../../lib/FlowApi.class.php");

try {
	//Recibe el token enviado por Flow
	if(!isset($_POST["token"])) {
		throw new Exception("No se recibio el token", 1);
	}
	$token = filter_input(INPUT_POST, 'token');
	$params = array(
		"token" => $token
	);
	//Indica el servicio a utilizar
	$serviceName = "payment/getStatus";
	$flowApi = new FlowApi();
	$response = $flowApi->send($serviceName, $params, "GET");
	
// resultado $response = Array ( [flowOrder] => 35780 [commerceOrder] => 1231 [requestDate] => 2018-09-29 06:49:56 [status] => 2 
// recorremos el array resultado	
	foreach($response as $titulodato=>$valordato)
	{
	echo "- " . $titulodato . " : " . $valordato . "</br>";
	}
	
	print_r($response);
//	var_dump($response);
	
} catch (Exception $e) {
	echo "Error: " . $e->getCode() . " - " . $e->getMessage();
}

?>
