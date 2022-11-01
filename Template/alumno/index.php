<?php
session_start();
include '../../config.php';
$conectado = conectar();

if(isset($_SESSION['id_usuario'])){
	//$id_curso = $_GET['id_curso'];
	$resultado = $conectado->query("SELECT * FROM cursos AS c WHERE EXISTS(
	SELECT * FROM alumno AS a, usuario AS u WHERE a.id_usuario = u.id 
	AND a.id_curso = c.id AND u.id = ".$_SESSION['id_usuario']." AND u.tipo = 'USUARIO')");
	$cursos = $resultado->fetch_all(MYSQLI_ASSOC);
}
$i = 0;	

if(isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'USUARIO'){
	$id_usuario = $_SESSION['id_usuario'];
	/*$resultado = $conectado->query("SELECT c.id FROM cursos AS c WHERE EXISTS(
	SELECT * FROM alumno AS a, usuario AS u WHERE a.id_curso = c.id AND u.id = $id_usuario AND u.tipo = 'USUARIO')");*/
	$resultado = $conectado->query("SELECT c.id, a.pago FROM cursos AS c, alumno AS a
	WHERE a.id_curso = c.id AND a.id_usuario = $id_usuario");
	$cursos2 = $resultado->fetch_all(MYSQLI_ASSOC);
	//$resultado= $resultado->fetch_assoc();
	$array = array();
	$arrayPagos = array();
	if($cursos2){
			foreach($cursos2 as $curso2){
				$id_curso = $curso2['id'];
				$pago = $curso2['pago'];
				array_push($array, $id_curso);
				array_push($arrayPagos, $pago);
			}
		}
        //var_dump($array);
        //var_dump($arrayPagos);	
        //compruebo si existe la cookie pais
}
$pais =  "<script>
    if(localStorage.getItem('pais')){
      console.log(localStorage.getItem('pais'));
    }
</script>";
//$resultado = $conectado->query("SELECT * FROM cursos WHERE id_curso = 1");
//$empresas = $resultado->fetch_all(MYSQLI_ASSOC);
//$cantidad = mysqli_num_rows($cursos);
//echo $cantidad;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Haswell - Responsive HTML5 Template</title>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Haswell - Responsive HTML5 Template">
    <meta name="author" content="ABCgomel">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="../../assetsNuevo/images/favicon/favicon.png">
    <link rel="apple-touch-icon" href="../../assetsNuevo/images/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../../assetsNuevo/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../../assetsNuevo/images/favicon/apple-touch-icon-114x114.png">

    <!-- CSS -->
    <!-- REVOSLIDER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="../../assetsNuevo/rs-plugin/css/settings.min.css" media="screen">

    <!--  BOOTSTRAP -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!--  GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700%7COpen+Sans:400,300,700' rel='stylesheet'
        type='text/css'>

    <!-- ICONS ELEGANT FONT & FONT AWESOME & LINEA ICONS  -->
    <link rel="stylesheet" href="../../assetsNuevo/css/icons-fonts.css">

    <!--  CSS THEME -->
    <link rel="stylesheet" href="../../assetsNuevo/css/style.css">

    <!-- ANIMATE -->
    <link rel='stylesheet' href="../../assetsNuevo/css/animate.min.css">
    <script src="../../assetsNuevo/js/modernizr.js"></script> <!-- Modernizr -->

</head>

<body>

    <!-- LOADER -->
    <div id="loader-overflow">
        <div id="loader3">Please enable JS</div>
    </div>

    <div id="wrap" class="boxed ">
        <div class="grey-bg">
            <!-- HEADER side menu -->
            <header id="nav-stick2" class="header header-1 header-side-menu fixed white transparent">
                <div class="header-wrapper">
                    <div class="container-m-30 clearfix">
                        <div class="logo-row">

                            <!-- LOGO -->
                            <div class="logo-container-2">
                                <div class="logo-2">
                                    <a href="#" class="clearfix">
                                        <img src="https://2.bp.blogspot.com/-YiWi32Pbamo/W1djBdPn0uI/AAAAAAAATrM/BKuX5dAzIOQWpbL65ahXyC6YOfumUX7ZwCK4BGAYYCw/s1600/tulogoaquifooter.png" class="logo-img" alt="Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="menu-btn-respons-container2">
                        <a id="cd-menu-trigger" href="#"><span class="cd-menu-icon"></span></a>
                    </div>
                </div> <!-- END header-wrapper -->

            </header>

            <div class="sliding-content">

                <!-- STATIC MEDIA IMAGE -->
                <div id="index-link" class="sm-video-bg"
                    style="background-image: url(https://www.rdstation.com/blog/wp-content/uploads/sites/2/2017/09/thestocks.jpg); margin-bottom:10px; height:500px;">
                    <div class="container sm-content-cont js-height-fullscr">

                        <!-- VIDEO BG -->
                        <!-- If you want to change video - replace video files in folder "video" -->
                        <div class="sm-video-wrapper">
                            <div class="sm-video bg-img-alfa"></div>
                        </div>

                    </div>
                </div>
                <!-- DIVIDER -->
                <hr class="mt-0 mb-0">

                <!-- FEATURES -->
                <?php
        if($cursos){
      	foreach ($cursos as $curso) { ?>
                <div class="page-section">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6 wow fadeInLeft equal-height ">
                                <div class="fes2-main-text-cont">
                                    <div class="title-fs-45"><br>
                                        <span class="bold"><?php echo $curso["titulo_curso"] ?></span>
                                    </div>
                                    <div class="line-3-70"></div>
                                    <div class="fes2-text-cont">
                                        <?php
										if(isset($array[$i]) AND $array[$i] == $curso["id"] AND isset($arrayPagos) AND $arrayPagos[$i] == 'Y' AND $arrayPagos[$i] != 'N'){
											echo '<a href="alumno/index.php" class="btn btn-primary">Ver</a>';
											$i= $i + 1;
										}else if(!isset($_SESSION['id_usuario'])){
											if($pais == PAIS){
                                        echo '<form action="register.php" method="post" target="">
                                                <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                <input type="hidden" name="precio" value='.$curso['pesos'].'>
                                                <button type="submit" class="btn btn-success">$ '.$curso['pesos'].' - Comprar</button>
                                            </form>';
                                                                /*$concatenar = '<a href="register.php?id_empresa='.$id_empresa.'&id_curso='.$curso["id"].'&titulo='.$curso["titulo_curso"].'&precio='.$curso["pesos"].'"'.'class="vlt-btn vlt-btn-primary">$'. $curso["pesos"].'- Comprar</a>';
                                                                echo $concatenar;*/
                                        }else{
                                        echo '<form action="register.php" method="post" target="">
                                                <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                <button type="submit" class="btn btn-success">USD '.$curso['dolares'].' - Comprar</button>
                                            </form>';
                                        }
                                            $i = $i + 1;
                                        }elseif(isset($_SESSION['id_usuario'])){
                                            if($pais == PAIS){
                                        $moneda = 'pesos';
                                        echo '<form action="../MercadoPago/index.php" method="post" target="">
                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                <input type="hidden" name="precio" value='.$curso['pesos'].'>
                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                <button type="submit" class="btn btn-success">$ '.$curso['pesos'].' - Comprar</button>
                                            </form>';
										}else{
                                        $moneda = 'dolares';
                                        echo '<form action="../MercadoPago/index.php" method="post" target="">
                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                <button type="submit" class="btn btn-success">USD '.$curso['dolares'].' - Comprar</button>
                                            </form>';

                                        }
                                            $i = $i + 1;
                                        }
									?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="fes2-img equal-height"><img class="port-main-img"
                                            src="../../uploads/cursos/<?php echo $curso["miniatura"] ?>" alt="img"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php }} ?>
                <!-- FIN FEATURES -->

                <!-- DIVIDER -->
                <hr class="mt-0 mb-0">
                <!-- FOOTER 5 -->
                <footer id="footer5" class="page-section pt-80 pb-50">
                    <div class="container">
                        <div class="footer-2-copy-cont clearfix">
                            <!-- Social Links -->
                            <div class="footer-2-soc-a right">
                                <a href="https://1.envato.market/a1gQR" title="Facebook" target="_blank"><i
                                        class="fa fa-facebook"></i></a>
                                <a href="https://1.envato.market/a1gQR" title="Twitter" target="_blank"><i
                                        class="fa fa-twitter"></i></a>
                                <a href="https://1.envato.market/a1gQR" title="Behance" target="_blank"><i
                                        class="fa fa-behance"></i></a>
                                <a href="https://1.envato.market/a1gQR" title="LinkedIn+" target="_blank"><i
                                        class="fa fa-linkedin"></i></a>
                                <a href="https://dribbble.com/abcgomel" title="Dribbble" target="_blank"><i
                                        class="fa fa-dribbble"></i></a>
                            </div>

                            <!-- Copyright -->
                            <div class="left">
                                <a class="footer-2-copy" href="https://1.envato.market/a1gQR" target="_blank">&copy;
                                    HASWELL 2020</a>
                            </div>


                        </div>

                    </div>
                </footer>

            </div> <!-- sliding-content -->

            <!-- SIDE MENU -->
            <nav id="cd-lateral-nav">
                <ul class="cd-navigation cd-single-item-wrapper">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="../../index.php">Comprar Cursos</a></li>
                    <li><a href="index.php">Mis Cursos</a></li>
                    <li><a href="../cerrar.php">Cerrar Sesion</a></li>
                </ul> <!-- cd-single-item-wrapper -->
            </nav><!-- END side menu -->

            <!-- BACK TO TOP -->
            <p id="back-top">
                <a href="#top" title="Back to Top"><span class="icon icon-arrows-up"></span></a>
            </p>

        </div><!-- End BG -->
    </div><!-- End wrap -->

    <!-- JS begin -->

    <!-- jQuery  -->
    <script src="../../assetsNuevo/js/jquery-1.11.2.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../assetsNuevo/js/bootstrap.min.js"></script>

    <!-- MAGNIFIC POPUP -->
    <script src='../../assetsNuevo/js/jquery.magnific-popup.min.js'></script>

    <!-- PORTFOLIO SCRIPTS -->
    <script src="../../assetsNuevo/js/isotope.pkgd.min.js"></script>
    <script src="../../assetsNuevo/js/imagesloaded.pkgd.min.js"></script>
    <script src="../../assetsNuevo/js/masonry.pkgd.min.js"></script>

    <!-- COUNTER -->
    <script src="../../assetsNuevo/js/jquery.countTo.js"></script>

    <!-- APPEAR -->
    <script src="../../assetsNuevo/js/jquery.appear.js"></script>

    <!-- OWL CAROUSEL -->
    <script src="../../assetsNuevo/js/owl.carousel.min.js"></script>

    <!-- FLICKR WIDGET -->
    <script src="../../assetsNuevo/js/jflickrfeed.min.js"></script>

    <!-- JQUERY TWEETS -->
    <script src="../../assetsNuevo/js/twitter/jquery.tweet.js"></script>

    <!-- MAIN SCRIPT -->
    <script src="../../assetsNuevo/js/main.js"></script>

    <!-- SIDE MENU -->
    <script src="../../assetsNuevo/js/side-menu.js"></script>

    <!-- BACKGROUND VIDEO -->
    <script src="../../assetsNuevo/js/jquery.backgroundvideo.min.js"></script>
    <script>
    $(document).ready(function() {
        if (!($("html").hasClass("mobile"))) {
            var videobackground = new $.backgroundVideo($('.sm-video'), {
                "align": "centerXY",
                "width": 1920,
                "height": 1080,
                "path": "video/",
                "filename": "The-Crosswalk",
                "types": ["mp4", "webm"],
                "autoplay": true,
                "loop": true
            });
        }
    });
    </script>
    <!-- JS end -->

</body>

</html>