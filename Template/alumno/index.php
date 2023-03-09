<?php
session_start();

include '../../config.php';
$conectado = conectar();

$_SESSION['alumnoLogeado'] = true;
$i = 0;	
$indexVideos = 0;

if(isset($_SESSION['id_usuario'])){
    $idUsuario = $_SESSION['id_usuario'];
	//$id_curso = $_GET['id_curso'];
	$resultado = $conectado->query("SELECT c.*, p.fecha_pago, p.id AS IdPago, p.id_alumno FROM cursos AS c, pagos AS p WHERE EXISTS(
        SELECT * FROM alumno AS a, usuario AS u WHERE a.id_usuario = u.id 
        AND a.id_curso = c.id AND u.id = ".$_SESSION['id_usuario']." AND u.tipo = 'USUARIO' AND p.id_curso = a.id_curso)");
	$cursos = $resultado->fetch_all(MYSQLI_ASSOC);

    //SI no hay cursos
    if(!$cursos){
        $idUsuario = $_SESSION['id_usuario'];
        //$id_curso = $_GET['id_curso'];
        $resultado = $conectado->query("SELECT c.* FROM cursos AS c WHERE EXISTS(
            SELECT * FROM alumno AS a, usuario AS u WHERE a.id_usuario = u.id 
            AND a.id_curso = c.id AND u.id = ".$_SESSION['id_usuario']." AND u.tipo = 'USUARIO')");
        $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
    }

    //Titulos para los tabs
    $titulos = array();
    foreach($cursos as $curso){
        $titulos[] = $curso['titulo_curso'];
    }

    //obtengo todos los titulos menos el primero
    $titulosMenosElPrimero = array_slice($titulos, 1);
}else{
    //Si no existe la variable de sesion id_usuario, redirecciono a la pagina de login
    echo '<script>window.location.href = "../login.php";</script>';
    //header('Location: ../login.php');
}

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
    $arrayVideos = array();

	if($cursos2){
		foreach($cursos2 as $curso2){
			$id_curso = $curso2['id'];
			$pago = $curso2['pago'];
			array_push($array, $id_curso);
			array_push($arrayPagos, $pago);
		}
        //sort($array);
        //$arrayPagos = array_reverse($arrayPagos);
	}
        //print_r($array);
        //print_r($arrayPagos);	
        //compruebo si existe la cookie pais
}
$pais =  $_COOKIE['pais'];

/*echo '<pre>';
print_r($duracionCursos);*/
?>
<!DOCTYPE html>
<html lang="en" id="html">

<head>
    <meta charset="utf-8">
    <title>
        InstituZion - Salon de clases
    </title>
    <meta content="" name="description">
    <meta content="" name="author">
    <meta content="" name="keywords">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <link rel="icon" href="../../assets/assets/images/icono.png" type="image/png" />
    <!-- Ultimex v1.2 || ex nihilo || September - October 2020 -->
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <!-- style start -->
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
                            <div class="button-the-wrapper button-the-wrapper-modal"
                                style="display:flex;justify-content: space-around;">
                                <a class="" data-dismiss="" href="comprarCursos.php">Comprar cursos</a>
                                <a class="" data-dismiss="" href="../cerrar.php">Cerrar sesion</a>
                            </div><!-- button end -->
                            <!-- cargo los titulos de los cursos -->
                            <!-- divider start -->
                            <?php if(empty($titulos)){ ?>
                                <?php echo '<h1 class="text-center" style="color:black;">No hay cursos disponibles</h1>'; ?>
                            <?php }else{ ?>
                                <?php 
                                    $searchString = " ";
                                    $replaceString = "";
                                    $titulosS = str_replace($searchString, $replaceString, $titulos[0]);
                                ?>
                                <div class="inner-divider-half"></div><!-- divider end -->
                                <ul class="nav nav-tabs">
                                    <li id="tabActive" class="active">
                                        <a data-toggle="tab"
                                            style="color:#ff264a; font-size:2rem; background-color:#808080; margin-right:5px;"
                                            class="post-title post-title-news"
                                            href="#<?php echo $titulosS; ?>"><?php echo $titulos[0]; ?></a>
                                    </li>
                                    <?php foreach($titulosMenosElPrimero as $titulosPrimero){ ?>
                                    <?php 
                                        $searchString = " ";
                                        $replaceString = "";
                                        $titulosPrimeroS = str_replace($searchString, $replaceString, $titulosPrimero);
                                    ?>
                                    <li id="tabActive">
                                        <a data-toggle="tab"
                                            style="color:#ff264a; font-size:2rem; background-color:#808080; margin-right:5px; margin-bottom:8px;"
                                            class="post-title post-title-news"
                                            href="#<?php echo $titulosPrimeroS; ?>"><?php echo $titulosPrimero; ?></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            <?php }//Fin if empty cursos ?>

                            <div class="tab-content">
                                <!-- inicio tab-content -->
                                <?php foreach($cursos as $curso){
                                        $id_curso = $curso['id'];
                                        $id_empresa = $curso['id_empresa'];
                                        $titulo_curso = $curso['titulo_curso'];
                                        $miniatura = $curso['miniatura'];
                                        $dolares = $curso['dolares'];
                                        $pesos = $curso['pesos'];
                                        $duracion = $curso['duracion'];
                                        if(isset($curso['fecha_pago'])){ $fechaPago = $curso['fecha_pago'];}
                                        $id_profesor = $curso['id_profesor'];
                                        if(isset($curso['IdPago'])){ $id_pago = $curso['IdPago'];}
                                        //$id_pago = $curso['IdPago'];
                                        if(isset($curso['id_alumno'])){ $id_alumno = $curso['id_alumno'];}
                                        //$id_alumno = $curso['id_alumno'];

                                        $resultado = $conectado->query("SELECT v.*, a.pago FROM videos AS v, alumno AS a WHERE EXISTS(
                                            SELECT * FROM cursos AS c WHERE a.id_curso = $id_curso
                                            AND v.id_curso = $id_curso 
                                            AND v.id_curso = $id_curso
                                            AND a.id_usuario = ".$_SESSION['id_usuario'].")");
                                        $videos = $resultado->fetch_all(MYSQLI_ASSOC);
                                        /*echo '<pre>';
                                        print_r($videos);*/
                                ?>
                                <?php //comprobar si es el primer curso ?>
                                <?php if($id_curso == $cursos[0]['id']){ ?>
                                <?php 
                                        $searchString = " ";
                                        $replaceString = "";
                                        $titulo_curso = str_replace($searchString, $replaceString, $titulo_curso);
                                    ?>
                                <div style="" id="<?php echo trim($titulo_curso); ?>" class="tab-pane fade in active"
                                    role="tabpanel" aria-labelledby="<?php echo $titulo_curso; ?>">
                                    <?php }else{
                                    $searchString = " ";
                                    $replaceString = "";
                                    $titulo_curso = str_replace($searchString, $replaceString, $titulo_curso);
                                    ?>
                                    <div style="" id="<?php echo trim($titulo_curso); ?>" class="tab-pane fade"
                                        role="tabpanel" aria-labelledby="<?php echo $titulo_curso; ?>">
                                        <?php } ?>
                                        <!-- divider start -->
                                        <div class="inner-divider-half"></div><!-- divider end -->
                                        <!-- primer tabs -->
                                        <!-- page title start -->
                                        <div class="post-title post-title-news">
                                            Titulo: <span
                                                class="post-title-color"><?php echo $videos[0]["titulo_video"];?></span>
                                        </div><!-- page title end -->
                                        <!-- divider start -->
                                        <div class="inner-divider-half"></div><!-- divider end -->
                                        <!-- page subtitle start -->
                                        <h4 class="post-heading post-heading-all post-heading-all-date" style="margin-bottom:10px;">
                                            Duracion: <span class="button-the-wrapper"><?php echo $duracion; ?></span>
                                            (Meses)
                                            <?php 
                                                if(isset($fechaPago)){
                                                    $fecha1 = new DateTime($fechaPago);
                                                    $fecha2 = new DateTime(date("Y-m-d"));
                                                    $fecha = $fecha1->diff($fecha2);
                                                    $meses = $fecha->m;
                                                    $dias = $fecha->d;
                                                    $diasTotales = $meses * 30 + $dias;
                                                    $diasRestantes = $duracion * 30 - $diasTotales;
                                                    $mesesRestantes = $diasRestantes / 30;
                                                    $mesesRestantes = round($mesesRestantes);

                                                    if($mesesRestantes <= 0){
                                                        //pasar el pago del alumno a N
                                                        $sql = "UPDATE alumno SET pago = 'N' WHERE id_usuario = ".$_SESSION['id_usuario']." AND id_curso = $id_curso";
                                                        $conectado->query($sql);
                                                        //actualizo el pagoCaducado de la tabla pago a N
                                                        $sql = "UPDATE pagos SET pagoCaducado = 'Y' WHERE id = $id_pago";
                                                        $conectado->query($sql);

                                                    }
                                                }else{
                                                    $mesesRestantes = '--';    
                                                }
                                                    
                                            ?>
                                        </h4><!-- page subtitle end -->
                                        <h4 class="post-heading post-heading-all post-heading-all-date">
                                            Meses restantes: <span class="button-the-wrapper"><?php echo $mesesRestantes; ?></span>
                                            (Meses)
                                        </h4><!-- page subtitle end -->
                                        <!-- page TXT start -->
                                        <div class="inner-divider-half"></div><!-- divider end -->
                                            <div class="section-intro">
                                                <p>
                                                    <?php echo $videos[0]["descripcion"];?>
                                                </p>
                                            </div><!-- page TXT end -->
                                            <!--<div class="inner-divider"></div>divider end -->
                                           <!-- <?php //if($mesesRestantes <= 0){ ?>
                                            <div class="alert alert-danger text-center" role="alert">
                                                <h4 class="alert-heading">Lo sentimos!</h4>
                                                <p class="text-center">El tiempo de acceso a este curso ha expirado.</p>
                                            </div>-->
                                            <?php //} ?>
                                            <div class="inner-divider-large"></div><!-- divider end -->
                                            <?php
                                            if(isset($array[$i]) AND $array[$i] == $curso["id"] AND isset($arrayPagos) AND $arrayPagos[$i] == 'Y' OR $arrayPagos[$i] != 'N'){
                                                if($videos[0]["tipo"] == 'V' AND $videos[0]['es_presentacion'] == 'Y'){
                                                    echo '
                                                    <div class="video-container">
                                                        <iframe src="https://player.vimeo.com/video/'.$videos[0]["id_video"].'"  height="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                    </div>';
                                                }elseif($videos[0]["tipo"] == 'Y' AND $videos[0]['es_presentacion'] == 'Y'){
                                                echo '
                                                    <div class="video-container">
                                                        <iframe src="https://www.youtube.com/embed/'.$videos[0]["id_video"].'"  height="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                    </div>';
                                                }
                                                $i= $i + 1;
                                            }elseif(isset($_SESSION['id_usuario'])){
                                                if($pais == PAIS){
                                                    if($videos[0]["tipo"] == 'V' AND $videos[0]['es_presentacion'] == 'Y'){
                                                        echo '
                                                        <div class="video-container">
                                                            <iframe src="https://player.vimeo.com/video/'.$videos[0]["id_video"].'"  height="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                        </div>';
                                                        $moneda = 'pesos';
                                                        echo '<form style="display: flex; align-items: center;justify-content: center;" action="../../MercadoPago/index.php" method="post" target="">
                                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                                <button style="margin-top:1rem;" type="submit" class="btn btn-success">$ '.$curso['pesos'].' - Comprar</button>
                                                            </form>';
                                                    }elseif($videos[0]["tipo"] == 'Y' AND $videos[0]['es_presentacion'] == 'Y'){
                                                    echo '
                                                        <div class="video-container">
                                                            <iframe src="https://www.youtube.com/embed/'.$videos[0]["id_video"].'"  height="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                        </div>';
                                                        $moneda = 'pesos';
                                                        echo '<form style="display: flex; align-items: center;justify-content: center;" action="../../MercadoPago/index.php" method="post" target="">
                                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                                <button style="margin-top:1rem;" type="submit" class="btn btn-success">$ '.$curso['pesos'].' - Comprar</button>
                                                            </form>';
                                                    }else{
                                                        $moneda = 'pesos';
                                                        echo '
                                                        <div class="" style="display: flex; align-items: center;justify-content: center;">
                                                            <img class="" width="100%" style="margin-top:-1rem;" src="../../uploads/cursos/'.$curso["miniatura"].'" alt="img">
                                                        </div>
                                                        <form style="display: flex; align-items: center;justify-content: center;" action="../../MercadoPago/index.php" method="post" target="">
                                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                                <button style="margin-top:1rem;" type="submit" class="btn btn-success">$ '.$curso['pesos'].' - Comprar</button>
                                                        </form>';

                                                    }
                                                }else{
                                                    if($videos[0]["tipo"] == 'V' AND $videos[0]['es_presentacion'] == 'Y'){
                                                        echo '
                                                        <div class="video-container">
                                                            <iframe src="https://player.vimeo.com/video/'.$videos[0]["id_video"].'"  height="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                        </div>';
                                                        $moneda = 'dolares';
                                                        echo '<form style="display: flex; align-items: center;justify-content: center;" action="../../MercadoPago/index.php" method="post" target="">
                                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                                <button style="margin-top:1rem;" type="submit" class="btn btn-success">USD '.$curso['dolares'].' - Comprar</button>
                                                            </form>';
                                                    }elseif($videos[0]["tipo"] == 'Y' AND $videos[0]['es_presentacion'] == 'Y'){
                                                    echo '
                                                        <div class="video-container">
                                                            <iframe src="https://www.youtube.com/embed/'.$videos[0]["id_video"].'"  height="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                        </div>';
                                                        $moneda = 'dolares';
                                                        echo '<form style="display: flex; align-items: center;justify-content: center;" action="../../MercadoPago/index.php" method="post" target="">
                                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                                <button style="margin-top:1rem;" type="submit" class="btn btn-success">USD '.$curso['dolares'].' - Comprar</button>
                                                            </form>';
                                                    }else{
                                                        $moneda = 'dolares';
                                                        echo '
                                                        <div class="" style="display: flex; align-items: center;justify-content: center;">
                                                            <img class="" width="100%" style="margin-top:-1rem;" src="../../uploads/cursos/'.$curso["miniatura"].'" alt="img">
                                                        </div>
                                                        <form style="display: flex; align-items: center;justify-content: center;" action="../../MercadoPago/index.php" method="post" target="">
                                                                <input type="hidden" name="id_empresa" value='.$curso["id_empresa"].'>
                                                                <input type="hidden" name="id_curso" value='.$curso['id'].'>
                                                                <input type="hidden" name="titulo" value='.$curso['titulo_curso'].'>
                                                                <input type="hidden" name="precio" value='.$curso['dolares'].'>
                                                                <input type="hidden" name="moneda" value='.$moneda.'>
                                                                <button style="margin-top:1rem;" type="submit" class="btn btn-success">USD '.$curso['dolares'].' - Comprar</button>
                                                        </form>';

                                                    }

                                                }
                                                $i = $i + 1;
                                            }
                                            ?>
                                    </div><!-- fin tab-pane fade -->
                                    <?php }//cierre del foreach cursos as curso ?>
                                </div><!-- fin tab-content -->
                                <!-- divider start -->
                                <div class="inner-divider-half"></div><!-- divider end -->
                                <div id="botonVolver" class="button-the-wrapper button-the-wrapper-modal"
                                    style="display:flex;justify-content: space-around;">
                                    <a class="" data-dismiss="" href="../../index.php">Pagina principal</a>
                                    <a class="" data-dismiss="" href="../cerrar.php">Cerrar sesion</a>
                                </div>
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

        <!-- funcion js para calcular las posiciones y arreglar espacio en negro -->
        <script>
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
        </script>

        <script src="../../assetsFinal/js/plugins.js">
        </script>
        <script src="../../assetsFinal/js/ultimex.js">
        </script><!-- scripts end -->
</body>

</html>