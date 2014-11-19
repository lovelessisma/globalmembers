<?php
require("common/sesion.class.php");
require('common/PHPMailerAutoload.php');
require("adata/Db.class.php");
require("common/functions.php");
require("bussiness/usuarios.php");
require('common/class.translation.php');

$lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'es';
$translate = new Translator($lang);

$sesion = new sesion();
$usuario = new clsUsuario();

if ($_POST) {
    if ($_SESSION['tmptxt'] != $_POST['tmptxt']){
        $mensajeCaptcha = 'Código incorrecto';
    }
    else {
        $fecharegistro = date("Y-m-d h:i:s");
        $email = $_POST['txtEmail'];

        $entidadUsuario = array(
            'tm_idusuario' => 0,
            'tm_idempresa' => 1,
            'tm_idcentro' => 1,
            'tm_idperfil' => 1,
            'tm_codigo' => '',
            'tm_login' => $_POST['txtUsuario'],
            'tm_nombres' => $_POST['txtNombres'],
            'tm_clave' => $_POST['txtPassword'],
            'tm_apellidopaterno' => $_POST['txtApellidoPaterno'],
            'tm_apellidomaterno' => $_POST['txtApellidoMaterno'],
            'tm_sexo' => '',
            'tm_nrodni' => '',
            'tm_nroruc' => '',
            'tp_idpais' => $_POST['ddlPais'],
            'tm_ididioma' => $_POST['ddlIdioma'],
            'tm_direccion' => '',
            'tm_email' => $email,
            'tm_telefono' => '',
            'tm_foto' => $_POST['hdFoto'],
            'Activo' => 1,
            'IdUsuarioReg' => 1,
            'FechaReg' => $fecharegistro,
            'IdUsuarioAct' => 1,
            'FechaAct' => $fecharegistro
        );

        $rpta = $usuario->Registrar($entidadUsuario);
        
        if ($rpta) {
            $codigoverificacion = md5(uniqid($_POST['txtUsuario'].$fecharegistro, true));

            $entidadCuenta = array( 'tm_idusuario' => $rpta,
                                    'td_fecha' => $fecharegistro,
                                    'td_codigo' => $codigoverificacion,
                                    'ta_estadoregcuenta' => '00',
                                    'Activo' => 1,
                                    'IdUsuarioReg' => 1,
                                    'FechaReg' => $fecharegistro,
                                    'IdUsuarioAct' => 1,
                                    'FechaAct' => $fecharegistro );

            $rptaCuenta = $usuario->RegistroMiembro($entidadCuenta);

            if ($rptaCuenta) {
                $cleanedFrom = 'info@globalmembers.net';
                $enlaceverificacion = 'http://www.globalmembers.net/members/confirmar.php?codigo='.$codigoverificacion;

                /*$headers = "From: " . $cleanedFrom . "\r\n";
                $headers .= "Reply-To: ". $cleanedFrom . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
*/
                $mensaje = "Usted solicito un registro en globalmembers.net, \n";
                $mensaje .= "Para confirmarlo debe hacer click en el siguiente enlace: \n";
                $mensaje .= '<a href="'.$enlaceverificacion.'">'.$enlaceverificacion.'</a>';

                $mail->isSMTP();

                $mail->Host = 'mail.globalmembers.net';
                //$mail->SMTPDebug = 2;

                $mail->SMTPAuth = true;
                $mail->Host = 'mail.globalmembers.net';
                $mail->Port = 25;
                $mail->Username = 'info@globalmembers.net';
                $mail->Password = 'Global2014';
                $mail->SMTPSecure = 'tls';

                $mail->setFrom($cleanedFrom);
                $mail->addAddress($email);
                $mail->isHTML(true);

                $mail->Subject = 'Confirmación de registro en Global Members';
                $mail->Body    = $mensaje;

                if (!$mail->send()) {
                    header("location: errorregister.php");
                }
                else {
                    header("location: endregister.php");
                }
            }
        }

        /*$validUsuario = $usuario->loginUsuario($_POST['txtUsuario'], $_POST['txtPassword']);
        if (strlen($validUsuario['idusuario']) > 0){
            $sesion->set("idusuario", $validUsuario['idusuario']);
            $sesion->set("codigo", $validUsuario['codigo']);
            $sesion->set("login", $validUsuario['login']);
            $sesion->set("nombres", $validUsuario['nombres']);
            $sesion->set("idperfil", $validUsuario['idperfil']);
            $sesion->set("foto", $validUsuario['foto']);
            
        }*/
        exit(0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Registro en Global Members</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="styles/uploadfile.css"/>
        <link rel="stylesheet" href="styles/droparea-single.css"/>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style>
            .droparea {
                position:relative;
                margin: 0 auto;
                text-align: center;
                color: #fff;
            }
            .droparea div, .droparea input, .multiple div, .multiple input {
                position: absolute;
                color: #fff;
                top:0;
                width: 100%;
                height: 100%;
            }
            .droparea input, .multiple input {
                cursor: pointer; 
                color: #fff;
                opacity: 0;
            }
            .droparea .instructions, .multiple .instructions {
                border: 2px dashed #ddd;
                color:#fff;
                opacity: .8;
            }
            .droparea .instructions.over, .multiple .instructions.over {
                border: 2px dashed #000;
                background: #ffa;
            }
            .droparea .progress, .multiple .progress {
                position:absolute;
                bottom: 0;
                width: 100%;
                height: 0;
                color: #fff;
                background: #6b0;
            }
            .multiple .progress {
                width: 0;
                height: 100%;
            }
            div.spot {
                float: left;
                margin: 0 20px 0 0;
                width: 235px;
                height: 235px !important;
                min-height: 235px;
            }
            div.spot input[type="file"]{
                height: 235px !important;
            }
            .thumb {
                float: left;
                margin:0 20px 20px 0;
                width: 235px;
                min-height: 235px;
            }

            #area {
                margin: 0 auto;
                width: 255px;
                height: 255px;
            }
        </style>
    </head>

    <body>
        
        <div class="register-container container">
            <div class="row">
                <div class="register">
                    <h2><span class="miembro">Miembro</span> <span class="blue"><strong>GLOBAL MEMBERS</strong></span></h2>
                    <div class="clear"></div>
                    <form id="formulario" name="formulario" action="register.php" method="post">
                        <input id="hdFoto" name="hdFoto" type="hidden" value="images/user-nosetimg.jpg" />
                        <div class="span6">
                            
                            <div id="area">
                                <input id="userFoto" type="file" class="droparea spot" name="xfile" data-post="upload.php" data-width="235" data-height="235" data-crop="true"/>
                            </div>
                            <label for="txtApellidoPaterno">Apellido Paterno</label>
                            <input type="text" id="txtApellidoPaterno" name="txtApellidoPaterno" placeholder="ingresa tu apellido paterno...">
                            <label for="txtApellidoMaterno">Apellido Materno</label>
                            <input type="text" id="txtApellidoMaterno" name="txtApellidoMaterno" placeholder="ingresa tu apellido materno...">
                            <label for="txtNombres">Nombres</label>
                            <input type="text" id="txtNombres" name="txtNombres" placeholder="ingresa tu nombre...">
                        </div>
                        <div class="span6">
                            <div id="panel1">
                                <div class="span3">
                                    <label for="ddlPais">Pa&iacute;s de residencia</label>
                                    <select id="ddlPais" name="ddlPais">
                                        <?php 
                                        echo loadOpcionSel("tp_pais", "Activo=1", "tp_idpais", "tp_nombre");
                                        ?>
                                    </select>
                                </div>
                                <div class="span3">
                                    <label for="ddlIdioma">Idioma</label>
                                    <select id="ddlIdioma" name="ddlIdioma">
                                        <?php 
                                        echo loadOpcionSel("tm_idioma", "Activo=1", "tm_ididioma", "tm_nombre");
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <label for="txtEmail">Email</label>
                            <input type="text" id="txtEmail" name="txtEmail" placeholder="ingresa tu email..." />
                            <label for="txtUsuario">Usuario</label>
                            <input type="text" id="txtUsuario" name="txtUsuario" placeholder="elija un nombre de usuario..." />
                            <label for="txtContrasena">Clave</label>
                            <input type="password" id="txtContrasena" name="txtContrasena" placeholder="elija un password..." />
                            <label for="txtConfirmContrasena">Confirmar clave</label>
                            <input type="password" id="txtConfirmContrasena" name="txtConfirmContrasena" placeholder="elija un password..." />
                            <div class="span3">
                                <img src="captcha.php" width="100" height="30" vspace="3">
                                <br />
                                <?php echo $mensajeCaptcha; ?>
                            </div>
                            <div class="span3">
                                <input id="tmptxt" name="tmptxt" type="text" placeholder="ingrese el c&oacute;digo CAPTCHA..." />
                            </div>
                            <button id="btnRegistro" name="btnRegistro" type="submit">REGISTRARSE</button>
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="scripts/jquery/jquery-1.9.0.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <script>
            if (typeof($.fn.modal) === 'undefined') {
                document.write('<script src="scripts/bootstrap.min.js"><\/script>');
            }
        </script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/localization/messages_es.js"></script>
        <script>
            if (typeof $.validate === 'undefined') {
                document.write('<script src="scripts/jquery-validation-1.13.0/jquery.validate.min.js">\x3C/script>');
                document.write('<script src="scripts/jquery-validation-1.13.0/additional-methods.min.js">\x3C/script>');
                document.write('<script src="scripts/jquery-validation-1.13.0/localization/messages_es.min.js">\x3C/script>');
            }
        </script>
        <script src="scripts/droparea.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="scripts/functions.js"></script>
        <script>
        $(window).load(function() {

            $("#formulario").validate({
                lang: 'es',
                showErrors: showErrorsInValidate
            });

            $('.droparea').droparea({
                'instructions': '<?php $translate->__('arrastre una imagen o haga click aqu&iacute;'); ?>',
                'init' : function(result){
                    //console.log('custom init',result);
                    
                    $("#area").find(".spot").append($('<img>',{'src': '<?php echo $row[0]['tm_foto'] == "" ? "images/user-nosetimg.jpg" : $row[0]['tm_foto']; ?>'}));
                },
                'start' : function(area){
                    area.find('.error').remove(); 
                },
                'error' : function(result, input, area){
                    $('<div class="error">').html(result.error).prependTo(area); 
                    return 0;
                    //console.log('custom error',result.error);
                },
                'complete' : function(result, file, input, area){
                    if((/image/i).test(file.type)){
                        area.find('img').remove();
                        //area.data('value',result.filename);
                        area.append($('<img>',{'src': result.filename + '?' + Math.random() }));
                        $('#hdFoto').val(result.path + result.filename);
                    } 
                    //console.log('custom complete',result);
                }
            });

            addValidForm();
        });

        function addValidForm () {
            $('#txtApellidoPaterno').rules('add', {
                required: true,
                messages: {
                    required: "<?php $translate->__('Por favor ingrese su apellido paterno'); ?>"
                }
            });

            $('#txtNombres').rules('add', {
                required: true,
                messages: {
                    required: "<?php $translate->__('Por favor ingrese su nombre'); ?>"
                }
            });

            $('#txtUsuario').rules('add', {
                required: true,
                remote: "services/usuarios/check-username.php",
                messages: {
                    required: "<?php $translate->__('Por favor ingrese un usuario valido'); ?>",
                    remote: "<?php $translate->__('El nombre de usuario ya ha sido ingresado'); ?>"
                }
            });

            $('#txtContrasena').rules('add', {
                required: true,
                minlength: 6,
                messages: {
                    required: "<?php $translate->__('Por favor ingrese una clave'); ?>",
                    minlength: $.validator.format("<?php $translate->__('Tu clave debe tener al menos {0} caracteres'); ?>")
                }
            });

            $('#txtConfirmContrasena').rules('add', {
                required: true,
                equalTo: "#txtContrasena",
                messages: {
                    required: "<?php $translate->__('Por favor confirma la clave'); ?>",
                    equalTo: "<?php $translate->__('La clave debe ser la misma que la ingresada arriba'); ?>"
                }
            });

            $('#txtEmail').rules('add', {
                required: true,
                email: true,
                messages: {
                    email: "<?php $translate->__('Por favor ingrese un e-mail valido'); ?>"
                }
            });
        }

        function EnvioRegistro (form) {
            form.submit();
        }
        </script>
    </body>

</html>

