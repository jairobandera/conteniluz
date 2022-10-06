<?php
session_start();
include '../config.php';//BD

/*require 'config.php'; //config de vimeo
require_once '../vendor/autoload.php';
use Vimeo\Vimeo;*/

if(isset($_POST['upload-btn'])){

    //$descripcion = $_POST['viddesc'];
    $titulo = $_POST['vidtitle'];
    $duracion = $_POST['duracion'];
    $precioPesos = $_POST['precioPesos'];
    $precioDolares = $_POST['precioDolares'];
    $id_usuario = $_POST['id_usuario'];
    //$moneda = $_POST['moneda'];

    $conn = conectar();
    $id_profesor = $_SESSION['id_profesor'];
    $id_empresa = $_SESSION['id_empresa_profesor'];
    echo $id_empresa;

    $file = $_FILES['file1'];
    $fileName = $_FILES['file1']['name'];
    //$fileTmpName = $_FILES['file1']['tmp_name'];
    //$fileSize = $_FILES['file1']['size'];
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

    //$sentenciaSQL = $conn->query("INSERT INTO videos (id_usuario,id_curso,id_empresa,id_video,titulo_video,descripcion,miniatura) VALUES (2,4,$id_empresa,'$link','$titulo','$descripcion','1.png')");
    $sentenciaSQL = $conn->query("INSERT INTO cursos (id_empresa,id_profesor,titulo_curso,miniatura,dolares,pesos,duracion) VALUES ($id_empresa,$id_profesor,'$titulo','$ruta','$precioDolares','$precioPesos',$duracion)");

    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/index.php');
    }
    else{
        echo mysqli_error($conn);
    }

   /* $client = new Vimeo($clientId,$clientSecret,$accessToken);
    $response = $client->request('/tutorial', array(), 'GET');
    
    $file = $_FILES['file1']['name'];  
    $tmp = $_FILES['file1']['tmp_name'];
    
	$title = $_POST['vidtitle'];
	$desc = $_POST['viddesc'];

    $video_ex = pathinfo($file, PATHINFO_EXTENSION);
    $video_ex_lc = strtolower($video_ex);
    $allowed = array('mp4','webm','avi','mov','flv');

    $new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    $video_upload_path = '../uploads/'.$new_video_name;
    move_uploaded_file($tmp, $video_upload_path);

    
	$uri = $client->upload($video_upload_path, array(
		"name" => "$title",
		"description" => "$desc",
    ));

    

    $response = $client->request($uri . '?fields=transcode.status');

    if ($response['body']['transcode']['status'] === 'complete') {
        print 'Your video finished transcoding.';
    } 
    elseif ($response['body']['transcode']['status'] === 'in_progress') {
        print 'Video Uploading Done. (your video is still processing..please try to access your video after few minutes)';
    }
    else {
	   print 'Your video encountered an error during transcoding.';
    }
    
    /*$response = $client->request($uri . '?fields=link');
    $video_link = $response['body']['link'];
    
    $get_vid_id = explode("/",$video_link);
    
    $get_vid_id = $get_vid_id['3'];

    //database insert
    
    $conectado = conectar();
   // $resultado = $conectado->query("SELECT * FROM videos WHERE id_empresa = '$_SESSION[id_usuario]'");
    $sentenciaSQL=$conn->prepare("INSERT INTO videos (id_curso,id_empresa,titulo_video,descripcion,video_id,miniatura) VALUES (?,?,?,?,?,?);");
    $sentenciaSQL->bind_param("iissss", 1,1,'$title','$desc','$get_vid_id','1.png');
    $sentenciaSQL->execute();

    if($sentenciaSQL){
        echo "data inserted";
    }
    else{
        echo mysqli_error($connection);
    }*/


}

?>