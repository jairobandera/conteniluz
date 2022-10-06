<?php
session_start();
include '../config.php';//BD

if(isset($_POST['edit-btn'])){
    $id = $_POST['id'];
    header ('Location: /pablo/Template/profesor/editarVideos.php?id='.$id);



}else if(isset($_POST['delete-btn'])){
    $conn = conectar();
    $id = $_POST['id'];
    
    $conn->query("DELETE FROM videos WHERE id = $id");

    header ('Location: /pablo/Template/profesor/verVideos.php');

}else if(isset($_POST['upload-btn'])){
    $conn = conectar();

    if(isset($_POST['linkVimeo']) AND $_POST['linkVimeo'] != ''){
        $link = $_POST['linkVimeo'];
        $tipo = 'V';
    }else if(isset($_POST['linkYoutube']) AND $_POST['linkYoutube'] != ''){
        $link = $_POST['linkYoutube'];
        $tipo = 'Y';

        parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
        
        if(isset($my_array_of_vars['v'])){
            $link = $my_array_of_vars['v'];
        }else{
            //echo $link; 
        }

           
    }

    //$descripcion = $_POST['viddesc'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];
    $presentacion = $_POST['presentacion'];
    $titulo = $_POST['vidtitle'];
    $descripcion = htmlspecialchars($_POST['viddesc'], ENT_QUOTES, 'UTF-8');
    $id = $_POST['id'];
    $id_curso = $_SESSION['id_curso'];
    //$id_empresa = $_SESSION['id_empresa'];

    $id_profesor = $_SESSION['id_profesor'];

    //saco las datos
    $conectar = $conn->query("SELECT * FROM videos WHERE id = $id");
    $resultado = $conectar->fetch_assoc();
    $imagen_vieja = $resultado['miniatura'];
    $titulo_viejo = $resultado['titulo_video'];
    $descripcion_viejo = $resultado['descripcion'];
    $link_viejo = $resultado['id_video'];
    $tipo_viejo = $resultado['tipo'];
    $es_presentacion_viejo = $resultado['es_presentacion'];
    
    if( ($fileName != $imagen_vieja AND $fileName != '')  AND ($presentacion == $es_presentacion_viejo) AND ($titulo == $titulo_viejo) AND ($descripcion == $descripcion_viejo) AND ($link == $link_viejo AND $tipo == $tipo_viejo) ){
        $sentenciaSQL = $conn->query("UPDATE videos SET `miniatura` = '$fileName' WHERE `id` = $id");
    }else if( ($presentacion != $es_presentacion_viejo) AND ($fileName == '') AND ($titulo == $titulo_viejo) AND ($descripcion == $descripcion_viejo) AND ($link == $link_viejo AND $tipo == $tipo_viejo) ){
        $sentenciaSQL = $conn->query("UPDATE videos SET `es_presentacion` = '$presentacion' WHERE `id` = $id");
    }else if( ($titulo != $titulo_viejo) AND ($presentacion == $es_presentacion_viejo) AND ($fileName == '') AND ($descripcion == $descripcion_viejo) AND ($link == $link_viejo AND $tipo == $tipo_viejo) ){
        $sentenciaSQL = $conn->query("UPDATE videos SET `titulo_video` = '$titulo' WHERE `id` = $id");
    }else if( ($descripcion != $descripcion_viejo) AND ($titulo == $titulo_viejo) AND ($presentacion == $es_presentacion_viejo) AND ($fileName == '') AND ($link == $link_viejo AND $tipo == $tipo_viejo) ){
        $sentenciaSQL = $conn->query("UPDATE videos SET `descripcion` = '$descripcion' WHERE `id` = $id");
    }else if( ($link != $link_viejo AND $tipo == $tipo_viejo) AND ($descripcion == $descripcion_viejo) AND ($titulo == $titulo_viejo) AND ($presentacion == $es_presentacion_viejo) AND ($fileName == '') ){ //cambio solo el link del video pero no el tipo
        $sentenciaSQL = $conn->query("UPDATE videos SET `id_video` = '$link' WHERE `id` = $id");
    }else if( ($link != $link_viejo AND $tipo != $tipo_viejo) AND ($descripcion == $descripcion_viejo) AND ($titulo == $titulo_viejo) AND ($presentacion == $es_presentacion_viejo) AND ($fileName == '') ){ //cambio el link y el tipo
        $sentenciaSQL = $conn->query("UPDATE videos SET `id_video` = '$link',`tipo` = '$tipo'  WHERE `id` = $id");
    }else{
        if($fileName != $imagen_vieja AND $fileName != ''){
            $sentenciaSQL = $conn->query("UPDATE videos SET `id_video` = '$link', `tipo` = '$tipo',`es_presentacion` = '$presentacion', `titulo_video` = '$titulo',`descripcion` = '$descripcion', `miniatura` = '$fileName'  WHERE `id` = $id");  
        }else{
            $sentenciaSQL = $conn->query("UPDATE videos SET `id_video` = '$link', `tipo` = '$tipo',`es_presentacion` = '$presentacion', `titulo_video` = '$titulo',`descripcion` = '$descripcion'  WHERE `id` = $id"); 
        }
    }

    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/verVideos.php');
    }else{
        header ('Location: /pablo/Template/profesor/verVideos.php');
    }

}

?>