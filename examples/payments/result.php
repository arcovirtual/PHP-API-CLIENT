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
	
	print_r($response);
// resultado $response = array(9) { ["flowOrder"]=> int(35779) ["commerceOrder"]=> string(4) "1961" 
// recorremos el array resultado	
	foreach($response as $flowordervalor => $ordennumero)
	{ echo  "Numero de Orden: <b> $ordennumero </b> "; }
	// y asi siguen extrayendo info no se si se podran
	//usar las variables nuevas como $ordennumero para ser usada en otras integraciones deberia poder.
	
} catch (Exception $e) {
	echo "Error: " . $e->getCode() . " - " . $e->getMessage();
}

?>
