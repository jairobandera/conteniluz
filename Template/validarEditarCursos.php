<?php
session_start();
include '../config.php';//BD

if(isset($_POST['upload-btn'])){
    $conn = conectar();
    
    $descripcion = htmlspecialchars($_POST['cursodesc'], ENT_QUOTES, 'UTF-8');
    $titulo = $_POST['vidtitle'];
    $duracion = $_POST['duracion'];
    $precioPesos = $_POST['precioPesos'];
    $precioDolares = $_POST['precioDolares'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];
    //$moneda = $_POST['moneda'];

    $id_curso = $_SESSION['id_curso'];
    //$id_empresa = $_SESSION['id_empresa'];

    $id_usuario = $_SESSION['id_usuario'];

    //saco la imagen del curso
    $conectar = $conn->query("SELECT miniatura FROM cursos WHERE id = $id_curso");
    $imagen = $conectar->fetch_assoc();
    $imagen = $imagen['miniatura'];

     //quitar espacios en blanco
     $fileName = preg_replace('/\s+/', '', $fileName);
     $fileName = strtolower($fileName);
     $fileName = str_replace(" ", "", $fileName);
     
     //muevo la imagen a la carpeta con el nombre con la fecha y hora actual y el nombre de la imagen y la extencion
     $ruta = RUTACURSOS . date("Y-m-d-H-i-s") . $fileName;
     
     //Compruebo si exise una imagen con el mismo nombre 
     if(file_exists($ruta)){
             //si existe le agrego un numero al fina
         $ruta = RUTACURSOS . date("Y-m-d-H-i-s") . rand(0, 100) . $fileName;
         //Elimino la imagen anterior
         unlink(RUTACURSOS . $imagen);
         move_uploaded_file($file['tmp_name'], $ruta);
     }else{
        //muevo la imagen a la carpeta
        // unlink(RUTACURSOS . $imagen);
         move_uploaded_file($file['tmp_name'], $ruta);
     }        
     //obtengo la ruta sin RUTAEMPRESAS
     $ruta = str_replace(RUTACURSOS, "", $ruta);

    if($fileName != $imagen AND $fileName != ''){
        $sentenciaSQL = $conn->query("UPDATE cursos SET titulo_curso = '$titulo', miniatura = '$ruta',dolares = '$precioDolares', pesos = '$preciosPesos', duracion = $duracion, descripcion = '$descripcion' WHERE id = $id_curso");
    }else if($fileName == ''){
        $sentenciaSQL = $conn->query("UPDATE cursos SET titulo_curso = '$titulo',dolares = '$precioDolares', pesos = '$precioPesos', duracion = $duracion, descripcion = '$descripcion' WHERE id = $id_curso");
    }
    
    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/cursos.php?id_curso='.$id_curso);
    }
    else{
        echo mysqli_error($conn);
    }

}

?>