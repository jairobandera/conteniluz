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
        $tpo = 'Y';

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
    
    $titulo = $_POST['vidtitle'];
    $descripcion = $_POST['viddesc'];
    $id = $_POST['id'];
    $id_curso = $_SESSION['id_curso'];
    //$id_empresa = $_SESSION['id_empresa'];

    $id_profesor = $_SESSION['id_profesor'];

    //$sentenciaSQL = $conn->query("INSERT INTO videos (id_profesor,id_curso,id_empresa,id_video,tipo,titulo_video,descripcion,miniatura) VALUES ($id_profesor,$id_curso,$id_empresa,'$link','$tipo','$titulo','$descripcion','$fileName')");
    
    if($fileName != $imagen AND $fileName != ''){
        $sentenciaSQL = $conn->query("UPDATE videos SET id_video = '$link', titulo_video = '$titulo', miniatura = '$fileName', descripcion = '$descripcion', tipo = '$tipo' WHERE id = $id");
    }else if($fileName == ''){
        $sentenciaSQL = $conn->query("UPDATE videos SET id_video = '$link', titulo_video = '$titulo', descripcion = '$descripcion', tipo = '$tipo' WHERE id = $id");
    }

    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/verVideos.php');
    }
    else{
        echo mysqli_error($conn);
    }

}

?>