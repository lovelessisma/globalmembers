<?php
require('includes/class.translation.php');
if(isset($_GET['lang']))
	$translate = new Translator($_GET['lang']);
else
	$translate = new Translator('es');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>GLOBAL MEMBERS</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
	<link rel='stylesheet' id='camera-css'  href='css/camera.css' type='text/css' media='all' />

	<link rel="stylesheet" type="text/css" href="css/slicknav.css"/>
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/another-style.css"/>
	
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700|Open+Sans:700' rel='stylesheet' type='text/css' />
	
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script> 
	<script type="text/javascript" src="js/camera.min.js"></script>
	<script type="text/javascript" src="js/myscript.js"></script>
	<script src="js/sorting.js" type="text/javascript"></script>
	<script src="js/jquery.isotope.js" type="text/javascript"></script>
	<!--start slider -->
	<link rel="stylesheet" href="css/fwslider.css" media="all"/>
	<script src="js/css3-mediaqueries.js"></script>
	<script src="js/fwslider.js"></script>
	<link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css"/>
	<script type="text/javascript" src="js/JFCore.js"></script>
	<script type="text/javascript" src="js/JFForms.js"></script>
	<!--end slider -->
	<!--script type="text/javascript" src="js/jquery.nav.js"></script-->
	<script>
		jQuery(function(){
				jQuery('#camera_wrap_1').camera({
				transPeriod: 500,
				time: 3000,
				height: '490px',
				thumbnails: false,
				pagination: true,
				playPause: false,
				loader: false,
				navigation: false,
				hover: false
			});
		});
		var pull 		= $('#pull');
			menu 		= $('nav ul');
			menuHeight	= menu.height();

		$(pull).on('click', function(e) {
			e.preventDefault();
			menu.slideToggle();
		});

		$(window).resize(function(){
    		var w = $(window).width();
    		if(w > 320 && menu.is(':hidden')) {
    			menu.removeAttr('style');
    		}
		});
	</script>
</head>
<body>
    
    <!--home start-->
    
    <div id="home">
    	<!-- start header -->
		<div class="header_bg">
			<div class="wrap">
				<div id="menuF" class="header">
					<div class="logo">
						<a href="index.html"><img src="images/logo-gm.png" alt=""/></a>
					</div>
					<div class="navmenu h_right">
						<!--start menu -->
						<ul class="menu">
							<li class="active"><a href="#home"><?php $translate->__('Inicio'); ?></a></li>
							<li><a href="#about"><?php $translate->__('Nosotros'); ?></a></li>
							<li><a href="#project"><?php $translate->__('Proyectos'); ?></a></li>
							<li><a href="#news"><?php $translate->__('Novedades'); ?></a></li>
							<li class="last"><a href="#contact"><?php $translate->__('Contactenos'); ?></a></li>
						</ul>
						<!-- start profile_details -->
						<form class="style-1 drp_dwn">
							<div class="rowX">
								<div class="grid_3 columns">
									<select class="custom-select" id="select-1">
										<option value="es" selected="selected">Español</option>
										<option value="en">English</option>
										<option value="de">Deutsch</option>
										<option value="pr">Português</option>
										<option value="fr">Français</option>
										<option value="it">Italiano</option>
									</select>
								</div>		
							</div>		
						</form>
					</div>
					<div class="clear"></div>
					<div class="top-nav">
						<nav class="clearfix">
							<ul>
								<li class="active"><a href="#home"><?php $translate->__('Inicio'); ?></a></li> 
								<li><a href="#about"><?php $translate->__('Nosotros'); ?></a></li>
								<li><a href="#project"><?php $translate->__('Proyectos'); ?></a></li>
								<li><a href="#news"><?php $translate->__('Novedades'); ?></a></li>
								<li class="last"><a href="#contact"><?php $translate->__('Contactenos'); ?></a></li>
							</ul>
							<a href="#" id="pull">Menu</a>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="banner">
			<ul>
				<li style="background-image: url('images/bg-all.jpg');">
					<h1><?php $translate->__('Mensaje_1'); ?></h1>
					<p><?php $translate->__('Mensaje_2'); ?></p>
					<a class="btn" href="members/login.php"><?php $translate->__('Mensaje_3'); ?></a>
				</li>
				
				<li style="background-image: url('images/wood.jpg');">
					<h1><?php $translate->__('Mensaje_4'); ?></h1>
					<p><?php $translate->__('Mensaje_5'); ?></p>
					
					<a class="btn" href="members/login.php"><?php $translate->__('Mensaje_3'); ?></a>
				</li>
				
				<li style="background-image: url('images/subway.jpg');">
					<h1><?php $translate->__('Mensaje_6'); ?></h1>
					<p><?php $translate->__('Mensaje_7'); ?></p>
					
					<a class="btn" href="members/login.php"><?php $translate->__('Mensaje_3'); ?></a>
				</li>
				
				<li style="background-image: url('images/shop.jpg');">
					<h1><?php $translate->__('Mensaje_8'); ?></h1>
					<p><?php $translate->__('Mensaje_9'); ?></p>
					
					<a class="btn" href="members/login.php"><?php $translate->__('Mensaje_3'); ?></a>
				</li>
			</ul>
		</div>
		<div class="bg-white">
			<div class="container">
				<div class="row">
					<div class="col-md-4 project">
						<h3 id="counter">0</h3>
						<h4><?php $translate->__('Mensaje_10'); ?></h4>
						<p><?php $translate->__('Mensaje_11'); ?></p>
					</div>
					<div class="col-md-4 project">
						<h3 id="counter1">0</h3>
						<h4><?php $translate->__('Mensaje_12'); ?></h4>
						<p><?php $translate->__('Mensaje_13'); ?></p>
					</div>
					<div class="col-md-4 project">
						<h3 id="counter2" style="margin-left: 20px;">0</h3>
						<h4 style="margin-left: 20px;"><?php $translate->__('Mensaje_14'); ?></h4>
						<p><?php $translate->__('Mensaje_15'); ?></p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12 cBusiness">
						<h3><?php $translate->__('Mensaje_16'); ?></h3>
						<h4><?php $translate->__('Mensaje_17'); ?></h4>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12 centPic">
						<img class="img-responsive" src="images/bizPic.png"/>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <!--about start-->    
    
    <div id="about">
    	<div class="line2">
			<div class="container">
				<div class="row Fresh">
					<div class="col-md-4 Des">
						<i class="fa fa-heart"></i>
						<h4><?php $translate->__('Diseno'); ?></h4>
						<p><?php $translate->__('Diseno_txt'); ?></p>
					</div>
					<div class="col-md-4 Ver">
						<i class="fa fa-cog"></i>
						<h4><?php $translate->__('Flexible'); ?></h4>
						<p><?php $translate->__('Flexible_txt'); ?></p>
					</div>
					<div class="col-md-4 Fully">
						<i class="fa fa-tablet"></i>
						<h4><?php $translate->__('Responsivo'); ?></h4>
						<p></p>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-white">
			<div class="container">
				<div class="row">
					<div class="col-md-12 wwa">
						<span name="about" ></span>
						<h3><?php $translate->__('Somos'); ?></h3>
						<h4><?php $translate->__('Somos_txt'); ?></h4>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row team">
					<div class="col-md-4 b1">
						<img class="img-responsive" src="images/globalmembers/administrador.png"/>
						<h4><?php $translate->__('Administrador'); ?></h4>
						<p><?php $translate->__('Administrador_txt'); ?></p>
						<ul>
							<li><a href="https://facebook.com/"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="https://pinterest.com"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="https://twitter.com"><i class="fa fa-twitter" ></i></a></li>
							<li><a href="https://accounts.google.com/Login?hl=ES"><i class="fa fa-google-plus-square"></i></a></li>
						</ul>
					</div>
					<div class="col-md-4">
						<img class="img-responsive" src="images/globalmembers/usuario.png"/>
						<h4><?php $translate->__('Vendedor'); ?></h4>
						<p><?php $translate->__('Vendedor_txt'); ?></p>
						<ul>
							<li><a href="https://facebook.com/"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="https://pinterest.com"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="https://twitter.com"><i class="fa fa-twitter" ></i></a></li>
							<li><a href="https://accounts.google.com/Login?hl=ES"><i class="fa fa-google-plus-square"></i></a></li>
						</ul>
					</div>
					<div class="col-md-4 b3">
						<img class="img-responsive" src="images/globalmembers/vendedor.png"/>
						<h4><?php $translate->__('Usuario'); ?></h4>
						<p><?php $translate->__('Usuario_txt'); ?></p>
						<ul>
							<li><a href="https://facebook.com/"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="https://pinterest.com"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="https://twitter.com"><i class="fa fa-twitter" ></i></a></li>
							<li><a href="https://accounts.google.com/Login?hl=ES"><i class="fa fa-google-plus-square"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12 hr1">
						<hr/>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-3 bar">
						<div class="progB chart" data-percent="64"  data-animate="3500">
							<div class="chart chart-content">
								<div class="percentage" data-percent="64">
								  <span class="percent">64</span>
								</div>
							</div>
						</div>
						<div class="textP">
							<h3>WordPress</h3>
							<p><?php $translate->__('Wordpress'); ?></p>
						</div>
					</div>
					<div class="col-md-3 bar">
						<div class="progB chart" data-percent="22"  data-animate="3500">
							<div class="chart chart-content">
								<div class="percentage" data-percent="22">
								  <span class="percent">22</span>
								</div>
							</div>
						</div>
						<div class="textP">
							<h3>HTML5</h3>
							<p><?php $translate->__('Html'); ?></p>
						</div>
					</div>
					<div class="col-md-3 bar ">
						<div class="progB chart" data-percent="84"  data-animate="3500">
							<div class="chart chart-content">
								<div class="percentage" data-percent="22">
								  <span class="percent">84</span>
								</div>
							</div>
						</div>
						<div class="textP">
							<h3>CSS3</h3>
							<p><?php $translate->__('Css3'); ?></p>
						</div>
					</div>
					<div class="col-md-3 bar ">
						<div class="progB chart" data-percent="45"  data-animate="3500">
							<div class="chart chart-content">
								<div class="percentage" data-percent="45">
								  <span class="percent">45</span>
								</div>
							</div>
						</div>
						<div class="textP">
							<h3>Woocommerce</h3>
							<p><?php $translate->__('Woo'); ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row aboutUs">
					<div class="col-md-12 ">
						<h3><?php $translate->__('Ventajas'); ?></h3>
					</div>
				</div>
			</div>
			<div style="position: relative;">
				<div class="container">
					<div class="row about">
						<div class="col-md-6">
							<div class="about1">
							<img class="pic1Ab" src="images/picAbout/aboutP1.png">
								<h3><?php $translate->__('Mejoras'); ?></h3>
								<p><?php $translate->__('Mejoras_txt'); ?></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about2">
							<img class="pic2Ab" src="images/picAbout/aboutP2.png">
								<h3><?php $translate->__('Precios'); ?></h3>
								<p><?php $translate->__('Precios_txt'); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="horL"></div>
				<div class="container">
					<div class="row about">
						<div class="col-md-6">
							<div class="about1">
							<img class="pic1Ab" src="images/picAbout/aboutP3.png">
								<h3><?php $translate->__('Actualizaciones'); ?></h3>
								<p><?php $translate->__('Actualizaciones_txt'); ?></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about2">
							<img class="pic2Ab" src="images/picAbout/aboutP4.png">
								<h3><?php $translate->__('Ganancias'); ?></h3>
								<p><?php $translate->__('Ganancias_txt'); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!--project start-->    
    <div id="project">
		<div class="line3">
			<div class="container">
				<div id="project1" ></div>
				<div class="row Ama">
					<div class="col-md-12">
					<span name="projects" id="projectss"></span>
					<h3><?php $translate->__('Aplicativos'); ?></h3>
					<p><?php $translate->__('Aplicativos_txt'); ?></p>
					</div>
				</div>
			</div>
		</div>          
    	<div class="bg-white">
    
	        <div class="container">
			
				<div class="row">
					<!-- filter_block -->
					<div id="options" class="col-md-12" style="text-align: center;">	
						<ul id="filter" class="option-set" data-option-key="filter">
							<li><a class="selected" href="#filter" data-option-value="*" class="current"><?php $translate->__('Todos'); ?></a></li>
							<li><a href="#filter" data-option-value=".restora">Restora</a></li>
							<li><a href="#filter" data-option-value=".medical">Medical</a></li>
							<li><a href="#filter" data-option-value=".notary">Notary</a></li>
							<li><a href="#filter" data-option-value=".constructor">Constructor</a></li>
						</ul>
					</div><!-- //filter_block -->

					<div class="portfolio_block columns3 pretty" data-animated="fadeIn">	
						<div class="element col-sm-4 gall restora">
							<a class="plS" href="images/apps/restora/captura1-1.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/restora/thumb-captura1-1.jpg" alt="pic1 Gallery"/>
							</a>
							<div class="view project_descr">
								<h3><a href="#"><?php $translate->__('Restora_1'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>215</li>
									<li><a class="heart" href="#"><i class="fa-heart-o"></i>14</a></li>
								</ul>
							</div>
						</div>
						<div class="element col-sm-4 gall restora">
							<a class="plS" href="images/apps/restora/captura-2.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/restora/thumb-restora2.jpg" alt="pic2 Gallery"/>
							</a>
							<div class="view project_descr center">
								<h3><a href="#"><?php $translate->__('Restora_2'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>369</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>86</a></li>
								</ul>
							</div>
						</div>
						<div class="element col-sm-4 gall restora">
							<a class="plS" href="images/apps/restora/captura-3.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/restora/thumb-captura-3.jpg" alt="pic3 Gallery"/>
							</a>
							<div class="view project_descr">
								<h3><a href="#"><?php $translate->__('Restora_3'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>400</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>124</a></li>
								</ul>
							</div>
						</div>
			
			
						
						<div class="element col-sm-4 gall constructor">
							<a class="plS" href="images/apps/constructor/CONSTRUCTOR1.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/constructor/CONSTRUCTOR.jpg" alt="pic1 Gallery"/>
							</a>
						  <div class="view project_descr">
						<h3><a href="#"><?php $translate->__('Constructor_1'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>480</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>95</a></li>
								</ul>
							</div>
						</div>
						<div class="element col-sm-4 gall constructor">
							<a class="plS" href="images/apps/constructor/ControldeObra1.jpg" rel="prettyPhoto[gallery2]">
								<img src="images/apps/constructor/control-de-obra.jpg" alt="pic1 Gallery" width="357" height="285" class="img-responsive picsGall"/>
							</a>
<div class="view project_descr center">
								<h3><a href="#"><?php $translate->__('Constructor_2'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>215</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>14</a></li>
								</ul>
							</div>
						</div>
						<div class="element col-sm-4 gall medical">
							<a class="plS" href="images/apps/medical/medical2.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/medical/medical.jpg" alt="pic1 Gallery"/>
							</a>
						  <div class="view project_descr">
						<h3><a href="#"><?php $translate->__('Medical_1'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>375</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>102</a></li>
								</ul>
							</div>
						</div>



						<div class="element col-sm-4 gall notary">
							<a class="plS" href="images/apps/notary/notaria-1.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/notary/thumb-notaria-1.jpg" alt="pic1 Gallery"/>
							</a>
							<div class="view project_descr">
								<h3><a href="#"><?php $translate->__('Medical_2'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>440</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>35</a></li>
								</ul>
							</div>
						</div>
						<div class="element col-sm-4  gall notary">
							<a class="plS" href="images/apps/notary/notaria-2.jpg" rel="prettyPhoto[gallery2]">
								<img class="img-responsive picsGall" src="images/apps/notary/thumb-notaria-2.jpg" alt="pic1 Gallery"/>
							</a>
							<div class="view project_descr">
								<h3><a href="#"><?php $translate->__('Notary_1'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>512</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>36</a></li>
								</ul>
							</div>
						</div>
						<div class="element col-sm-4 gall medical">
							<a class="plS" href="images/apps/medical/medical3.jpg" rel="prettyPhoto[gallery2]">
								<img src="images/apps/medical/medical1.jpg" alt="pic1 Gallery" width="364" height="282" class="img-responsive picsGall"/>
							</a>
						  <div class="view project_descr">
				<h3><a href="#"><?php $translate->__('Medical_3'); ?></a></h3>
								<ul>
									<li><i class="fa fa-eye"></i>693</li>
									<li><a  class="heart" href="#"><i class="fa-heart-o"></i>204</a></li>
								</ul>
							</div>
						</div>
					</div>


					<div class="col-md-12 cBtn  lb" style="text-align: center;">
						<ul class="load_more_cont">
							<li class="dowbload btn_load_more">
								<a href="javascript:void(0);">
									<i class="fa fa-arrow-down"></i><?php $translate->__('Cargar_proyectos'); ?>
								</a>
							</li>
							<li class="buy">
								<a href="#">
									<i class="fa fa-shopping-cart"></i><?php $translate->__('Comprar'); ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
				
				<script type="text/javascript">
					jQuery(window).load(function(){
						items_set = [
							{category : 'college', lika_count : '77', view_count : '234', src : 'images/apps/college/colegio.jpg', title : '<?php $translate->__('Colegios'); ?>', content : '' },
							{category : 'gyms', lika_count : '45', view_count : '100', src : 'images/apps/gyms/gym.jpg', title : '<?php $translate->__('Gimnasios'); ?>', content : '' },
							{category : 'publicidad', lika_count : '22', view_count : '140', src : 'images/apps/publicidad/wordpress2.jpg', title : '<?php $translate->__('Publicidad'); ?>', content : '' }
						];
						jQuery('.portfolio_block').portfolio_addon({
							type : 1, // 2-4 columns simple portfolio
							load_count : 3,
							items : items_set
						});
						$('#container').isotope({
						  animationOptions: {
							 duration: 900,
							 queue: false
						   }
						});
					});
				</script>
			</div>
		</div>
    </div>    
    
    <!--news start-->
    
    <div id="news">
    	<div class="line4">		
			<div class="container">
				<div class="row Ama">
					<div class="col-md-12">
						<h3><?php $translate->__('Novedades'); ?></h3>
						<p><?php $translate->__('Novedades_txt'); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-white">
			<div class="container">
				<div class="row news">
					<div class="col-md-6  text-left">
						<img class="img-responsive picsGall" src="images/picNews/constituir-empresa.jpg"/>
						<h3><a href="#"><?php $translate->__('Constituye'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Agosto 25, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Constituye_txt'); ?> <a class="readMore" href="http://www.crecemype.pe/portal/index.php/aprovecha-la-ley-mype/constituye-tu-empresa-en-72-horas-en-linea"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
					<div class="col-md-6 text-right">
						<img class="img-responsive picsGall" src="images/picNews/desestresarse-empresa.jpg"/>
						<h3><a href="#"><?php $translate->__('Negocios'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Agosto 26, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Negocios_txt'); ?><a class="readMore" href="http://mba.americaeconomia.com/articulos/notas/6-pasos-para-administrar-su-negocio-sin-estresarse"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row news2 news">
					<div class="col-md-6 text-left">
						<img class="img-responsive picsGall" src="images/picNews/centro-odondologico.jpg"/>
						<h3><a href="#"><?php $translate->__('Consejos'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Agosto 29, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Consejos_txt'); ?><a class="readMore" href="http://www.costosenodontologia.com.ar/costosyaranceles/consejos_consultorio.html"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
					<div class="col-md-6 text-right">
						<img class="img-responsive picsGall" src="images/picNews/administrar-constructora.jpg"/>
						<h3><a href="#"><?php $translate->__('Iniciar_constructora'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Agosto 30, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Iniciar_constructora_txt'); ?><a class="readMore" href="http://www.emprendices.co/como-iniciar-una-empresa-constructora-o-de-construccion-con-exito/"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row news2 news">
					<div class="col-md-6 text-left">
						<img class="img-responsive picsGall" src="images/picNews/administrar-notarios.jpg"/>
						<h3 ><a href="#"><?php $translate->__('Notarios'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Agosto 30, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Notarios_txt'); ?><a class="readMore" href="http://juridirectorio.com/funciones-de-un-notario-publico/"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
					<div class="col-md-6 text-right">
						<img class="img-responsive picsGall" src="images/picNews/administrar-gimnasio.jpg"/>
						<h3><a href="#"><?php $translate->__('Gimnasios_como'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Septiembre 01, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Gimnasios_como_txt'); ?><a class="readMore" href="http://www.ehowenespanol.com/administrar-gimnasio-como_456945/"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
				</div>
			</div>
			<div class="container hideObj2" style="display:none;">
				<div class="row news2 news">
					<div class="col-md-6 text-right">
						<img class="img-responsive picsGall" src="images/picNews/ejecutivo-educativo.jpg"/>
						<h3><a href="#"><?php $translate->__('Educativa'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Septiembre 02, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Educativa_txt'); ?><a class="readMore" href="http://www.monografias.com/trabajos26/gerencia-educativa/gerencia-educativa.shtml"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
					<div class="col-md-6 text-left">
						<img class="img-responsive picsGall" src="images/picNews/Marketing-Digital.jpg"/>
						<h3 ><a href="#"><?php $translate->__('Pyme'); ?></a></h3>
						<ul>
							<li><i class="fa fa-calendar"></i>Septiembre 02, 2014</li>
							<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
							<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
						</ul>
						<p><?php $translate->__('Pyme_txt'); ?><a class="readMore" href="http://www.smartupmarketing.com/como-hacer-publicidad-efectiva-para-tu-pyme/"><?php $translate->__('Leer_mas'); ?><i class="fa fa-angle-right"></i></a></p>
						<hr class="hrNews"/>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row cBtn">
					<div class="col-md-12" style="text-align: center; margin-bottom: -90px; z-index: 10;">
						<ul class="mNews">
							<li class="dowbload bhide2"><a href="#"><i class="fa fa-arrow-down"></i><?php $translate->__('Cargar_novedades'); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>
    
    
    <!--contact start-->
    
	<div id="contact">
    	<div class="line5">					
			<div class="container">
				<div class="row Ama">
					<div class="col-md-12">
						<h3><?php $translate->__('Pregunta'); ?></h3>
						<p><?php $translate->__('Pregunta_txt'); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-white">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-xs-12 forma">
						<form action="formulario.php" method="post" id="forma1">
							<input type="text" class="col-md-6 col-xs-12 name" name='nombre' placeholder='<?php $translate->__('Nombre'); ?>'/>
							<input type="text" class="col-md-6 col-xs-12 Email" name='correo' placeholder='<?php $translate->__('Email'); ?>'/>
							<input type="text" class="col-md-12 col-xs-12 Subject" name='asunto' placeholder='<?php $translate->__('Asunto'); ?>'/>
							<textarea type="text" class="col-md-12 col-xs-12 Message" name='contenido' placeholder='<?php $translate->__('Mensaje'); ?>'></textarea>
							<div class="cBtn col-xs-12">
								<ul>
									<li class="clear"><a href="#"><i class="fa fa-times"></i><?php $translate->__('Limpiar'); ?></a></li>
									<li class="send"><a href="#"><i class="fa fa-share"></i><?php $translate->__('Enviar'); ?></a></li>
								</ul>
							</div>
						</form>
					</div>
					<div class="col-md-3 col-xs-12 cont">
						<ul>
							<li><i class="fa fa-home"></i>Avenida Golf Los Incas 26b Santiago de Surco - Lima</li>
							<li><i class="fa fa-phone"></i>+51 14355287, +51 13387214</li>
							<li><a href="#"><i class="fa fa-envelope"></i>info@globalmembers.net</a></li>
							<li><i class="fa fa-skype"></i>Globalmembers</li>
							<li><a href="http://www.twitter.com/"><i class="fa fa-twitter"></i>Twitter</a></li>
							<li><a href="http://www.facebook.com/"><i class="fa fa-facebook-square"></i>Facebook</a></li>
							<li><a href="https://dribbble.com/"><i class="fa fa-dribbble"></i>Dribbble</a></li>
							<li><a href="https://www.flickr.com/"><i class="fa fa-flickr"></i>Flickr</a></li>
							<li><a href="http://www.youtube.com/"><i class="fa fa-youtube-play"></i>YouTube</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="line6">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3901.3525425835187!2d-76.96696399999999!3d-12.0880004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c7abdf9d4da7%3A0xb2a2897357363c20!2sEl+Golf+Los+Incas%2C+Santiago+de+Surco+15023!5e0!3m2!1sen!2spe!4v1411441028053" width="100%" height="750" frameborder="0" style="border:0"></iframe>			
		</div>
		<div class="bg-white">
			<div class="container">
				<div class="row ftext">
					<div class="col-md-12">
						<a id="features"></a>
						<h3><?php $translate->__('Preocupacion'); ?></h3>
					</div>
					<div class="cBtn">
						<ul style="margin-top: 23px; margin-bottom: 0px; padding-left: 26px;">
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="line7">
			<div class="container">
				<div class="row footer">
					<div class="col-md-12">
						<h3><?php $translate->__('Suscripcion'); ?></h3>
						<p><?php $translate->__('Suscripcion_txt'); ?></p>
						<div class="fr">
							<div style="display: inline-block;">
								<input class="col-md-6 fEmail" name='Email' placeholder='<?php $translate->__('Correo'); ?>'/>
								<a href="#" class="subS"><?php $translate->__('Suscripcion_bot'); ?></a>
							</div>
						</div>
					</div>
					<div class="soc col-md-12">
						<ul id="lista-social">
							<li class="soc1"><a href="https://www.linkedin.com/" target="_blank"></a></li>
							<li class="soc2"><a href="http://www.facebook.com/" target="_blank"></a></li>
							<li class="soc3"><a href="http://www.skype.com/" target="_blank"></a></li>
							<li class="soc4"><a href="https://www.pinterest.com/" target="_blank"></a></li>
							<li class="soc5"><a href="http://www.twitter.com/" target="_blank"></a></li>
							<li class="soc6"><a href="http://www.youtube.com/" target="_blank"></a></li>
							<li class="soc7"><a href="https://accounts.google.com/Login?hl=ES" target="_blank"></a></li>
							<li class="soc8"><a href="https://dribbble.com/" target="_blank"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="background-bottom-line">
			
		</div>
		<div class="lineBlack">
			<div class="container">
				<div class="row downLine">
					<div class="col-md-12 text-right">
						<!--input  id="searchPattern" type="search" name="pattern" value="Search the Site" onblur="if(this.value=='') {this.value='Search the Site'; }" onfocus="if(this.value =='Search the Site' ) this.value='';this.style.fontStyle='normal';" style="font-style: normal;"/-->
						<input  id="searchPattern" type="search" placeholder="Search the Site"/><i class="glyphicon glyphicon-search" style="font-size: 13px; color:#a5a5a5;" id="iS"></i>
					</div>
					<div class="col-md-6 text-left copy">
						<p>Copyright &copy; 2014</p>
					</div>
					<div class="col-md-6 text-right dm">
						<ul id="downMenu">
							<li class="active"><a href="#home"><?php $translate->__('Inicio'); ?></a></li>
							<li><a href="#about"><?php $translate->__('Nosotros'); ?></a></li>
							<li><a href="#project1"><?php $translate->__('Proyectos'); ?></a></li>
							<li><a href="#news"><?php $translate->__('Novedades'); ?></a></li>
							<li class="last"><a href="#contact"><?php $translate->__('Contactenos'); ?></a></li>
							<!--li><a href="#features">Features</a></li-->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
		
		
	<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.js"></script>
	<script src="js/unslider.js"></script>
	<script type="text/javascript">
		

		$(document).ready(function(){
			$('#menu').slicknav();
			
			$('.banner').unslider({
				fluid: true,
				dots: true,
				speed: 500
			});

			$('#lista-social').on('click', 'li', function(event) {
				$aLink = $(this).find('a');
				window.open($aLink.attr('href'), '_blank');
				return false;
			});

			$(".bhide").click(function(){
				$(".hideObj").slideDown();
				$(this).hide(); //.attr()
				return false;
			});
			$(".bhide2").click(function(){
				$(".container.hideObj2").slideDown();
				$(this).hide(); // .attr()
				return false;
			});
			
			$('.heart').mouseover(function(){
				$(this).find('i').removeClass('fa-heart-o').addClass('fa-heart');
			}).mouseout(function(){
				$(this).find('i').removeClass('fa-heart').addClass('fa-heart-o');
			});
			
			setTimeout(function(){
				$('#counter').text('0');
				$('#counter1').text('0');
				$('#counter2').text('0');
				setInterval(function(){
					
					var curval=parseInt($('#counter').text());
					var curval1=parseInt($('#counter1').text().replace(' ',''));
					var curval2=parseInt($('#counter2').text());
					if(curval<=10){
						$('#counter').text(curval+1);
					}
					if(curval1<=1350){
						$('#counter1').text(sdf_FTS((curval1+10),0,' '));
					}
					if(curval2<=45){
						$('#counter2').text(curval2+1);
					}
				}, 2);
				
			}, 500);

			var $menu = $("#menuF");
	            
	        $(window).scroll(function(){
	            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
	                $menu.fadeOut('fast',function(){
	                    $(this).removeClass("default")
	                           .addClass("fixed transbg")
	                           .fadeIn('fast');
	                });
	            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
	                $menu.fadeOut('fast',function(){
	                    $(this).removeClass("fixed transbg")
	                           .addClass("default")
	                           .fadeIn('fast');
	                });
	            }
	        });

			/*calculateScroll();
			$(window).scroll(function(event) {
				calculateScroll();
				if ($(this).scrollTop() > 100){
					$('.logo img').css({
						'width': '48px',
						'height': '48px'
					});
				}
				else {
					$('.logo img').css({
						'width': '101px',
						'height': '101px'
					});
				}
			});
			$('.navmenu ul li a').click(function() {  
				$('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 800);
				return false;
			});*/

			$(".pretty a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true, social_tools: ''});
		});

		function EnvioEmail () {
			$.ajax({
	            type: "POST",
	            url: 'formulario.php',
	            cache: false,
	            data: $('#forma1').serialize(),
	            success: function(data){
	                datos = eval( "(" + data + ")" );
	                if (Number(datos.rpta) > 0){
	                    MessageBox('Datos guardados', 'La operación se completó correctamente.', "[Aceptar]", function () {
	                        $('#hdPage').val('1');
	                        $('#hdPageActual').val('1');
	                        limpiarSeleccionados();
	                        BuscarDatos('1');
	                        clearImagenForm();
	                        resetForm('form1');
	                        BackToList();
	                        $('#tableReceta tbody').html('<tr><td colspan="4"><h3>No se encontraron registros</h3></td></tr>');
	                    });
	                }
	            }
	        });
		}

		function sdf_FTS(_number,_decimal,_separator) {
			var decimal=(typeof(_decimal)!='undefined')?_decimal:2;
			var separator=(typeof(_separator)!='undefined')?_separator:'';
			var r=parseFloat(_number)
			var exp10=Math.pow(10,decimal);
			r=Math.round(r*exp10)/exp10;
			rr=Number(r).toFixed(decimal).toString().split('.');
			b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);
			r=(rr[1]?b+'.'+rr[1]:b);

			return r;
		}

		/*menu*/
		function calculateScroll() {
			var contentTop      =   [];
			var contentBottom   =   [];
			var winTop      =   $(window).scrollTop();
			var rangeTop    =   200;
			var rangeBottom =   500;
			$('.navmenu').find('a').each(function(){
				contentTop.push( $( $(this).attr('href') ).offset().top );
				contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
			})
			$.each( contentTop, function(i){
				if ( winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom ){
					$('.navmenu li')
					.removeClass('active')
					.eq(i).addClass('active');
				}
			});
		}
	</script>
</body>
</html>