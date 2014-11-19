<?php
require("common/sesion.class.php");
require("adata/Db.class.php");
require("common/functions.php");
require("bussiness/usuarios.php");

$usuario = new clsUsuario();
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '0';
$rs = $usuario->ObtenerRegistro($codigo);
$count = count($rs);

if ($_POST){
    if ($count > 0) {
        $correo = $rs[0]['tm_email'];
        $codigo = $rs[0]['td_codigo'];

        $cleanedFrom = 'info@globalmembers.net';
        $enlaceverificacion = 'http://www.globalmembers.net/members/confirmar.php?id='.$codigo;

        $headers = "From: " . $cleanedFrom . "\r\n";
        $headers .= "Reply-To: ". $cleanedFrom . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mensaje = "Usted solicito un registro en globalmembers.net, \n";
        $mensaje .= "Para confirmarlo debe hacer click en el siguiente enlace: \n";
        $mensaje .= '<a href="'.$enlaceverificacion.'">'.$enlaceverificacion.'</a>';

        mail($email, 'Confirmación de registro en Global Members', $mensaje, $headers);
        header("location: endregister.php");
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Registro en Global Members</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <style>
    body {
        background-color: #1A4A4A;
        padding:10px;
    }

    h2 {
        color: #ddd;
    }

    p {
        color: #ccc;
    }

    .button {
        display:inline-block;
        border:1px solid transparent;
        border-radius: 4px;
        margin: 20px auto 20px;
        padding: 10px;
        color: #bbb;
        text-transform:uppercase ;   
        background: #2980b9; 
        -webkit-transition: all .5s ease-in-out;
        -moz-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
        text-align: center;
        
    }
    .button:hover {   
        border:1px solid #FFF;
        color:#fff;
        opacity: 0.8;
        text-decoration: none;
    } 
    </style>
</head>
<body class="metro">
    <div style="padding-bottom:20px;">
        <h2 class="fg-white">S&oacute;lo un paso m&aacute;s.</h2>
        <p class="fg-white">Se ha enviado un correo electr&oacute;nico al correo que usted ha indicado para validar su registro.</p>
        <a id="btnResendEmail" href="#" class="button">Volver a enviar e-mail de confirmaci&oacute;n.</a>
    </div>
</body>
</html>