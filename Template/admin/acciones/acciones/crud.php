<?php
session_start();
include '../../../../config.php';//BD
$conn = conectar();

if(isset($_POST['agregarEmpresas-btn'])){

    $idUsuario = $_POST['idUsuario'];
    $nombreEmpresa = $_POST['nombreEmpresa'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];

    //quitar espacios en blanco
    $fileName = preg_replace('/\s+/', '', $fileName);
    $fileName = strtolower($fileName);
    $fileName = str_replace(" ", "", $fileName);

    //muevo la imagen a la carpeta con el nombre con la fecha y hora actual y el nombre de la imagen y la extencion
    $ruta = RUTAEMPRESAS . date("Y-m-d-H-i-s") . $fileName;

    //Compruebo si exise una imagen con el mismo nombre 
    if(file_exists($ruta)){
        //si existe le agrego un numero al fina
        $ruta = RUTAEMPRESAS . date("Y-m-d-H-i-s") . rand(0, 100) . $fileName;
        move_uploaded_file($file['tmp_name'], $ruta);
    }else{
        //muevo la imagen a la carpeta
        move_uploaded_file($file['tmp_name'], $ruta);
    }

    //obtengo la ruta sin RUTAEMPRESAS
    $ruta = str_replace(RUTAEMPRESAS, "", $ruta);

    $sentenciaSQL = $conn->query("INSERT INTO empresa (id_usuario,nombre_empresa,miniatura) VALUES ($idUsuario,'$nombreEmpresa','$ruta')");
    
    if($sentenciaSQL){
        if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
            $_SESSION['success'] = 'Empresa creada con exito';
            header ('Location: ../../admin.php');
        }else{
            $_SESSION['error'] = 'Error al crear la empresa';
            header ('Location: ../../admin.php');
        }        
    }
    else{
        echo mysqli_error($conn);
    }

    

}else if(isset($_POST['agregarCuentas-btn'])){

    $nombre = $_POST['nombrePersona'];
    $apellido = $_POST['apellidoPersona'];
    $telefono = $_POST['telefonoPersona'];
    $usuario = $_POST['usuarioPersona'];
    $pass = $_POST['passPersona'];
    $pass = md5($pass);
    $tipo = $_POST['tipoPersona'];
    $tipo = strtoupper($tipo);

    //$idEmpresa = $_POST['tipoEmpresa'];
    $idCurso = $_POST['tipoCurso'];

    $sentenciaSQL = $conn->query("INSERT INTO usuario (usuario,pass,tipo,nombre,apellido,telefono) VALUES ('$usuario','$pass','$tipo','$nombre','$apellido','$telefono')");
    
    if($sentenciaSQL){
        //insrtar en tabla alumno
        $sql = "SELECT MAX(id) AS id FROM usuario";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id = $row['id'];
        
        if($tipo == 'USUARIO'){
            $sentenciaSQL = $conn->query("INSERT INTO alumno (id_usuario, id_curso,pago) VALUES ($id,$idCurso,'N')");
        }else if($tipo == 'PROFESOR'){
            $sentenciaSQL = $conn->query("INSERT INTO profesor (id_usuario,nombre,apellido,telefono) VALUES ($id,'$nombre','$apellido','$telefono')");
        }

        if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
            $_SESSION['success'] = 'Cuenta creada con exito';
            header ('Location: ../../usuarios.php');
        }else{
            $_SESSION['error'] = 'Error al crear la cuenta';
            header ('Location: ../../usuarios.php');
        }
        
    }
    else{
        echo mysqli_error($conn);
    }
}elseif(isset($_POST['editarEmpresas-btn'])){
    $idEmpresa = isset($_POST['idEmpresa']) ? $_POST['idEmpresa'] : '';
    $nombreEmpresa = isset($_POST['nombreEmpresa']) ? $_POST['nombreEmpresa'] : '';
    $file = isset($_FILES['file1']) ? $_FILES['file1'] : '';
    $fileName = isset($file['name']) ? $file['name'] : '';

    //Obtengo los datos de la empresa
    $sentenciaSQL = $conn->query("SELECT * FROM empresa WHERE id = $idEmpresa");
    $empresa = $sentenciaSQL->fetch_assoc();

    //Si no se selecciona una imagen nueva, se mantiene la anterior
    if($fileName == ''){
        $fileName = $empresa['miniatura'];
    }

    //Actualizo los datos de la empresa si solo se cambia el nombre
    if($fileName == $empresa['miniatura']){
        $sentenciaSQL = $conn->query("UPDATE empresa SET nombre_empresa = '$nombreEmpresa' WHERE id = $idEmpresa");
    }elseif($nombreEmpresa == $empresa['nombre_empresa']){
        //Actualizo los datos de la empresa si solo se cambia la imagen 
        //quitar espacios en blanco
        $fileName = preg_replace('/\s+/', '', $fileName);
        $fileName = strtolower($fileName);
        $fileName = str_replace(" ", "", $fileName);
        
        //muevo la imagen a la carpeta con el nombre con la fecha y hora actual y el nombre de la imagen y la extencion
        $ruta = RUTAEMPRESAS . date("Y-m-d-H-i-s") . $fileName;
        
        //Compruebo si exise una imagen con el mismo nombre 
        if(file_exists($ruta)){
                //si existe le agrego un numero al fina
            $ruta = RUTAEMPRESAS . date("Y-m-d-H-i-s") . rand(0, 100) . $fileName;
            //Elimino la imagen anterior
            unlink(RUTAEMPRESAS . $empresa['miniatura']);
            move_uploaded_file($file['tmp_name'], $ruta);
        }else{
                //muevo la imagen a la carpeta
            //unlink(RUTAEMPRESAS . $empresa['miniatura']);
            move_uploaded_file($file['tmp_name'], $ruta);
        }        
        //obtengo la ruta sin RUTAEMPRESAS
        $ruta = str_replace(RUTAEMPRESAS, "", $ruta);       
        $sentenciaSQL = $conn->query("UPDATE empresa SET miniatura = '$ruta' WHERE id = $idEmpresa");
    }else{
        //Actualizo los datos de la empresa si se cambia el nombre y la imagen
        $sentenciaSQL = $conn->query("UPDATE empresa SET nombre_empresa = '$nombreEmpresa', miniatura = '$fileName' WHERE id = $idEmpresa");
    }
    
    if($sentenciaSQL){
        if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
            $_SESSION['success'] = 'Empresa actualizada con exito';
            header ('Location: ../editarEmpresas.php?id_empresa='.$idEmpresa);
        }else{
            $_SESSION['error'] = 'Error al actualizar la empresa';
            header ('Location: ../editarEmpresas.php?id_empresa='.$idEmpresa);
        }
    }
    else{
        echo mysqli_error($conn);
    }
}else if(isset($_POST['agregarCursos-btn'])){
    $titulo = $_POST['titulo'];
    $precioPesos = $_POST['precioPesos'];
    $precioDolares = $_POST['precioDolares'];
    $duracion = $_POST['duracion'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];
    $idEmpresa = $_POST['idEmpresa'];
    $idProfesor = $_POST['idProfesor'];
    //$moneda = $_POST['moneda'];

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
        move_uploaded_file($file['tmp_name'], $ruta);
    }else{
            //muevo la imagen a la carpeta
        move_uploaded_file($file['tmp_name'], $ruta);
    }
    
    //obtengo la ruta sin RUTAEMPRESAS
    $ruta = str_replace(RUTACURSOS, "", $ruta);

    //inserto el curso
    $sentenciaSQL = $conn->query("INSERT INTO cursos (id_empresa,id_profesor,titulo_curso,miniatura,dolares,pesos,duracion) VALUES ($idEmpresa,$idProfesor,'$titulo','$ruta','$precioDolares',$precioPesos,'$duracion')");
    
    if($sentenciaSQL){
        if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
            $_SESSION['success'] = 'Curso creado con exito';
            header ('Location: ../../admin.php');
        }else{
            $_SESSION['error'] = 'Error al crear el curso';
            header ('Location: ../../admin.php');
        }        
    }else{
        echo mysqli_error($conn);
    }

}else if(isset($_POST['uploadVideos-btn'])){

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
    $id_curso = $_POST['id_curso'];
    $id_empresa = $_POST['id_empresa'];
    $id_profesor = $_POST['id_profesor'];

    //quitar espacios en blanco
    $fileName = preg_replace('/\s+/', '', $fileName);
    $fileName = strtolower($fileName);
    $fileName = str_replace(" ", "", $fileName);
    
    //muevo la imagen a la carpeta con el nombre con la fecha y hora actual y el nombre de la imagen y la extencion
    $ruta = RUTAVIDEOSMINIATURAS . date("Y-m-d-H-i-s") . $fileName;
    
    //Compruebo si exise una imagen con el mismo nombre 
    if(file_exists($ruta)){
            //si existe le agrego un numero al fina
        $ruta = RUTAVIDEOSMINIATURAS . date("Y-m-d-H-i-s") . rand(0, 100) . $fileName;
        move_uploaded_file($file['tmp_name'], $ruta);
    }else{
        //muevo la imagen a la carpeta
        move_uploaded_file($file['tmp_name'], $ruta);
    }        
    //obtengo la ruta sin RUTAEMPRESAS
    $ruta = str_replace(RUTAVIDEOSMINIATURAS, "", $ruta);    

    $sentenciaSQL = $conn->query("INSERT INTO videos (id_profesor,id_curso,id_empresa,id_video,tipo,es_presentacion,titulo_video,descripcion,miniatura) VALUES ($id_profesor,$id_curso,$id_empresa,'$link','$tipo','$presentacion','$titulo','$descripcion','$ruta')");
    
    if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
        $_SESSION['success'] = 'Video agregado con exito';
        header ('Location: ../verCursos.php?id_empresa='.$id_empresa);
    }else{
        $_SESSION['error'] = 'Error al agregar video';
        header ('Location: ../verCursos.php?id_empresa='.$id_empresa);
    }

}else if(isset($_POST['deleteVideo-btn'])){
    
    if(isset($_POST['id_curso']) and isset($_POST['id_empresa']) and isset($_POST['id_profesor'])){
        $id_curso = $_POST['id_curso'];
        $id_profesor = $_POST['id_profesor'];
        $id_empresa = $_POST['id_empresa'];
    }
    $id = $_POST['id'];    
    $conn->query("DELETE * FROM videos WHERE id = $id");

    header ('Location: ../editarVideos.php?id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&id_profesor='.$id_profesor);

}else if(isset($_POST['editVideo-btn'])){
    
    if(isset($_POST['id_curso']) and isset($_POST['id_empresa']) and isset($_POST['id_profesor'])){
        $id_curso = $_POST['id_curso'];
        $id_profesor = $_POST['id_profesor'];
        $id_empresa = $_POST['id_empresa'];
    }  
    $id = $_POST['id'];

    if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
        $_SESSION['success'] = 'Video editado con exito';
        header ('Location: ../editarVideos2.php?id='.$id.'&id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&id_profesor='.$id_profesor);
    }else{
        $_SESSION['error'] = 'Error al editar video';
        header ('Location: ../editarVideos2.php?id='.$id.'&id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&id_profesor='.$id_profesor);
    }

}else if(isset($_POST['updateVideo-btn'])){

    if(isset($_POST['id_curso']) and isset($_POST['id_empresa']) and isset($_POST['id_profesor'])){
        $id_curso = $_POST['id_curso'];
        $id_profesor = $_POST['id_profesor'];
        $id_empresa = $_POST['id_empresa'];
    }    

    if(isset($_POST['linkVimeo']) AND $_POST['linkVimeo'] != ''){
        $link = $_POST['linkVimeo'];
        $tipo = 'V';
    }else if(isset($_POST['linkYoutube']) AND $_POST['linkYoutube'] != ''){
        $link = $_POST['linkYoutube'];
        $tipo = 'Y';

        parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
        
        if(isset($my_array_of_vars['v'])){
            $link = $my_array_of_vars['v'];
        }
    }

    //$descripcion = $_POST['viddesc'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];
    $presentacion = $_POST['presentacion'];
    $titulo = $_POST['vidtitle'];
    $descripcion = htmlspecialchars($_POST['viddesc'], ENT_QUOTES, 'UTF-8');
    $id = $_POST['id'];

    //saco las datos
    $conectar = $conn->query("SELECT * FROM videos WHERE id = $id");
    $resultado = $conectar->fetch_assoc();
    $imagen_vieja = $resultado['miniatura'];
    $titulo_viejo = $resultado['titulo_video'];
    $descripcion_viejo = $resultado['descripcion'];
    $link_viejo = $resultado['id_video'];
    $tipo_viejo = $resultado['tipo'];
    $es_presentacion_viejo = $resultado['es_presentacion'];

    //quitar espacios en blanco
    $fileName = preg_replace('/\s+/', '', $fileName);
    $fileName = strtolower($fileName);
    $fileName = str_replace(" ", "", $fileName);
    
    //muevo la imagen a la carpeta con el nombre con la fecha y hora actual y el nombre de la imagen y la extencion
    $ruta = RUTAVIDEOSMINIATURAS . date("Y-m-d-H-i-s") . $fileName;
    
    //Compruebo si exise una imagen con el mismo nombre 
    if(file_exists($ruta)){
            //si existe le agrego un numero al fina
        $ruta = RUTAVIDEOSMINIATURAS . date("Y-m-d-H-i-s") . rand(0, 100) . $fileName;
        //Elimino la imagen anterior
        unlink(RUTAVIDEOSMINIATURAS . $imagen_vieja);
        move_uploaded_file($file['tmp_name'], $ruta);
    }else{
            //muevo la imagen a la carpeta
        unlink(RUTAVIDEOSMINIATURAS . $imagen_vieja);
        move_uploaded_file($file['tmp_name'], $ruta);
    }        
    //obtengo la ruta sin RUTAEMPRESAS
    $ruta = str_replace(RUTAVIDEOSMINIATURAS, "", $ruta);
    
    if( ($fileName != $imagen_vieja AND $fileName != '')  AND ($presentacion == $es_presentacion_viejo) AND ($titulo == $titulo_viejo) AND ($descripcion == $descripcion_viejo) AND ($link == $link_viejo AND $tipo == $tipo_viejo) ){
        $sentenciaSQL = $conn->query("UPDATE videos SET `miniatura` = '$ruta' WHERE `id` = $id");
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
            $sentenciaSQL = $conn->query("UPDATE videos SET `id_video` = '$link', `tipo` = '$tipo',`es_presentacion` = '$presentacion', `titulo_video` = '$titulo',`descripcion` = '$descripcion', `miniatura` = '$ruta'  WHERE `id` = $id");  
        }else{
            $sentenciaSQL = $conn->query("UPDATE videos SET `id_video` = '$link', `tipo` = '$tipo',`es_presentacion` = '$presentacion', `titulo_video` = '$titulo',`descripcion` = '$descripcion'  WHERE `id` = $id"); 
        }
    }

    if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
        $_SESSION['success'] = 'Video editado con exito';
        header ('Location: ../editarVideos.php?id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&id_profesor='.$id_profesor);
    }else{
        $_SESSION['error'] = 'Error al editar video';
        header ('Location: ../editarVideos.php?id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&id_profesor='.$id_profesor);
    }

}else if(isset($_POST['editarCursos-btn'])){
    
    $titulo = $_POST['vidtitle'];
    $duracion = $_POST['duracion'];
    $precioPesos = $_POST['precioPesos'];
    $precioDolares = $_POST['precioDolares'];
    $file = $_FILES['file1'];
    $fileName = $file['name'];
    $moneda = $_POST['moneda'];

    $id_curso = $_POST['id_curso'];
    $id_empresa = $_POST['id_empresa'];
    $id_profesor = $_POST['id_profesor'];

    //saco la imagen del curso
    $conectar = $conn->query("SELECT miniatura FROM cursos WHERE id = $id_curso");
    $imagen = $conectar->fetch_assoc();
    $imagen = $imagen['miniatura'];

    //echo $imagen;

    if($fileName != $imagen AND $fileName != ''){
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
            unlink(RUTACURSOS . $imagen);
            move_uploaded_file($file['tmp_name'], $ruta);
        }        
        //obtengo la ruta sin RUTAEMPRESAS
        $ruta = str_replace(RUTACURSOS, "", $ruta);

        $sentenciaSQL = $conn->query("UPDATE cursos SET titulo_curso = '$titulo', miniatura = '$ruta',dolares = '$precioDolares', pesos = '$precioPesos', duracion = $duracion WHERE id = $id_curso");
    }else if($fileName == ''){
        $sentenciaSQL = $conn->query("UPDATE cursos SET titulo_curso = '$titulo',dolares = '$precioDolares', pesos = '$precioPesos', duracion = $duracion WHERE id = $id_curso");
    }
    
    if($sentenciaSQL){
        if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
            $_SESSION['success'] = 'Curso creado con exito';
            header ('Location: ../verCursos.php?id_empresa='.$id_empresa);
        }else{
            $_SESSION['error'] = 'Error al crear el curso';
            header ('Location: ../verCursos.php?id_empresa='.$id_empresa);
        }        
    }else{
        echo mysqli_error($conn);
    }

}

?>