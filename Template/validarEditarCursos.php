<?php
session_start();
include '../config.php';//BD

if(isset($_POST['upload-btn'])){
    $conn = conectar();
    
    $titulo = $_POST['vidtitle'];
    $duracion = $_POST['duracion'];
    $precios = $_POST['precio'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];

    $id_curso = $_SESSION['id_curso'];
    $id_empresa = $_SESSION['id_empresa'];

    $id_usuario = $_SESSION['id_usuario'];

    //saco la imagen del curso
    $conectar = $conn->query("SELECT miniatura FROM cursos WHERE id = $id_curso");
    $imagen = $conectar->fetch_assoc();
    $imagen = $imagen['miniatura'];

    //echo $imagen;

    if($fileName != $imagen AND $fileName != ''){
        $sentenciaSQL = $conn->query("UPDATE cursos SET titulo_curso = '$titulo', miniatura = '$fileName', precio = '$precios', duracion = $duracion WHERE id = $id_curso");
    }else if($fileName == ''){
        $sentenciaSQL = $conn->query("UPDATE cursos SET titulo_curso = '$titulo', precio = '$precios', duracion = $duracion WHERE id = $id_curso");
    }
    
    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/cursos.php');
    }
    else{
        echo mysqli_error($conn);
    }



}

?>