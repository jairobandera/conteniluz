<?php
session_start();
unset($_SESSION['id_empresa']);
include 'config.php';
$conectado = conectar();
$resultado = $conectado->query("SELECT * FROM empresa");
$empresas = $resultado->fetch_all(MYSQLI_ASSOC);
//$cantidad = mysqli_num_rows($cursos);
//echo $cantidad;
/*if(!isset($_COOKIE["pais"])){
    $geo = geoLocalizacion();
    setcookie("pais", $geo, time() + ( 365 * 24 * 60 * 60)); //1 año
}*/

//Compraboar si existe pais en localstorage
$pais =  "<script>
    if(localStorage.getItem('pais')){
      console.log(localStorage.getItem('pais'));
    }
</script>";

/*if(!isset($_COOKIE["pais"])){
    //llamo a la funcion setCookiePais de js y la guardo en $pais
   echo "<script>setCookiePais();</script>";    
   
}else{
    echo "<script>setCookiePais();</script>";
}*/

?>
  
<!DOCTYPE html>
<html lang="en">
 	<head>
		<title>Haswell - Responsive HTML5 Template</title>
		<meta charset="utf-8">
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
		<meta name="robots" content="index, follow" > 
		<meta name="keywords" content="HTML5 Template" > 
		<meta name="description" content="Haswell - Responsive HTML5 Template" > 
		<meta name="author" content="ABCgomel">

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!-- FAVICONS -->
    <link rel="shortcut icon" href="assetsNuevo/images/favicon/favicon.png">
    <link rel="apple-touch-icon" href="assetsNuevo/images/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assetsNuevo/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assetsNuevo/images/favicon/apple-touch-icon-114x114.png">
		
<!-- CSS -->
    <!-- REVOSLIDER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="assetsNuevo/rs-plugin/css/settings.min.css" media="screen">

    <!--  BOOTSTRAP -->
		<link rel="stylesheet" href="assetsNuevo/css/bootstrap.min.css"> 
	
    <!--  GOOGLE FONT -->		
		<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700%7COpen+Sans:400,300,700' rel='stylesheet' type='text/css'>
  
    <!-- ICONS ELEGANT FONT & FONT AWESOME & LINEA ICONS  -->		
		<link rel="stylesheet" href="assetsNuevo/css/icons-fonts.css" >	
	
    <!--  CSS THEME -->		
		<link rel="stylesheet" href="assetsNuevo/css/style.css" >

    <!-- ANIMATE -->	
		<link rel='stylesheet' href="assetsNuevo/css/animate.min.css">	
	
<!-- CSS end -->
		
	</head>
	<body>
	
		<!-- LOADER -->	
		<div id="loader-overflow">
      <div id="loader3">Please enable JS</div>
    </div>	

		<div id="wrap" class="boxed ">
			<div class="grey-bg"> <!-- Grey BG  -->				
				<!-- HEADER 1 BLACK MOBILE-NO-TRANSPARENT -->
				<header id="nav" class="header header-1 black-header mobile-no-transparent">
          
				  <div class="header-wrapper">
					<div class="container-m-30 clearfix">
					  <div class="logo-row">
					  
						<!-- LOGO --> 
						<div class="logo-container-2">
                <div class="logo-2">
                  <a href="index.php" class="clearfix">
                    <img src="assetsNuevo/logo.gif" class="logo-img" width="" alt="Logo">
                  </a>
                </div>
            </div>
						<!-- BUTTON --> 
						<div class="menu-btn-respons-container">
							<button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#main-menu .navbar-collapse">
								<span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
							</button>
						</div>
					 </div>
					</div>

					<!-- MAIN MENU CONTAINER -->
					<div class="main-menu-container" style="background:white;">
						
						  <div class="container-m-30 clearfix">	
						  
								<!-- MAIN MENU -->
								<div id="main-menu">
								  <div class="navbar navbar-default" role="navigation">

									<!-- MAIN MENU LIST -->
									<nav class="collapse collapsing navbar-collapse right-1024">
									  <ul class="nav navbar-nav">									  
                      <li class="parent">
                        <a href="#"><div class="main-menu-title" style="font-size:20px; color:black; margin-right:-5em;">Inicio</div></a>                 
									  </ul>
                    <ul class="nav navbar-nav">									  
                      <li class="parent">
                        <a href="Template/login.php"><div class="main-menu-title" style="font-size:20px; color:black; margin-right:-3em;">Campus</div></a>                 
									  </ul>
                    <ul class="nav navbar-nav">									  
                      <li class="parent">
                        <a href="#"><div class="main-menu-title" style="font-size:20px; color:black; ">Sobre Nosotros</div></a>                 
									  </ul>						  
									</nav>

								  </div>
								</div>
								<!-- END main-menu -->
								
						  </div>
						  <!-- END container-m-30 -->
						
					</div>
					<!-- END main-menu-container -->					
				  </div>
				  <!-- END header-wrapper -->
				  
				</header>
				
				<!-- REVO SLIDER FULLSCREEN 1 -->
				<div class="relative">
					<div class="rs-fullscr-container">
						
						<div id="rs-fullwidth" class="tp-banner dark-bg" >
							<ul>	
								<!-- SLIDE 1 -->
								<li data-transition="zoomout" data-slotamount="1" data-masterspeed="1000" data-thumb="images/revo-slider/video-ocean-cover-320x200.jpg"  data-fstransition="fade" data-fsmasterspeed="1000" data-fsslotamount="7" data-saveperformance="off"  data-title="INTRO SLIDE">
                
									<!-- MAIN IMAGE -->
									<!--<img src="images/revo-slider/video-ocean-cover.jpg"  alt="video_woman_cover3"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">-->
									
									<!-- LAYERS -->
                  	<!-- LAYER NR.0 1 VIDEO -->
                    <div class="tp-caption tp-fade fadeout fullscreenvideo"
                     data-speed="1000"
                     data-start="1100"
                     data-easing="Power4.easeOut"
                     data-elementdelay="0.01"
                     data-endelementdelay="0.1"
                     data-endspeed="1500"
                     data-endeasing="Power4.easeIn"
                     data-autoplay="true"
                     data-autoplayonlyfirsttime="false"
                     data-nextslideatend="true"
                     data-volume="mute"
                     data-forceCover="1"
                     data-dottedoverlay="twoxtwo"
                     data-aspectratio="16:9"
                     data-forcerewind="on"
                     style="z-index: 2;"><video preload="none" loop width="100%" height="100%" 
                    poster="images/revo-slider/video-ocean-cover.jpg">
                    <source src='assetsNuevo/portada.mp4' type='video/mp4' />
                    </video>
                    </div>                    
								</li>
							</ul>					
						</div>						
					</div>						
				</div>
        
        <!-- PORTFOLIO SECTION 2 -->
        <div class="page-section">
          <div class="relative">
          
            <!-- ITEMS GRID -->
            <ul class="port-grid port-grid-3 port-grid-gut clearfix" id="items-grid" style="margin-top:18px;">
              
              <!-- Item 1 -->
              <?php
      				  foreach ($empresas as $empresa) { ?>
                <li class="port-item mix">
                  <a href="Template/cursos.php?id_empresa=<?php echo $empresa["id"]; ?>">
                    <div class="port-img-overlay"><img class="port-main-img" src="uploads/empresas/<?php echo $empresa["miniatura"]; ?>" alt="img" ></div>
                  </a>
                  <div class="port-overlay-cont">
                      <div class="port-title-cont" style="text-align:center; margin-top:8rem">
                        <h3 style="font-size:30px; margin-bottom:5px;"><a href="Template/cursos.php?id_empresa=<?php echo $empresa["id"] ?>"><?php echo $empresa["nombre_empresa"]; ?></a></h3>
                        <span><a style="font-size:15px;" href="Template/cursos.php?id_empresa=<?php echo $empresa["id"] ?>">Ver Curso</a></span>
                      </div>
                  </div>
                </li>  
              <?php } ?>           
            </ul>          
          </div>
        </div> 
        
        <!-- FOOTER 2 BLACK -->
        <footer class="page-section pt-80 pb-50 footer2-black">
          <div class="container">            
            <div class="footer-2-copy-cont clearfix">
              <!-- Social Links -->
              <div class="footer-2-soc-a right">
                <a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="#" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="#" title="Behance" target="_blank"><i class="fa fa-behance"></i></a>
                <a href="#" title="LinkedIn+" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="#" title="Dribbble" target="_blank"><i class="fa fa-dribbble"></i></a>
              </div>             
              <!-- Copyright -->
              <div class="left">
                <a class="footer-2-copy" href="#" target="_blank">&copy; HASWELL 2020</a>
              </div>           

            </div>
                    
          </div>
        </footer>
        
				<!-- BACK TO TOP -->
				<p id="back-top">
          <a href="#top" title="Back to Top"><span class="icon icon-arrows-up"></span></a>
        </p>
        
			</div><!-- End BG -->	
		</div><!-- End wrap -->	
			
<!-- JS begin -->

		<!-- jQuery  -->
		<script src="assetsNuevo/js/jquery-1.11.2.min.js"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assetsNuevo/js/bootstrap.min.js"></script>		

		<!-- MAGNIFIC POPUP -->
		<script src='assetsNuevo/js/jquery.magnific-popup.min.js'></script>
    
    <!-- PORTFOLIO SCRIPTS -->
    <script src="assetsNuevo/js/isotope.pkgd.min.js"></script>
    <script src="assetsNuevo/js/imagesloaded.pkgd.min.js"></script>
    <script src="assetsNuevo/js/masonry.pkgd.min.js"></script>
    
    <!-- COUNTER -->
    <script src="assetsNuevo/js/jquery.countTo.js"></script>
    
    <!-- APPEAR -->    
    <script src="assetsNuevo/js/jquery.appear.js"></script>
    
    <!-- OWL CAROUSEL -->    
    <script src="assetsNuevo/js/owl.carousel.min.js"></script>
    
    <!-- MAIN SCRIPT -->
		<script src="assetsNuevo/js/main.js"></script>
		
		<!-- REVOSLIDER SCRIPTS  -->
			<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
			<script src="assetsNuevo/rs-plugin/js/jquery.themepunch.tools.min.js"></script>   
			<script src="assetsNuevo/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
      
      <!-- SLIDER REVOLUTION INIT  -->
			<script>
        jQuery(document).ready(function() {

           jQuery('#rs-fullwidth').revolution(
            {
              dottedOverlay:"none",
              delay:16000,
              startwidth:1170,
              startheight:700,
              hideThumbs:200,
              
              thumbWidth:100,
              thumbHeight:50,
              thumbAmount:5,
              
              //fullScreenAlignForce: "off",
              
              navigationType:"none",
              navigationArrows:"solo",
              navigationStyle:"preview4",
              
              hideTimerBar:"on",
              
              touchenabled:"on",
              onHoverStop:"on",
              
              swipe_velocity: 0.7,
              swipe_min_touches: 1,
              swipe_max_touches: 1,
              drag_block_vertical: false,
                          
              parallax:"scroll",
              parallaxBgFreeze:"on",
              parallaxLevels:[45,40,35,50],
              parallaxDisableOnMobile:"on",
                          
              keyboardNavigation:"off",
              
              navigationHAlign:"center",
              navigationVAlign:"bottom",
              navigationHOffset:0,
              navigationVOffset:20,

              soloArrowLeftHalign:"left",
              soloArrowLeftValign:"center",
              soloArrowLeftHOffset:20,
              soloArrowLeftVOffset:0,

              soloArrowRightHalign:"right",
              soloArrowRightValign:"center",
              soloArrowRightHOffset:20,
              soloArrowRightVOffset:0,
                  
              shadow:0,
              fullWidth:"on",
              fullScreen:"off",

              spinner:"spinner4",
              
              stopLoop:"off",
              stopAfterLoops:-1,
              stopAtSlide:-1,

              shuffle:"off",
              
              autoHeight:"off",						
              forceFullWidth:"off",						
                          
              hideThumbsOnMobile:"off",
              hideNavDelayOnMobile:1500,						
              hideBulletsOnMobile:"off",
              hideArrowsOnMobile:"off",
              hideThumbsUnderResolution:0,
              
              hideSliderAtLimit:0,
              hideCaptionAtLimit:0,
              hideAllCaptionAtLilmit:0,
              startWithSlide:0,
              //fullScreenOffsetContainer: ""	
            });
            
        });	//ready    

			</script>

<!-- JS end -->	
	
	</body>
</html>		