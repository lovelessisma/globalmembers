<?php
header('Content-type: text/html; charset=utf-8');
include("adata/Db.class.php");
include("bussiness/empresas.php");
require_once("common/sesion.class.php");
$objData = new clsEmpresa();
$sesion = new sesion();
$idusuario = $sesion->get("idusuario");
$codigo = $sesion->get("codigo");
$login = $sesion->get("login");
$nombres = $sesion->get("nombres");
$idperfil = $sesion->get("idperfil");
$fotoUsuario = $sesion->get("foto");
$correoUsuario = $sesion->get("correo");
$i = 0;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Union for Quality Intercontinental - INTRANET CORPORATIVA</title>
    <script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.10.1.custom.js"></script>
    <script type="text/javascript" src="scripts/jquery.blockUI.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.10.1.custom.min.css"/>
    <link rel="stylesheet" type="text/css" href="styles/modern.css"/>
    <link rel="stylesheet" type="text/css" href="styles/modern-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="styles/prettify.css"/>
    <link rel="stylesheet" type="text/css" href="styles/site.css"/>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <script type="text/javascript" src="scripts/prettify.js"></script>
    <script type="text/javascript" src="scripts/functions.js"></script>
    <script type="text/javascript">
        $(function(){
            prettyPrint();
            <?php 
            if( $login == false ){
            ?>
            $("#btnRegresar").click(function(){
                window.location = "index.php";
                return false;
            });
            <?php
            }
            ?>
        });
    </script>
</head>
<body class="metrouicss" style="zoom: 1;">
<?php
if( $login == true ){
    $tipofiltro = isset($_GET['tipofiltro']) ? $_GET['tipofiltro'] : '00';
    $idfiltro = isset($_GET['idfiltro']) ? $_GET['idfiltro'] : '0';
    $idpais = $tipofiltro == '00' ? $idfiltro : '0';
    $idrubro = $tipofiltro == '01' ? $idfiltro : '0';
    $esmiembro = $tipofiltro == '02' ? $idfiltro : '0';
    $parametros = array(
    'tipocriterio' => 'isEmp', 
    'criterio' => '',
    'idtipoorg' => '0',
    'idpais' => $idpais,  
    'idrubro' => $idrubro,
    'miembro' => $esmiembro,
    'lastid' => '0' );

    $row = $objData->Listar('DETEMAIL', $parametros);
    $countrow = count($row);
?>
    <div class="header">
        <div class="logo">
            <h3>INTRANET CORPORATIVA</h3>
        </div>
        <div class="profile-box">
            <span class="profile">
                <a href="#" class="section">
                    <img class="image" src="<?php echo $fotoUsuario; ?>" alt="image description" width="26" height="26">
                    <span class="text-box">
                        Bienvenido
                        <strong class="name"><?php echo $nombres; ?></strong>
                    </span>
                </a>
            </span>
            <a title="Cerrar sesi&oacute;n" class="btn-on" href="logout.php">On</a>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear">
    </div>
    <div class="page-region">
        <div class="data-view">
            <table id="tblDatos" class="bordered hovered fg-color-white">
                <thead>
                    <tr>
                        <th class="bg-color-darken fg-color-white">Tipo</th>
                        <th class="bg-color-darken fg-color-white">Nombre</th>
                        <th class="bg-color-darken fg-color-white">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($i < $countrow)
                    {
                    ?>
                    <tr>
                        <td><?php echo $row[$i]['TipoOrg']; ?></td>
                        <td><?php echo $row[$i]['tm_nombre']; ?></td>
                        <td><?php echo $row[$i]['tm_email']; ?></td>
                    </tr>
                    <?php
                        ++$i;
                    }
                    ?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
    </div>
<?php

?>
<?php
}
else {
?>
    <div style="width:100%; height:100%; background:rgba(0,0,0,0.5);">
        <div class="message-dialog bg-color-red fg-color-white" style="padding-bottom:20px;">
            <h2 style="color:#fff;">Acceso denegado</h2>
            <p>Debe iniciar sesi&oacute;n para acceder al sistema</p>
            <button id="btnRegresar" name="btnRegresar" type="button" class="place-right">Regresar</button>
        </div>
    </div>
<?php
}
?>
</body>
