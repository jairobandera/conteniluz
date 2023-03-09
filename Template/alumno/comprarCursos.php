<?php
session_start();
include '../../config.php';
$conectado = conectar();
$index = 0;
$i = 0;	


if(isset($_SESSION['alumnoLogeado']) AND $_SESSION['alumnoLogeado'] == true){
    $alumno = true;
}else{
    $alumno = false;
    //Si no existe un alumno logeado, lo redirijo al login
    echo '<script>window.location.href = "../login.php";</script>';
}

//traigo todos los profesores
$resultado = $conectado->query("SELECT p.*, e.miniatura, e.id AS idEmpresa FROM profesor AS p, empresa AS e WHERE p.id_usuario = e.id_usuario");
$profesores = $resultado->fetch_all(MYSQLI_ASSOC);


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
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
                            <!-- divider start -->
                            <?php foreach($profesores as $profesor){ ?>
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <!-- page title start -->
                            <div class="post-title post-title-news">
                                Profesor: <span class="post-title-color"><?php echo $profesor['nombre']; ?></span>
                            </div><!-- page title end -->
                            <div class="inner-divider-half"></div><!-- divider end -->
                            <img src="../../uploads/cursos/<?php echo $profesor["miniatura"]; ?>" alt="" width="100%" height="">
                            <!-- news modal body video image end -->
                            <div class="" style="display: flex; align-items: center;justify-content: center; margin-top:1rem;">
                                <a class="" style="border:1px solid #ff264a;width:20rem; height:6rem;font-size:4rem;text-align:center;" href="cursos.php?idProfesor=<?php echo $profesor['id'].'&idEmpresa='.$profesor['idEmpresa'].'' ?>">Ver cursos</a>
                            </div>
                            <?php } //fin foreach profesores?>
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

    <!-- funcion js para calcular las posiciones y arreglar espacio en negro -->
    <script>
        //detectar si la pantalla es menor a 768px
        let width = $(window).width();
        if (width < 992 || width < 768) {
            let boton = document.getElementById("botonVolver");
            let html = document.getElementById("html");
            let cooBoton = boton.getBoundingClientRect();
            let cooHtml = html.getBoundingClientRect();

            let cooFinal = cooHtml.height - cooBoton.bottom - 1;
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