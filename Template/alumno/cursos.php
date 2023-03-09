<?php
session_start();
include '../../config.php';
$conectado = conectar();
$index = 0;
$i = 0;	

if(isset($_COOKIE['pais'])){
    $pais = $_COOKIE['pais'];
}

if(!isset($_SESSION['id_usuario'])){
    //Si no existe un alumno logeado, lo redirijo al login
    echo '<script>window.location.href = "../login.php";</script>';
}
//Si existe id profesor y id empresa
if(isset($_GET['idProfesor']) && isset($_GET['idEmpresa'])){
    //Traigo todos los cursos de ese profesor
    $id_profesor = $_GET['idProfesor'];
    $id_empresa = $_GET['idEmpresa'];
    $id_usuario = $_SESSION['id_usuario'];

    //dejo todos los cursos menos los que ya tiene el alumno
    $resultado = $conectado->query("SELECT * FROM cursos AS c WHERE c.id_profesor = $id_profesor AND c.id_empresa = $id_empresa
    AND NOT EXISTS
    (SELECT c.id FROM alumno AS a 
    WHERE c.id = a.id_curso AND a.id_usuario = $id_usuario AND a.pago = 'Y')");
    $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
    $registros = count($cursos);

    $datosVideos = array();

    foreach($cursos as $curso){
        $resultado = $conectado->query("SELECT id, id_video, tipo, es_presentacion, miniatura, id_curso FROM videos WHERE id_curso =".$curso['id']);
        $videos = $resultado->fetch_array(MYSQLI_ASSOC);
        $datosVideos[] = $videos;

    }    

    //traigo datos de mp y paypal de la empresa
    $resultado = $conectado->query("SELECT * FROM empresa WHERE id = $id_empresa");
    $empresa = $resultado->fetch_all(MYSQLI_ASSOC);

    $mp = $empresa[0]['mercadopago'];
    $paypal = $empresa[0]['paypal'];
    $paisEmpresa = $empresa[0]['pais'];

}
?>

<!DOCTYPE html>
<html lang="en" id="html">

<head>
    <meta charset="utf-8">
    <title>
        Ultimex - One Page Portfolio Template
    </title>
    <meta content="" name="description">
    <meta content="" name="author">
    <meta content="" name="keywords">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <link rel="icon" href="../../assets/assets/images/icono.png" type="image/png" />
    <!-- Ultimex v1.2 || ex nihilo || September - October 2020 -->
    <!-- style start -->
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <link href="../../assetsFinal/css/plugins.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../assetsFinal/css/style-dark.css" media="all" rel="stylesheet" type="text/css"><!-- style end -->
    <!-- google fonts start -->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900%7COswald:300,400,700"
        rel="stylesheet" type="text/css"><!-- google fonts end -->
</head>

<body>

    <div aria-hidden="true" class="" id="newsModal-1" role="dialog" tabindex="-1">
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
                            <div class="button-the-wrapper button-the-wrapper-modal">
                                <a class="button-the" data-dismiss="modal" href="./">Volver</a>
                            </div><!-- button end -->
                            <?php if(empty($cursos)){ ?>
                            <h2 class="title-small" style="margin:20px;">
                                <span class="post-title-color">No hay cursos disponibles</span>
                            </h2>
                            <?php }else{ ?>
                            <?php foreach($cursos as $curso){
                                        $id_curso = $curso['id'];
                                        $id_empresa = $curso['id_empresa'];
                                        $titulo_curso = $curso['titulo_curso'];
                                        $miniatura = $curso['miniatura'];
                                        $dolares = $curso['dolares'];
                                        $pesos = $curso['pesos'];
                                        $duracion = $curso['duracion'];
                                        $descripcion = $curso['descripcion'];
                                ?>
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page title start -->
                            <div class="post-title post-title-news">
                                Curso: <span class="post-title-color"><?php echo $titulo_curso; ?></span>
                            </div><!-- page title end -->
                            <!-- divider start -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page subtitle start -->
                            <h4 class="post-heading post-heading-all post-heading-all-date">
                                Duracion: <span class="button-the-wrapper"><?php echo $duracion; ?></span> (Meses)
                            </h4><!-- page subtitle end -->
                            <div class="section-intro">
                                <p>
                                    <?php echo $descripcion; ?>
                                </p>
                            </div><!-- page TXT end -->

                            <div class="inner-divider-large"></div><!-- divider end -->
                            <?php if( ((!is_null($datosVideos[$index]))) AND ($datosVideos[$index]["tipo"] == 'V') AND ($datosVideos[$index]['es_presentacion'] == 'Y') AND $datosVideos[$index]!= '' AND $datosVideos[$index] != NULL ){ ?>
                            <div class="video-container">
                                <iframe class=""
                                    src="https://player.vimeo.com/video/<?php echo $datosVideos[$index]["id_video"]; ?>"
                                    width="100%" height="" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                    allowfullscreen></iframe>
                            </div>
                            <?php }else if( ((!is_null($datosVideos[$index]))) AND ($datosVideos[$index]["tipo"] == 'Y') AND ($datosVideos[$index]['es_presentacion'] == 'Y') AND $datosVideos[$index]!= '' AND $datosVideos[$index] != NULL ){ ?>
                            <div class="video-container">
                                <iframe
                                    src="https://www.youtube.com/embed/<?php echo $datosVideos[$index]["id_video"]; ?>"
                                    width="100%" height="" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                    allowfullscreen></iframe>
                            </div>
                            <?php }else{ ?>
                            <img src="../../uploads/cursos/<?php echo $curso["miniatura"]; ?>" alt="" width="100%"
                                height="">
                            <?php } ?>
                            <!-- news modal body video image end -->
                            <?php if( (PAIS == $pais) AND ($mp = 'Y') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                        echo '<form action="../../MercadoPago/index.php" method="post" target="">
                                            <input type="hidden" name="comprar" value="comprar">
                                            <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                            <input type="hidden" name="id_curso" value='.$id_curso.'>
                                            <input type="hidden" name="titulo" value='.$titulo_curso.'>
                                            <input type="hidden" name="precio" value='.$pesos.'>
                                            <input type="hidden" name="moneda" value="pesos">
                                            <button class=""
                                            style="border: 1px solid #ff264a; background-color: Transparent; overflow: hidden; width:20rem; height:auto; font-size:4rem; margin-top:2rem;">
                                            Comprar<br><span class="" style="font-size:1.5rem; color:#5f5f5f;">($ '.$pesos .')</span>
                                            </button></form>';
                                        ?>
                            </div><!-- button end -->
                            <?php $index = $index + 1; $i = $i+1;}elseif( (PAIS != $pais) AND ($paisEmpresa == 'argentina') and ($paypal == 'N') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<h1> <span class="" style="font-size:1.5rem; color:#5f5f5f;">(Lo sentimos, este cuso no se puede comprar desde tu pais: '.$pais.')</span></h1>';
                                ?>
                            </div><!-- button end -->
                            <?php $index = $index + 1; $i = $i+1;?>
                            <?php }elseif( (PAIS != $pais) AND ($paisEmpresa == 'argentina') and ($paypal == 'Y') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<form action="../../MercadoPago/index.php" method="post" target="">
                                    <input type="hidden" name="comprar" value="comprar">
                                    <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                    <input type="hidden" name="id_curso" value='.$id_curso.'>
                                    <input type="hidden" name="titulo" value='.$titulo_curso.'>
                                    <input type="hidden" name="precio" value='.$dolares.'>
                                    <input type="hidden" name="moneda" value="dolares">
                                    <button class=""
                                    style="border: 1px solid #ff264a; background-color: Transparent; overflow: hidden; width:20rem; height:auto; font-size:4rem; margin-top:2rem;">
                                    Comprar<br><span class="" style="font-size:1.5rem; color:#5f5f5f;">(U$S '.$dolares .')</span>
                                    </button></form>';
                                ?>
                            </div><!-- button end -->
                            <?php $index = $index + 1; $i = $i+1;}elseif( (PAIS != $pais) AND ($paisEmpresa != 'argentina') and ($paypal == 'Y') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<form action="../../MercadoPago/index.php" method="post" target="">
                                    <input type="hidden" name="comprar" value="comprar">
                                    <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                    <input type="hidden" name="id_curso" value='.$id_curso.'>
                                    <input type="hidden" name="titulo" value='.$titulo_curso.'>
                                    <input type="hidden" name="precio" value='.$dolares.'>
                                    <input type="hidden" name="moneda" value="dolares">
                                    <button class=""
                                    style="border: 1px solid #ff264a; background-color: Transparent; overflow: hidden; width:20rem; height:auto; font-size:4rem; margin-top:2rem;">
                                    Comprar<br><span class="" style="font-size:1.5rem; color:#5f5f5f;">(U$S '.$dolares .')</span>
                                    </button></form>';
                                ?>
                            </div><!-- button end -->
                            <?php $index = $index + 1; $i = $i+1;}?>
                            <?php } ?><!-- cierre del foreach -->
                            <?php }?>
                            <!-- button start -->
                            <div class="button-the-wrapper button-the-wrapper-modal">
                                <a id="botonVolver" class="button-the" data-dismiss="modal" href="./">Volver</a>
                            </div><!-- button end -->
                        </div><!-- news modal body 1 end -->
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- container end -->
        </div><!-- news modal content 1 end -->
    </div><!-- news modal 1 end -->

    <style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    </style>

    <?php if(empty($cursos) OR ($registros < 2)){
        echo '<script>
        //detectar si la pantalla es menor a 768px
        let width = $(window).width();
        if (width < 992 || width < 768) {
            let boton = document.getElementById("botonVolver");
            let html = document.getElementById("html");
            let cooBoton = boton.getBoundingClientRect();
            let cooHtml = html.getBoundingClientRect();

            let cooFinal = cooHtml.height - cooBoton.bottom - 6;
            boton.style.marginTop = cooFinal + "px";
            //detectar si es tama;o tablet
        }
        </script>';
    }
    ?>


    <script src="../../assetsFinal/js/plugins.js">
    </script>
    <script src="../../assetsFinal/js/ultimex.js">
    </script><!-- scripts end -->
</body>

</html>