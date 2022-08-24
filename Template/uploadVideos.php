<?php
session_start();
include '../config.php';//BD

if(isset($_POST['upload-btn'])){
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
    $id_curso = $_SESSION['id_curso'];
    $id_empresa = $_SESSION['id_empresa'];

    $id_profesor = $_SESSION['id_profesor'];

    $sentenciaSQL = $conn->query("INSERT INTO videos (id_profesor,id_curso,id_empresa,id_video,tipo,titulo_video,descripcion,miniatura) VALUES ($id_profesor,$id_curso,$id_empresa,'$link','$tipo','$titulo','$descripcion','$fileName')");
    
    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/verVideos.php');
    }
    else{
        echo mysqli_error($conn);
    }



}

?>