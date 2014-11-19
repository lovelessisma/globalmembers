<?php
require("common/class.translation.php");
require("common/sesion.class.php");
require("adata/Db.class.php");
require("bussiness/usuarios.php");

$lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'es';
$translate = new Translator($lang);

$sesion = new sesion();
$usuario = new clsUsuario();

if ($_POST) {
	$txtUsuario = (isset($_POST['txtUsuario'])) ? $_POST['txtUsuario'] : '' ;
	$txtClave = (isset($_POST['txtClave'])) ? $_POST['txtClave'] : '' ;

	$validUsuario = $usuario->loginUsuario($txtUsuario, $txtClave);
    if (strlen($validUsuario['idusuario']) > 0){
        $sesion->set("idusuario", $validUsuario['idusuario']);
        $sesion->set("codigo", $validUsuario['codigo']);
        $sesion->set("login", $validUsuario['login']);
        $sesion->set("nombres", $validUsuario['nombres']);
        $sesion->set("idperfil", $validUsuario['idperfil']);
        $sesion->set("foto", $validUsuario['foto']);
        header("location: index.php");
    }
    else
        header("location: failed-login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php $translate->__('GLOBAL MEMBERS ZONA DE MIEMBROS'); ?></title>
	<link rel="stylesheet" href="styles/bootstrap.min.css" />
	<link rel="stylesheet" href="styles/login.css" />
	<link rel="stylesheet" href="styles/login-theme-1.css" />
</head>
<body class="fade-in">
		<div class="container" id="login-block">
    		<div class="row">
			    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
			    	 
			       <div class="login-box clearfix animated flipInY">
			       		<div class="page-icon animated bounceInDown">
			       			<img src="images/logo-gm.png" alt="Company Logo" />
			       		</div>
			        	<div class="login-logo">
			        		<h4><?php $translate->__('ZONA DE MIEMBROS'); ?></h4>
			        	</div> 
			        	<hr />
			        	<div class="login-form">
			        		<!-- Start Error box -->
			        		<div class="alert alert-danger hide">
								  <button type="button" class="close" data-dismiss="alert"> &times;</button>
								  <h4>Error!</h4>
								   Your Error Message goes here
							</div> <!-- End Error box -->
			        		<form action="login.php" method="post">
						   		 <input id="txtUsuario" name="txtUsuario" type="text" placeholder="<?php $translate->__('Usuario'); ?>" class="input-field" required/> 
						   		 <input id="txtClave" name="txtClave" type="password"  placeholder="<?php $translate->__('Clave'); ?>" class="input-field" required/> 
						   		 <button type="submit" class="btn btn-login"><?php $translate->__('INGRESO'); ?></button> 
							</form>	
							<div class="login-links"> 
					            <a href="forgot-password.html">
					          	   <?php $translate->__('Olvid&oacute; su clave'); ?>
					            </a>
					            <br />
					            <a href="register.php">
					              <?php $translate->__('No tiene una cuenta'); ?> <strong><?php $translate->__('Reg&iacute;strese'); ?></strong>
					            </a>
							</div>      		
			        	</div> 			        	
			       </div>
			    </div>
			</div>
    	</div>
     
      	<!-- End Login box -->
     	<footer class="container">
     		<p id="footer-text"><small>Copyright &copy; 2014 <a href="http://www.globalmembers.net/">Global Members S.A.C.</a></small></p>
     	</footer>
</body>
</html>