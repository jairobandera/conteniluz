<?php
session_start();
include 'config.php';
$conectado = conectar();
$index = 0;
$i = 0;	


if(isset($_SESSION['alumnoLogeado']) AND $_SESSION['alumnoLogeado'] == true){
    $alumno = true;
}else{
    //echo 'alumno no logeado';
    $alumno = false;
}
//Si existe id profesor y id empresa
if(isset($_GET['idP']) && isset($_GET['idE'])){
    //Traigo todos los cursos de ese profesor
    $id_profesor = $_GET['idP'];
    $id_empresa = $_GET['idE'];

    $resultado = $conectado->query("SELECT * FROM cursos WHERE id_profesor = $id_profesor AND id_empresa = $id_empresa ");
    $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
    /*echo '<pre>';
    print_r($cursos);*/

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

if(isset($_COOKIE['pais'])){
    $pais = $_COOKIE['pais'];
}

//Compruebo si hay un usuario
if(isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'USUARIO'){
	//$id_usuario = $_SESSION['id_usuario'];
	/*$resultado = $conectado->query("SELECT c.id FROM cursos AS c WHERE EXISTS(
	SELECT * FROM alumno AS a, usuario AS u WHERE a.id_curso = c.id AND u.id = $id_usuario AND u.tipo = 'USUARIO')");*/
	$id_usuario = $_SESSION['id_usuario'];
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
}

?>

<!DOCTYPE html>
<html lang="en" id="html">

<head>
    <meta charset="utf-8">
    <title>
        InstituZion - Comprar Cursos
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
                            <!-- news modal body miniatura image start -->
                            <!--<img alt="News Modal" class="img-responsive" src="uploads/cursos/<?php //echo $miniatura; ?>">-->
                            <!-- news modal body miniatura image end -->
                            <!-- news modal body video image start -->
                            <!-- for 0 to cantidad solo para videos -->
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
                            <img src="uploads/cursos/<?php echo $curso["miniatura"]; ?>" alt="" width="100%" height="">
                            <?php } ?>
                            <!-- news modal body video image end -->
                            <?php if( (PAIS == $pais) AND ($alumno == false) and $mp = 'Y'){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<form action="MercadoPago/index.php" method="post" target="">
                                    <input type="hidden" name="comprar" value="comprar">
                                    <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                    <input type="hidden" name="id_curso" value='.$id_curso.'>
                                    <input type="hidden" name="titulo" value='.$titulo_curso.'>
                                    <input type="hidden" name="precio" value='.$pesos.'>
                                    <input type="hidden" name="moneda" value="pesos">
                                    <button class=""
                                    style="border: 1px solid #ff264a; background-color: Transparent; overflow: hidden; width:20rem; height:auto; font-size:4rem; margin-top:2rem;">
                                    Comprar<br> <span class="" style="font-size:1.5rem; color:#5f5f5f;">($ '.$pesos .')</span></button></form>';
                                ?>
                            </div><!-- button end -->
                            <?php $index = $index + 1;}elseif( (PAIS != $pais) AND ($alumno == false) and ($paisEmpresa == 'argentina') and ($paypal == 'N') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<h1> <span class="" style="font-size:1.5rem; color:#5f5f5f;">(Lo sentimos, este cuso no se puede comprar desde tu pais: '.$pais.')</span></h1>';
                                ?>
                            </div><!-- button end -->
                            <?php $index = $index + 1;?>
                            <?php }elseif( (PAIS != $pais) AND ($alumno == false) and ($paisEmpresa == 'argentina') and ($paypal == 'Y') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<form action="MercadoPago/index.php" method="post" target="">
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
                            <?php $index = $index + 1;}elseif( (PAIS != $pais) AND ($alumno == false) and ($paisEmpresa != 'argentina') and ($paypal == 'Y') ){ ?>
                            <div class="button-the-wrapper"
                                style="display: flex;align-items: center;justify-content: center;">
                                <?php
                                echo '<form action="MercadoPago/index.php" method="post" target="">
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
                            <?php $index = $index + 1;}elseif($alumno == true AND isset($array[$i]) AND $array[$i] == $curso["id"] AND isset($arrayPagos) AND $arrayPagos[$i] == 'Y' AND $arrayPagos[$i] != 'N'){ 
                                echo'<div class="" style="display: flex; align-items: center;justify-content: center; margin-top:2rem;">
                                        <a class="" style="border:1px solid #ff264a;width:20rem; height:6rem;font-size:4rem;text-align:center;" href="Template/alumno/index.php">Ver curso</a>
                                    </div> ';
                             }else{?>
                             <?php /*if(PAIS == $pais){ ?>
                                    <div class="button-the-wrapper"
                                        style="display: flex;align-items: center;justify-content: center;">
                                        <?php
                                        echo '<form action="MercadoPago/index.php" method="post" target="">
                                            <input type="hidden" name="comprar" value="comprar">
                                            <input type="hidden" name="id_empresa" value='.$id_empresa.'>
                                            <input type="hidden" name="id_curso" value='.$id_curso.'>
                                            <input type="hidden" name="titulo" value='.$titulo_curso.'>
                                            <input type="hidden" name="precio" value='.$pesos.'>
                                            <input type="hidden" name="moneda" value="pesos">
                                            <button class=""
                                            style="border: 1px solid #ff264a; background-color: Transparent; overflow: hidden; width:20rem; height:auto; font-size:4rem; margin-top:2rem;">
                                            Comprar<br><span class="" style="font-size:1.5rem; color:#5f5f5f;">(U$S '.$pesos .')</span>
                                            </button></form>';
                                        ?>
                                    </div><!-- button end -->
                            <?php } ?>  
                             <?php if(PAIS != $pais){ ?>
                                    <div class="button-the-wrapper"
                                        style="display: flex;align-items: center;justify-content: center;">
                                        <?php
                                        echo '<form action="MercadoPago/index.php" method="post" target="">
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
                            <?php } */?>  
                            <?php } ?>
                            <!-- cierre del if pais -->
                            <?php } ?>
                            <!-- cierre del foreach -->
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


    
    <script src="assetsFinal/js/plugins.js">
    </script>
    <script src="assetsFinal/js/ultimex.js">
    </script><!-- scripts end -->
</body>

</html>