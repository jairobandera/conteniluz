<?php
session_start();
include 'config.php';
$conectado = conectar();
$index = 0;

if(isset($_SESSION['tipo'])){
    if($_SESSION['tipo'] == 'USUARIO'){
			//header('Location: alumno/index.php?id_empresa='.$id_empresa);
            echo '<script>window.location.href = "Template/alumno/index.php";</script>';
	}
}

if(isset($_SESSION['id_empresa']) AND isset($_SESSION['id_curso'])){
    unset($_SESSION['id_empresa']);
    unset($_SESSION['id_curso']);
}

//Vengo desde un alumno que quiere comprar un curso
if(isset($_SESSION['habilitarCrearCuenta']) AND isset($_SESSION['eliminarBotonoes'])){
    $habilitarCuenta = $_SESSION['habilitarCrearCuenta'];
    $eliminarBotones = $_SESSION['eliminarBotonoes'];
    echo $eliminarBotones;
}

//traigo todos los profesores
/*$resultado = $conectado->query("SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS numero, p.*, c.descripcion, c.miniatura, c.id_empresa AS idEmpresa FROM profesor AS p, cursos AS c WHERE p.id = c.id_profesor ORDER BY id ASC");
$profesores = $resultado->fetch_all(MYSQLI_ASSOC);*/
$resultado = $conectado->query("SELECT ROW_NUMBER() OVER(ORDER BY id ASC) AS numero, e.*, p.id AS idProfesor, p.nombre FROM empresa AS e, profesor AS p where e.id_usuario = p.id_usuario");
$profesores = $resultado->fetch_all(MYSQLI_ASSOC);



//recorro los profesores
foreach ($profesores as $profesor){
    //$id_profesor = $profesor['id'];
   //echo $profesor['miniatura']; 
    //Traigo todos los cursos de los profesores
    //$resultado = $conectado->query("SELECT e.id,e.id_usuario,e.nombre_empresa,e.miniatura AS imgEmpresa,p.nombre, p.apellido, c.miniatura AS imgCurso, c.titulo_curso FROM empresa AS e, profesor AS p, cursos AS c WHERE e.id_usuario = p.id_usuario AND c.id_empresa = e.id AND c.id_profesor = p.id");
    //$resultados = $conectado->query("SELECT e.id, e.nombre_empresa,e.miniatura AS imgEmpresa, c.miniatura AS imgCurso, c.titulo_curso, c.descripcion FROM empresa AS e, cursos AS c, profesor AS p WHERE p.id = $id_profesor GROUP BY (e.id)");
    /*$resultados = $conectado->query("SELECT e.id, e.nombre_empresa,e.miniatura AS imgEmpresa, 
    c.miniatura AS imgCurso, c.titulo_curso, c.descripcion, p.id AS idProfesor
    FROM empresa AS e, cursos AS c, profesor AS p 
    WHERE p.id = c.id_profesor AND p.id_usuario = e.id_usuario
    GROUP BY (e.id)
    ORDER BY idProfesor ASC");

    $cursos = $resultados->fetch_all(MYSQLI_ASSOC);
    $id_empresa = $cursos[$index]['id'];*/
}

if(isset($_COOKIE["pais"])){
  $pais = $_COOKIE["pais"];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        InstituZion
    </title>
    <meta content="" name="description">
    <meta content="" name="author">
    <meta content="" name="keywords">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <link rel="icon" href="assets/assets/images/icono.png" type="image/png" />
    <!-- Ultimex v1.2 || ex nihilo || September - October 2020 -->
    <!-- style start -->
    <link href="assetsFinal/css/plugins.css" media="all" rel="stylesheet" type="text/css">
    <link href="assetsFinal/css/style-dark.css" media="all" rel="stylesheet" type="text/css"><!-- style end -->
    <!-- google fonts start -->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900%7COswald:300,400,700"
        rel="stylesheet" type="text/css"><!-- google fonts end -->
    <!-- estilos personales -->
    <link href="assetsFinal/css/style.css" media="all" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- preloader start 
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader">
                <span></span>
            </div>
        </div>
    </div>preloader end -->
    <!-- navigation wrapper start -->
    <div class="navbar-wrapper"></div><!-- navigation wrapper end -->
    <!-- navigation start -->
    <nav class="navbar navbar-fixed-top">
        <!-- container start -->
        <div class="container-fluid">
            <!-- navigation header start -->
            <div class="navbar-header">
                <!-- logo start -->
                <div class="logo">
                    <a class="navbar-brand logo" href="#"><img alt="Logo" src="assetsFinal/img/logo.png"
                            width="250px"></a>
                </div><!-- logo end -->
            </div><!-- navigation header end -->
            <!-- main navigation start -->
            <div class="main-navigation">
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar-collapse"
                        data-toggle="collapse" type="button"><span class="sr-only">Toggle
                            navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <!-- menu start -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="link-underline-menu active" href="#home">Inicio</a>
                        </li>
                        <li>
                            <a class="link-underline-menu" href="#about">Nosotros</a>
                        </li>
                        <li>
                            <a class="link-underline-menu" href="#news">Ver cursos</a>
                        </li>
                        <li>
                            <a class="link-underline-menu" href="#contact">Contacto</a>
                        </li>
                        <li>
                            <a style="color:#ff264a;" class="" href="#login">Salon de clases</a>
                        </li>
                    </ul><!-- menu end -->
                </div>
            </div><!-- main navigation end -->
        </div><!-- container end -->
    </nav><!-- navigation end -->
    <!-- main container start -->
    <div id="containerOT">
        <!-- social icons start -->
        <div class="social-icons">
            <ul>
                <li>
                    <a class="ion-social-whatsapp" href="https://wa.me/5493512153306?text=Hola%20Instituzion%20"
                        target="_blank"><span>Whatsapp</span></a>
                </li>
                <li>
                    <a class="ion-social-facebook" href="https://www.facebook.com/conteniluz"
                        target="_blank"><span>Facebook</span></a>
                </li>
                <li>
                    <a class="ion-social-instagram" href="https://www.instagram.com/instituzion"
                        target="_blank"><span>Instagram</span></a>
                </li>
            </ul>
        </div><!-- social icons end -->
        <!-- bottom credits start -->
        <div class="bottom-credits">
            <!-- page subtitle start -->
            <h4 class="bottom-credits-lead bottom-credits-first">
                (+549) 3512153306
            </h4><!-- page subtitle end -->
            <!-- page subtitle start -->
            <h4 class="bottom-credits-lead bottom-credits-lead-color">
                <a href="mailto:ultimex@ultimex.com">pablobandera.123@gmail.com</a>
            </h4><!-- page subtitle end -->
        </div><!-- bottom credits end -->
        <!-- vertical lines start -->
        <div class="vertical-lines-wrapper">
            <div class="vertical-lines"></div>
        </div><!-- vertical lines end -->
        <!-- overlay start -->
        <div id="overlay"></div><!-- overlay end -->
        <!-- hero bg start -->
        <div class="hero-fullscreen">
            <div class="hero-fullscreen-FIX">
                <div class="hero-bg">
                    <!-- hero slider wrapper start -->
                    <div class="hero-slider-wrapper">
                        <div class="hero-slider hero-slider-wrapper">
                            <!-- dot pattern start -->
                            <div class="dot-pattern-wrapper-home">
                                <div class="dot-pattern-home"></div>
                            </div><!-- dot pattern end -->
                            <!-- swiper container start -->
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <!-- swiper slide start -->
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-txt">
                                            <div class="swiper-slide-txt-inner">
                                                <!-- page subtitle start -->
                                                <h4 class="post-heading post-heading-all post-heading-slide">
                                                    La empresa
                                                </h4><!-- page subtitle end -->
                                                <!-- divider start -->
                                                <div class="inner-divider-half"></div><!-- divider end -->
                                                <!-- page title start -->
                                                <div class="post-title">
                                                    Somos<br>
                                                    <span class="post-title-color">Instituzion</span>
                                                </div><!-- page title end -->
                                                <!-- divider start -->
                                                <div class="inner-divider"></div><!-- divider end -->
                                                <!-- page TXT start -->
                                                <p>
                                                    Una plataforma dedicada a la edificacion de personas con un
                                                    proposito, <a class="link-underline" href="#">edificar</a>.
                                                </p><!-- page TXT end -->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div><!-- swiper slide end -->
                                    <!-- swiper slide start -->
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-txt">
                                            <div class="swiper-slide-txt-inner">
                                                <!-- page subtitle start -->
                                                <h4 class="post-heading post-heading-all post-heading-slide">
                                                    Miralo en
                                                </h4><!-- page subtitle end -->
                                                <!-- divider start -->
                                                <div class="inner-divider-half"></div><!-- divider end -->
                                                <!-- page title start -->
                                                <div class="post-title">
                                                    Todos los<br>
                                                    <span class="post-title-color">Dispositivos</span>
                                                </div><!-- page title end -->
                                                <!-- divider start -->
                                                <div class="inner-divider"></div><!-- divider end -->
                                                <!-- page TXT start -->
                                                <p>
                                                    No tenes excusas, podes ver el material de estudio en el dispositvo
                                                    que tengas <a class="link-underline" href="#">a tu alcance</a>.
                                                </p><!-- page TXT end -->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div><!-- swiper slide end -->
                                    <!-- swiper slide start -->
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-txt">
                                            <div class="swiper-slide-txt-inner">
                                                <!-- page subtitle start -->
                                                <h4 class="post-heading post-heading-all post-heading-slide">
                                                    Desarrollos
                                                </h4><!-- page subtitle end -->
                                                <!-- divider start -->
                                                <div class="inner-divider-half"></div><!-- divider end -->
                                                <!-- page title start -->
                                                <div class="post-title">
                                                    En breve mas<br>
                                                    <span class="post-title-color">Novedades</span>
                                                </div><!-- page title end -->
                                                <!-- divider start -->
                                                <div class="inner-divider"></div><!-- divider end -->
                                                <!-- page TXT start -->
                                                <p>
                                                    Estamos trabajando para darte mas herramientas y aportar beneficios
                                                    a la <a class="link-underline" href="#">comunidad</a>.
                                                </p><!-- page TXT end -->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div><!-- swiper slide end -->
                                    <!-- swiper slide start -->
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-txt">
                                            <div class="swiper-slide-txt-inner">
                                                <!-- page subtitle start -->
                                                <h4 class="post-heading post-heading-all post-heading-slide">
                                                    Futuro
                                                </h4><!-- page subtitle end -->
                                                <!-- divider start -->
                                                <div class="inner-divider-half"></div><!-- divider end -->
                                                <!-- page title start -->
                                                <div class="post-title">
                                                    Mira el<br>
                                                    <span class="post-title-color">Contenido</span>
                                                </div><!-- page title end -->
                                                <!-- divider start -->
                                                <div class="inner-divider"></div><!-- divider end -->
                                                <!-- page TXT start -->
                                                <p>
                                                    Tenes todo el material al alcanze de un <a class="link-underline"
                                                        href="#">click</a>.
                                                </p><!-- page TXT end -->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div><!-- swiper slide end -->
                                </div>
                            </div><!-- swiper container end -->
                        </div>
                    </div><!-- hero slider wrapper end -->
                    <!-- hero slider wrapper IMG start -->
                    <div class="hero-slider-wrapper-img hero-slider-img">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <!-- swiper slide start -->
                                <div class="swiper-slide">
                                    <div class="hero-slider-bg bg-img bg-img-1 overlay overlay-dark"
                                        data-swiper-parallax="20%"></div>
                                    <div class="overlay-cover cover-all"></div>
                                </div><!-- swiper slide end -->
                                <!-- swiper slide start -->
                                <div class="swiper-slide">
                                    <div class="hero-slider-bg bg-img bg-img-2 overlay overlay-dark"
                                        data-swiper-parallax="20%"></div>
                                    <div class="overlay-cover cover-all"></div>
                                </div><!-- swiper slide end -->
                                <!-- swiper slide start -->
                                <div class="swiper-slide">
                                    <div class="hero-slider-bg bg-img bg-img-3 overlay overlay-dark"
                                        data-swiper-parallax="20%"></div>
                                    <div class="overlay-cover cover-all"></div>
                                </div><!-- swiper slide end -->
                                <!-- swiper slide start -->
                                <div class="swiper-slide">
                                    <div class="hero-slider-bg bg-img bg-img-4 overlay overlay-dark"
                                        data-swiper-parallax="20%"></div>
                                    <div class="overlay-cover cover-all"></div>
                                </div><!-- swiper slide end -->
                            </div>
                        </div>
                    </div><!-- hero slider wrapper IMG end -->
                    <!-- swiper slider controls start -->
                    <div class="hero-slider-bg-controls">
                        <div class="swiper-slide-controls slide-prev">
                            <div class="ion-ios-arrow-left" style="margin: 1em auto;"></div>
                        </div>
                        <div class="swiper-slide-controls slide-next">
                            <div class="ion-ios-arrow-right" style="margin: 1em auto;"></div>
                        </div>
                    </div><!-- swiper slider controls end -->
                    <!-- swiper slider play-pause start -->
                    <div
                        class="swiper-slide-controls-play-pause-wrapper swiper-slide-controls-play-pause slider-on-off">
                        <div class="slider-on-off-switch" style="margin: 1em auto;">
                            <i class="ion-ios-play"></i>
                        </div>
                    </div><!-- swiper slider play-pause end -->
                    <!-- swiper slider pagination start -->
                    <div class="swiper-slide-pagination"></div><!-- swiper slider pagination end -->
                </div>
            </div>
        </div><!-- hero bg end -->
        <!-- about section start -->
        <div id="about-lifting">
            <!-- container start -->
            <div class="container-fluid" id="about">
                <!-- lifting inner start -->
                <div class="all-lifting-inner">
                    <!-- mobile divider start -->
                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                    <!-- row start -->
                    <div class="row">
                        <!-- col start -->
                        <div class="col-md-3 post-block">
                            <!-- page title start -->
                            <div class="page-title-content page-title-all">
                                <h1 class="post-title post-title-all-main-title" style="margin-top:15px;">
                                    Conocenos
                                </h1>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="owl-nav owl-nav-custom-about"></div><!-- owl nav end -->
                        </div><!-- col end -->
                        <!-- col start -->
                        <div class="col-md-9 the-first-lift">
                            <!-- post carousel start -->
                            <div class="owl-carousel" id="about-carousel">
                                <!-- post block start -->
                                <div class="post-block-second">
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- post item 1 start -->
                                        <div class="post-inner">
                                            <div class="post-content post-content-correction-about">
                                                <!-- post txt start -->
                                                <div class="post-txt">
                                                    <!-- page subtitle start -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-half"></div><!-- divider end -->
                                                    <div class="inner-divider-half"></div><!-- divider end -->
                                                    <!-- page title start -->
                                                    <div class="post-title" style="margin-top:10px;">
                                                        El <span class="post-title-color">Sueño</span>
                                                    </div><!-- page title end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-large"></div><!-- divider end -->
                                                    <!-- page TXT start -->
                                                    <div class="section-intro">
                                                        <p>
                                                            <span>Pablo Bandera</span> Me gustaría que esta plataforma
                                                            sea el puente de que todos aquellos que tienen algo de Dios
                                                            para comunicar y no tienen los recursos para hacerlo.
                                                        </p>
                                                    </div><!-- page TXT end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider"></div><!-- divider end -->
                                                    <!-- page TXT start -->
                                                    <p>
                                                        Como Iglesia tenemos una tremenda herramienta para impactar, SER
                                                        UNO.
                                                        Algunos “de afuera” entendieron que uniendo todo en un solo
                                                        lugar es más fácil llegar que haciendo fuerza de manera
                                                        independiente.
                                                        ¿Cómo nosotros, conociendo la verdad no vamos a lograr
                                                        <a class="link-underline" href="#">cosas mayores?</a>.
                                                    </p><!-- page TXT end -->
                                                </div><!-- post txt end -->
                                            </div>
                                        </div><!-- post item 1 end -->
                                    </div><!-- col end -->
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- post item 2 start -->
                                        <div class="post-inner">
                                            <div class="post-content">
                                                <!-- page subtitle start -->
                                                <!-- divider start -->
                                                <div class="inner-divider-half"></div><!-- divider end -->
                                                <!-- page title start -->
                                                <div class="post-title">
                                                    El <span class="post-title-color">Equipo</span>
                                                </div><!-- page title end -->
                                                <!-- divider start -->
                                                <div class="inner-divider-large"></div><!-- divider end -->
                                                <!-- facts counter start -->
                                                <!-- page TXT start -->
                                                <div class="section-intro">
                                                    <p>
                                                        <span>Tenemos muchas</span> ideas que poco a poco vamos a ir
                                                        desarrollando para depositar aquí.
                                                    </p>
                                                </div><!-- page TXT end -->
                                                <!-- divider start -->
                                                <div class="inner-divider"></div><!-- divider end -->
                                                <!-- page TXT start -->
                                                <p>
                                                    Nuestra intención es innovar e implementar tantos recursos como
                                                    herramientas nos sean posibles, para que en un futuro cercano las
                                                    congregaciones tengan tecnología a su alcance para todas sus
                                                    <a class="link-underline" href="#">actividades.</a>.
                                                </p><!-- page TXT end -->
                                            </div>
                                        </div><!-- post item 2 end -->
                                    </div><!-- col end -->
                                </div><!-- post block end -->
                                <!-- post block start -->
                                <div class="post-block-second">
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- post item 3 start -->
                                        <div class="post-inner">
                                            <div class="post-content post-content-correction-about">
                                                <!-- post txt start -->
                                                <div class="post-txt">
                                                    <!-- page subtitle start -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-half"></div><!-- divider end -->
                                                    <!-- page title start -->
                                                    <div class="post-title">
                                                        Servicios<span class="post-title-color"></span>
                                                    </div><!-- page title end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-large"></div><!-- divider end -->
                                                    <!-- page TXT start -->
                                                    <div class="section-intro">
                                                        <p>
                                                            <span>¿Tienes una idea</span> o un proyecto y nos sabes cómo
                                                            producirlo?
                                                        </p>
                                                    </div><!-- page TXT end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider"></div><!-- divider end -->
                                                    <!-- page TXT start -->
                                                    <p>
                                                        Desde el equipo de INSTITUZION queremos contarte que podemos
                                                        producir todo tu proyecto. Tenemos todas las herramientas para
                                                        filmar, editar y desde aquí COMUNICAR lo que Dios depositó en
                                                        vos.
                                                        <a class="link-underline" href="#">Contáctanos!</a>.
                                                    </p><!-- page TXT end -->
                                                </div><!-- post txt end -->
                                            </div>
                                        </div><!-- post item 3 end -->
                                    </div><!-- col end -->
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                </div><!-- post block end -->
                                <!-- post block start -->
                            </div><!-- post carousel end -->
                        </div><!-- col end -->
                    </div><!-- row end -->
                    <!-- mobile divider start -->
                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                </div><!-- lifting inner end -->
            </div><!-- container end -->
        </div><!-- about section end -->
        <!-- news section start Profesores -->
        <div id="news-lifting">
            <!-- container start -->
            <div class="container-fluid" id="news">
                <!-- lifting inner start -->
                <div class="all-lifting-inner">
                    <!-- mobile divider start -->
                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                    <!-- row start -->
                    <div class="row">
                        <!-- col start -->
                        <div class="col-md-3 post-block">
                            <!-- page title start -->
                            <div class="page-title-content page-title-all">
                                <div class="post-title" style="font-size:7rem; margin:15px 0 0 15px;">
                                    Ver <br><span class="post-title-color">cursos</span>
                                </div><!-- page title end -->
                            </div><!-- page title end -->
                            <!-- owl nav start -->
                            <div class="owl-nav owl-nav-custom-news"></div><!-- owl nav end -->
                            <!-- page subtitle start -->
                            <!--<h2 class="section-heading" style="margin-top:40px;">
                                <span>04.</span> Stay Up-to-Date
                            </h2>< page subtitle end -->
                        </div><!-- col end -->
                        <!-- col start -->
                        <div class="col-md-9 the-first-lift">
                            <!-- post carousel start -->
                            <div class="owl-carousel" id="news-carousel">
                                <!-- post block start -->
                                <?php foreach($profesores as $profesor){ ?>
                                <div class="post-block-second">
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- post item 1 start -->
                                        <div class="post-inner" style="">
                                            <div class="post-content">
                                                <!-- post txt start -->
                                                <div class="post-txt">
                                                    <!-- divider start -->
                                                    <div class="inner-divider-half"></div><!-- divider end -->
                                                    <div class="inner-divider-large"></div><!-- divider end -->
                                                    <!-- page title start -->
                                                    <div class="post-title post-title-news" style="margin-top:3em;">
                                                        <?php 
                                                        $cadena = $profesor['nombre_empresa'];
                                                        //Si cadena tiene un espacio en blanco
                                                        if (strpos($cadena, ' ') !== false) {
                                                            //Separa la cadena en dos partes
                                                            list($palabra1, $palabra2) = explode(' ', $cadena);
                                                        }else{
                                                            $palabra1 = $cadena;
                                                            $palabra2 = "";
                                                        }

                                                        //list($palabra1, $palabra2) = explode(' ', $cadena);
                                                        
                                                        ?>
                                                        <?php echo $palabra1; ?> <span
                                                            class="post-title-color"><?php echo $palabra2; ?></span>
                                                    </div><!-- page title end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-half"></div><!-- divider end -->
                                                    <!-- page subtitle start -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-large"></div><!-- divider end -->
                                                    <!-- page TXT start -->
                                                    <div class="section-intro">
                                                        <p>
                                                            <?php echo $profesor['descripcion']; ?>
                                                        </p>
                                                    </div><!-- page TXT end -->
                                                </div><!-- post txt end -->
                                                <!-- button start -->
                                                <div class="button-the-wrapper">
                                                    <a style="font-size:20px;" class="button-the" data-toggle="modal"
                                                        href="comprarCursos.php?idP=<?php echo $profesor['idProfesor']; ?>&idE=<?php echo $profesor['id']; ?>">Comprar
                                                        cursos </a>
                                                </div><!-- button end -->
                                            </div>
                                        </div><!-- post item 1 end -->
                                    </div><!-- col end -->
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- news item 1 start -->
                                        <div class="works-item works-item-effect">
                                            <div class="works-item-size">
                                                <!-- post item IMG start -->
                                                <div class="post-box">
                                                    <div class="post-box-photo-news post-box-photo-news-<?php echo $profesor['numero']; ?> works-img-all"
                                                        style="background-image: url(uploads/empresas/<?php echo $profesor['miniatura']; ?>)">
                                                    </div>
                                                    <div class="works-img-all works-item-bg"></div>
                                                    <div class="works-description popup-photo-gallery">
                                                        <!-- post item link start -->
                                                        <div>
                                                            <div class="works-item-size-FIX">
                                                                <!-- section title start -->
                                                                <h3>
                                                                    Profesor:
                                                                </h3><!-- section title end -->
                                                                <!-- divider start -->
                                                                <div class="inner-divider-ultra-half"></div>
                                                                <!-- divider end -->
                                                                <!-- section subtitle start -->
                                                                <div class="works-description-second">
                                                                    <?php echo $profesor['nombre']; ?>
                                                                </div><!-- section subtitle end -->
                                                            </div><!-- post item end -->
                                                        </div><!-- post item link end -->
                                                        <!-- post item list start -->
                                                        <!--<a href="uploads/empresas/<?php //echo $cursos[$index]['imgEmpresa']; ?>"
                                                            title="Cursos / <?php //echo $cursos[$index]['titulo_curso']; ?>"></a>
                                                        <?php //$index++; ?>-->
                                                        <!--<a href="assetsFinal/img/works/works-gallery/gallery-2/gallery-1-2.jpg" title="Gallery 2 / Image description 2"></a> <a href=
                                                            "assetsFinal/img/works/works-gallery/gallery-2/gallery-1-3.jpg" title="Gallery 2 / Image description 3"></a> <a href=
                                                            "assetsFinal/img/works/works-gallery/gallery-2/gallery-1-4.jpg" title="Gallery 2 / Image description 4"></a>-->
                                                        <!-- post item list end -->
                                                        <!-- divider start -->
                                                        <div class="inner-divider-ultra-half"></div><!-- divider end -->
                                                    </div><!-- post item description end -->
                                                </div><!-- post item IMG end -->
                                            </div>
                                        </div><!-- news item 1 end -->
                                    </div><!-- col end -->
                                </div><!-- post block end -->
                                <?php } ?>
                            </div><!-- post carousel end -->
                        </div><!-- col end -->
                    </div><!-- row end -->
                    <!-- mobile divider start -->
                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                </div><!-- lifting inner end -->
            </div><!-- container end -->
        </div><!-- news section end -->
        <!-- contact section start -->
        <div id="contact-lifting">
            <!-- container start -->
            <div class="container-fluid" id="contact">
                <!-- lifting inner start -->
                <div class="all-lifting-inner">
                    <!-- mobile divider start -->
                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                    <!-- row start -->
                    <div class="row">
                        <!-- col start -->
                        <div class="col-md-3 post-block">
                            <!-- page title start -->
                            <div class="page-title-content page-title-all">
                                <h1 class="post-title post-title-all-main-title">
                                    Contacto
                                </h1>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- owl nav start -->
                            <div class="owl-nav owl-nav-custom-contact"></div><!-- owl nav end -->
                        </div><!-- col end -->
                        <!-- col start -->
                        <div class="col-md-9 the-first-lift">
                            <!-- post carousel start -->
                            <div class="owl-carousel" id="contact-carousel">
                                <!-- post block start -->
                                <div class="post-block-second">
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- post item 1 start -->
                                        <div class="post-inner">
                                            <div class="post-content post-content-correction-about">
                                                <!-- post txt start -->
                                                <div class="post-txt">
                                                    <!-- page subtitle start -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-half"></div><!-- divider end -->
                                                    <div class="inner-divider-large"></div><!-- divider end -->
                                                    <!-- page title start -->
                                                    <div class="post-title">
                                                        Escribenos
                                                    </div><!-- page title end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider-large"></div><!-- divider end -->
                                                    <!-- page TXT start -->
                                                    <div class="section-intro">
                                                        <p>
                                                            <span>¿Tienes una idea</span> o un proyecto en mente?
                                                            No dudes en escribirnos.
                                                        </p>
                                                    </div><!-- page TXT end -->
                                                    <!-- divider start -->
                                                    <div class="inner-divider"></div><!-- divider end -->
                                                </div><!-- post txt end -->
                                            </div>
                                        </div><!-- post item 1 end -->
                                    </div><!-- col end -->
                                    <!-- mobile divider start -->
                                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                                    <!-- col start -->
                                    <div class="col-md-6 col-lg-6 post-block-correction">
                                        <!-- post item 2 start -->
                                        <div class="post-inner">
                                            <div class="post-content">
                                                <!-- page TXT start -->
                                                <!-- contact form start -->
                                                <div id="contact-form">
                                                    <form action="contact.php" id="form" method="post" name="send">
                                                        <!-- col start -->
                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                            <input class="requiredField name" id="name" name="name"
                                                                placeholder="Nombre" type="text">
                                                        </div><!-- col end -->
                                                        <!-- col start -->
                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                            <input class="requiredField email" id="email" name="email"
                                                                placeholder="Correo" type="text">
                                                        </div><!-- col end -->
                                                        <!-- col start -->
                                                        <div class="make-space">
                                                            <input class="requiredField subject" id="subject"
                                                                name="Asunto" placeholder="Subject" type="text">
                                                        </div><!-- col end -->
                                                        <!-- col start -->
                                                        <div class="make-space">
                                                            <textarea class="requiredField message" id="message"
                                                                name="Mensaje" placeholder="Message"></textarea>
                                                        </div><!-- col end -->
                                                        <div>
                                                            <!-- button start -->
                                                            <div class="button-the-wrapper">
                                                                <button class="button-the button-the-submit" id="submit"
                                                                    type="submit"><span>Enviar</span></button>
                                                            </div><!-- button end -->
                                                        </div>
                                                    </form>
                                                </div><!-- contact form end -->
                                                <!-- page TXT end -->
                                            </div>
                                        </div><!-- post item 2 end -->
                                    </div><!-- col end -->
                                </div><!-- post block end -->
                            </div><!-- post carousel end -->
                        </div><!-- col end -->
                    </div><!-- row end -->
                    <!-- mobile divider start -->
                    <div class="inner-divider-mobile"></div><!-- mobile divider end -->
                </div><!-- lifting inner end -->
            </div><!-- container end -->
        </div><!-- contact section end -->
    </div><!-- main container end -->
    <!-- news modal 1 start -->
    <div aria-hidden="true" class="news-modal modal fade" id="newsModal-1" role="dialog" tabindex="-1">
        <!-- news modal content 1 start -->
        <div class="modal-content">
            <!-- container start -->
            <div class="container">
                <!-- dot pattern start -->
                <div class="dot-pattern-wrapper">
                    <div class="dot-pattern"></div>
                </div>
                <div class="dot-pattern-wrapper-reverse">
                    <div class="dot-pattern"></div>
                </div><!-- dot pattern end -->
                <!-- row start -->
                <div class="row">
                    <!-- col start -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- news modal body 1 start -->
                        <div class="modal-body">
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-lead">
                                Beauty / Fashion
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page title start -->
                            <div class="post-title post-title-news">
                                Simplicity is <span class="post-title-color">complex</span>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-date">
                                October 1, 2020
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-large"></div><!-- divider end -->
                            <!-- news modal body 1 image start -->
                            <img alt="News Modal" class="img-responsive" src="assetsFinal/img/news/news-1.jpg">
                            <!-- news modal body 1 image end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <div class="section-intro">
                                <p>
                                    <span>Lorem Ipsum</span> is simply dummy text of the printing and typesetting
                                    industry.
                                </p>
                            </div><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining <a class="link-underline" href="#">essentially unchanged</a>.
                            </p><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- button start -->
                            <div class="button-the-wrapper button-the-wrapper-modal">
                                <a class="button-the" data-dismiss="modal" href="#">Close</a>
                            </div><!-- button end -->
                        </div><!-- news modal body 1 end -->
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- container end -->
        </div><!-- news modal content 1 end -->
    </div><!-- news modal 1 end -->
    <!-- news modal 2 start -->
    <div aria-hidden="true" class="news-modal modal fade" id="newsModal-2" role="dialog" tabindex="-1">
        <!-- news modal content 2 start -->
        <div class="modal-content">
            <!-- container start -->
            <div class="container">
                <!-- dot pattern start -->
                <div class="dot-pattern-wrapper">
                    <div class="dot-pattern"></div>
                </div>
                <div class="dot-pattern-wrapper-reverse">
                    <div class="dot-pattern"></div>
                </div><!-- dot pattern end -->
                <!-- row start -->
                <div class="row">
                    <!-- col start -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- news modal body 2 start -->
                        <div class="modal-body">
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-lead">
                                People / Life
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page title start -->
                            <div class="post-title post-title-news">
                                Design is a <span class="post-title-color">process</span>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-date">
                                October 2, 2020
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-large"></div><!-- divider end -->
                            <!-- news modal body 2 video start -->
                            <div class="news-modal-video-container">
                                <iframe allowfullscreen height="315" src="" width="560"></iframe>
                            </div><!-- news modal body 2 video end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <div class="section-intro">
                                <p>
                                    <span>Lorem Ipsum</span> is simply dummy text of the printing and typesetting
                                    industry.
                                </p>
                            </div><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining <a class="link-underline" href="#">essentially unchanged</a>.
                            </p><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- button start -->
                            <div class="button-the-wrapper button-the-wrapper-modal">
                                <a class="button-the" data-dismiss="modal" href="#">Close</a>
                            </div><!-- button end -->
                        </div><!-- news modal body 2 end -->
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- container end -->
        </div><!-- news modal content 2 end -->
    </div><!-- news modal 2 end -->
    <!-- news modal 3 start -->
    <div aria-hidden="true" class="news-modal modal fade" id="newsModal-3" role="dialog" tabindex="-1">
        <!-- news modal content 3 start -->
        <div class="modal-content">
            <!-- container start -->
            <div class="container">
                <!-- dot pattern start -->
                <div class="dot-pattern-wrapper">
                    <div class="dot-pattern"></div>
                </div>
                <div class="dot-pattern-wrapper-reverse">
                    <div class="dot-pattern"></div>
                </div><!-- dot pattern end -->
                <!-- row start -->
                <div class="row">
                    <!-- col start -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- news modal body 3 start -->
                        <div class="modal-body">
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-lead">
                                Royalty / Stock
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page title start -->
                            <div class="post-title post-title-news">
                                Aesthetic is a <span class="post-title-color">decision</span>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-date">
                                October 3, 2020
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-large"></div><!-- divider end -->
                            <!-- news modal body 3 image start -->
                            <img alt="News Modal" class="img-responsive" src="assetsFinal/img/news/news-2.jpg">
                            <!-- news modal body 3 image end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <div class="section-intro">
                                <p>
                                    <span>Lorem Ipsum</span> is simply dummy text of the printing and typesetting
                                    industry.
                                </p>
                            </div><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining <a class="link-underline" href="#">essentially unchanged</a>.
                            </p><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- button start -->
                            <div class="button-the-wrapper button-the-wrapper-modal">
                                <a class="button-the" data-dismiss="modal" href="#">Close</a>
                            </div><!-- button end -->
                        </div><!-- news modal body 3 end -->
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- container end -->
        </div><!-- news modal content 3 end -->
    </div><!-- news modal 3 end -->
    <!-- news modal 4 start -->
    <div aria-hidden="true" class="news-modal modal fade" id="newsModal-4" role="dialog" tabindex="-1">
        <!-- news modal content 4 start -->
        <div class="modal-content">
            <!-- container start -->
            <div class="container">
                <!-- dot pattern start -->
                <div class="dot-pattern-wrapper">
                    <div class="dot-pattern"></div>
                </div>
                <div class="dot-pattern-wrapper-reverse">
                    <div class="dot-pattern"></div>
                </div><!-- dot pattern end -->
                <!-- row start -->
                <div class="row">
                    <!-- col start -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- news modal body 4 start -->
                        <div class="modal-body">
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-lead">
                                Culture / Travel
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page title start -->
                            <div class="post-title post-title-news">
                                Style is <span class="post-title-color">everything</span>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-date">
                                October 4, 2020
                            </h4><!-- page subtitle end -->
                            <!-- divider start -->
                            <div class="inner-divider-large"></div><!-- divider end -->
                            <!-- news modal body 4 image start -->
                            <img alt="News Modal" class="img-responsive" src="assetsFinal/img/news/news-4.jpg">
                            <!-- news modal body 4 image end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <div class="section-intro">
                                <p>
                                    <span>Lorem Ipsum</span> is simply dummy text of the printing and typesetting
                                    industry.
                                </p>
                            </div><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- page TXT start -->
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining <a class="link-underline" href="#">essentially unchanged</a>.
                            </p><!-- page TXT end -->
                            <!-- divider start -->
                            <div class="inner-divider"></div><!-- divider end -->
                            <!-- button start -->
                            <div class="button-the-wrapper button-the-wrapper-modal">
                                <a class="button-the" data-dismiss="modal" href="#">Close</a>
                            </div><!-- button end -->
                        </div><!-- news modal body 4 end -->
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- container end -->
        </div><!-- news modal content 4 end -->
    </div><!-- news modal 4 end -->
    <!-- scripts start -->
    <?php
    //Foreach para cargar imagenes a css
    //$numero = 0;
    /*foreach ($profesores as $profesor){
        $rutaImg = $profesor['miniatura'];
        echo "<style type='text/css'>.post-box-photo-news-".$profesor['numero']."{ background-image: url(uploads/cursos/".$rutaImg.");}</style>";
        //$numero++;
    }*/

    ?>
    <script src="assetsFinal/js/plugins.js">
    </script>
    <script src="assetsFinal/js/ultimex.js">
    </script><!-- scripts end -->
</body>

</html>