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

//Compraboar si existe cookie pais
/*if(!isset($_COOKIE["pais"])){
    //llamo a la funcion setCookiePais de js
    echo "setCookiePais();";
}*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vinero - Very Clean and Minimal Portfolio Website Template</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <!-- FONTS -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/iconsmind/iconsmind.css">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="vlt-site-holder animsition vlt-footer-fixed">
        <div class="vlt-content-holder">
            <header class="vlt-header-holder vlt-header-fixed" data-header-fixed="1">
                <div class="container">
                    <div class="vlt-header-inner">
                        <div class="vlt-header-left">
                            <a href="index.html" class="vlt-site-logo">
                                <img src="assets/img/logo.png" alt="Vinero" style="max-height: 23px">
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
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="Template/login.php">Campus</a></li>
                        <li><a href="contact.html">Sobre Nosotros</a></li>
                        <li><a href="contact.html">Contacto</a></li>
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
                        <?php
      						foreach ($empresas as $empresa) { ?>
                        <article class="cbp-item vlt-portfolio-grid-item vlt-portfolio-style2">
                            <div class="vlt-portfolio-grid-image">
                                <a class="vlt-portfolio-grid-link"
                                    href="Template/cursos.php?id_empresa=<?php echo $empresa["id"] ?>">
                                    <img src="uploads/empresas/<?php echo $empresa["miniatura"] ?>" alt="">
                                </a>
                            </div>
                            <div class="vlt-portfolio-grid-content">
                                <h5 class="vlt-portfolio-grid-title"><?php echo $empresa["nombre_empresa"] ?></h5>
                                <p class="vlt-portfolio-grid-cat">Photo</p>
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
                            <img src="assets/img/logo.png" alt="Vinero" style="max-height: 13px">
                        </a>
                        <div class="vlt-footer-menu">
                            <div>
                                <ul>
                                    <li>
                                        <a href="#">Inicio</a>
                                    </li>
                                    <li>
                                        <a href="#">Campus</a>
                                    </li>
                                    <li>
                                        <a href="#">Sobre Nosotros</a>
                                    </li>
                                    <li>
                                        <a href="#">Contacto</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="vlt-footer-copyright">
                            <p>Copyright © 2022 Conteniluz. Powered by <a href="#" class="vlt-link reverse">VLThemes</a>
                            </p>
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
<script src="assets/vendors/jquery.min.js"></script>
<script src="assets/scripts/plugins.min.js"></script>
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
<script src="assets/scripts/script.js"></script>

</html>