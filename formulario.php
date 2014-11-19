<?php
require 'includes/PHPMailerAutoload.php';
require 'includes/functions.php';


$mail = new PHPMailer();

$nombre = utf8_decode($_POST["nombre"]);
$correo = $_POST["correo"];
$asunto = utf8_decode($_POST["asunto"]);
$contenido = utf8_decode($_POST["contenido"]);

$estadoEnvio = '00';
$detalleLog = '';
$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
$body = '';


$de = trim(strip_tags($correo));
$para = trim(strip_tags($para));

//try {
if (preg_match($pattern, $de)){
	// para aplicarla

	if (validar_email($de)) {
		$mensaje = "Nombre del remitente: ".$nombre."<br />";
		$mensaje .= "Correo: ".$correo."<br />";
		$mensaje .= "Asunto: ".$asunto."<br />";
		$mensaje .= "Comentario: ".$contenido."";
		
		$mail->isSMTP();

		$mail->Host = 'mail.globalmembers.net';
		//$mail->SMTPDebug = 2;

		$mail->SMTPAuth = true;
		$mail->Host = 'mail.globalmembers.net';
		$mail->Port = 25;
		$mail->Username = 'info@globalmembers.net';
		$mail->Password = 'Global2014';
		$mail->SMTPSecure = 'tls';

		$mail->setFrom($de);
		$mail->addAddress('lovelessisma@gmail.com');
		//$mail->addAddress('luis.monroy@globalmembers.net');
		$mail->addAddress('lmonroy1971_1@hotmail.com');
		//$mail->addAddress('lmonroy@solucorp.com.pe');
		$mail->addAddress('info@globalmembers.net');
		$mail->isHTML(true);

		$mail->Subject = $asunto;
		$mail->Body    = $mensaje;

		if (!$mail->send()) {
			$estadoEnvio = '01'; //no enviado
			$detalleLog = $mail->ErrorInfo;
		}
		else {
			$estadoEnvio = '00'; //enviado
			$detalleLog = 'Enviado correctamente';
		}

		$mail->smtpClose();
	}
	else {
		$estadoEnvio = '01'; //no enviado
		$detalleLog = 'El correo no es válido.';
	}
}
else {
	$estadoEnvio = '01';
	$detalleLog = 'La dirección de la que se intenta enviar es incorrecta.';
}
/*}
catch (phpmailerException $e) {
	$estadoEnvio = '01';
	$detalleLog = $e->errorMessage(); //Pretty error messages from PHPMailer
}
catch (Exception $e) {
	$estadoEnvio = '01';
	$detalleLog = $e->getMessage(); //Boring error messages from anything else!
}
*/
$jsondata = array("estadoEnvio" => $estadoEnvio, 'detalleLog' => $detalleLog); 
echo json_encode($jsondata);
flush();
?>