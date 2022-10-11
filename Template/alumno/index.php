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
	//Obtengo la localizacion y guardo en cookies
	if(!isset($_COOKIE["pais"])){
		$geo = geoLocalizacion();
		setcookie("pais", $geo, time() + ( 365 * 24 * 60 * 60)); //1 año
	}else if(isset($_COOKIE["pais"])){
        $pais = $_COOKIE["pais"];
    }else{
        $pais = "Argentina";
    }	
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
}

//$resultado = $conectado->query("SELECT * FROM cursos WHERE id_curso = 1");
//$empresas = $resultado->fetch_all(MYSQLI_ASSOC);
//$cantidad = mysqli_num_rows($cursos);
//echo $cantidad;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vinero - Very Clean and Minimal Portfolio Website Template</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <!-- FONTS -->
    <link rel="stylesheet" href="../../assets/fonts/fontawesome/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/fonts/iconsmind/iconsmind.css">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="../../assets/css/plugins.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <div class="vlt-site-holder animsition vlt-footer-fixed">
        <div class="vlt-content-holder">
            <header class="vlt-header-holder vlt-header-fixed" data-header-fixed="1">
                <div class="container">
                    <div class="vlt-header-inner">
                        <div class="vlt-header-left">
                            <a href="index.html" class="vlt-site-logo">
                                <img src="../../assets/img/logo.png" alt="Vinero" style="max-height: 13px">
                            </a>
                        </div>
                        <div class="vlt-header-right">
                            <div class="vlt-menu-toggle vlt-fullscreen-menu-toggle" data-before-text="Menu">
                                <span class="line line-one"><span class="inner"></span></span>
                                <span class="line line-two"><span class="inner"></span></span>
                                <span class="line line-three"><span class="inner"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- /.vlt-header-holder vlt-header-fixed -->
            <div class="vlt-navigation-fullscreen-holder">
                <div class="vlt-navigation-fullscreen">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="../../index.php">Comprar Cursos</a></li>
                        <li><a href="index.php">Mis Cursos</a></li>
                        <li><a href="../cerrar.php">Cerrar Sesion</a></li>
                    </ul>
                    <div class="vlt-navigation-socials">
                        <ul>
                            <li><a href="#" class="tooltip" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#" class="tooltip" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#" class="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="tooltip" title="YouTube"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <!-- /.vlt-navigation-socials -->
                </div>
            </div>
            <!-- /.vlt-navigation-fullscreen-holder -->
            <div class="vlt-hero-title-holder jarallax" style="background-image: url('assets/img/index.png');">
                <div class="vlt-hero-title-inner">
                    <h1 class="vlt-hero-title">Conteniluz</h1>
                    <p class="vlt-hero-subtitle">Work hard. Dream big.</p>
                </div>
            </div>
            <!-- /.vlt-hero-title-holder -->
            <main class="vlt-main-holder vlt-main-padding">
                <div class="container">
                    <div class="vlt-portfolio-grid cubeportfolio" id="cubeportfolio">
                        <?php foreach ($cursos as $curso) { ?>
                        <article
                            class="cbp-item vlt-portfolio-grid-item vlt-portfolio-style2">
                            <div class="vlt-portfolio-grid-image">
                                <a class="vlt-portfolio-grid-link"
                                    href="clases.php?id_curso=<?php echo $curso["id"] ?>">
                                    <img src="../../uploads/cursos/<?php echo $curso["miniatura"]; ?>" alt="">
                                </a>
                            </div>
                            <div class="vlt-portfolio-grid-content">
                                <h5 class="vlt-portfolio-grid-title"><?php echo $curso["titulo_curso"] ?></h5>
                            </div>
                            <!--<nav class="" data-max-pages="1" style="display:flex; justify-content: center; margin-top:5px;">
									<a href="clases.php?id_curso=<?php //echo $curso["id"] ?>" class="vlt-btn vlt-btn-primary">Ver Ahora</a>
								</nav>-->
                            <div class="" data-max-pages="1"
                                style="display:flex; justify-content: center; margin-top:5px;">
                                <?php
										if(isset($array[$i]) AND $array[$i] == $curso["id"] AND isset($arrayPagos) AND $arrayPagos[$i] == 'Y'){
											$concatenar = '<a href="clases.php?id_curso='.$curso["id"].'"'.' class="vlt-btn vlt-btn-primary">Ver Ahora</a>';
											echo $concatenar;
											$i= $i + 1;
										}else{
											
											if($pais == PAIS){
												//$concatenar = '<a href="../../MercadoPago/index.php?id_empresa='.$curso["id_empresa"].'&id_curso='.$curso["id"].'&titulo='.$curso["titulo_curso"].'&pecio='.$curso["pesos"].'"'.'class="vlt-btn vlt-btn-primary">$'. $curso["pesos"].'- Comprar</a>';
												//echo $concatenar;
												$moneda = 'pesos';
												$concatenar = '<a href="../../MercadoPago/index.php?id_empresa='.$curso["id_empresa"].'&id_curso='.$curso["id"].'&titulo='.$curso["titulo_curso"].'&precio='.$curso["pesos"].'&moneda='.$moneda.'"'.'class="vlt-btn vlt-btn-primary">$'. $curso["pesos"].'- Comprar</a>';
												echo $concatenar;
											}else{
												$moneda = 'dolares';
												$concatenar = '<a href="../../MercadoPago/index.php?id_empresa='.$curso["id_empresa"].'&id_curso='.$curso["id"].'&titulo='.$curso["titulo_curso"].'&precio='.$curso["dolares"].'&moneda='.$moneda.'"'.'class="vlt-btn vlt-btn-primary">$'. $curso["dolares"].'- Comprar</a>';
												echo $concatenar;
											}											
										}
									?>
                            </div>
                        </article>
                        <?php } ?>
                    </div>
                </div>
            </main>
            <!-- /.vlt-main-holder vlt-main-padding -->
        </div>
        <!-- /.vlt-content-holder -->
        <footer class="vlt-footer-holder vlt-footer-minimal" data-footer-fixed="1">
            <div class="vlt-footer-inner">
                <div class="container">
                    <div class="text-center">
                        <a href="index.html" class="vlt-site-logo">
                            <img src="../assets/img/logo.png" alt="Vinero" style="max-height: 13px">
                        </a>
                        <div class="vlt-footer-menu">
                            <div>
                                <ul>
                                    <li>
                                        <a href="#">Works</a>
                                    </li>
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li>
                                        <a href="#">Purchase</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="vlt-footer-copyright">
                            <p>Copyright © 2017 Vinero. Powered by <a href="#" class="vlt-link reverse">VLThemes</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.vlt-footer-holder -->
    </div>
    <!-- /.vlt-site-holder -->
    <a href="#" class="vlt-back-to-top hidden"><i class="fa fa-angle-up"></i></a>
    <!-- /.vlt-back-to-top -->
</body>
<!-- SCRIPTS -->
<script src="../../assets/vendors/jquery.min.js"></script>
<script src="../../assets/scripts/plugins.min.js"></script>
<script type="text/javascript">
jQuery.noConflict()(function($) {
    var gridContainer = $('#cubeportfolio');
    gridContainer.imagesLoaded(function() {
        gridContainer.cubeportfolio({
            defaultFilter: '*',
            filters: '.vlt-portfolio-grid-filters',
            animationType: 'fadeOut',
            layoutMode: 'grid', //mosaic
            sortToPreventGaps: true,
            gapHorizontal: 30,
            gapVertical: 30,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1170,
                cols: 3,
            }, {
                width: 991,
                cols: 3,
            }, {
                width: 767,
                cols: 2,
            }, {
                width: 575,
                cols: 1,
            }],
            displayType: 'default',
            displayTypeSpeed: 150,
        });
    });
});
</script>
<script src="../../assets/scripts/script.js"></script>

</html>