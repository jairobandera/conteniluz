<?php
session_start();
include '../config.php';//BD

/*require 'config.php'; //config de vimeo
require_once '../vendor/autoload.php';
use Vimeo\Vimeo;*/

if(isset($_POST['upload-btn'])){

    //$descripcion = $_POST['viddesc'];
    $titulo = $_POST['vidtitle'];
    //$file = $_POST['file1'];
    $precio = $_POST['precio'];
    $id_usuario = $_POST['id_usuario'];

    $conn = conectar();
    $id_profesor = $_SESSION['id_profesor'];
    $id_empresa = $_SESSION['id_empresa_profesor'];
    echo $id_empresa;

    $file = $_FILES['file1'];
    $fileName = $_FILES['file1']['name'];
    //$fileTmpName = $_FILES['file1']['tmp_name'];
    //$fileSize = $_FILES['file1']['size'];

    //$sentenciaSQL = $conn->query("INSERT INTO videos (id_usuario,id_curso,id_empresa,id_video,titulo_video,descripcion,miniatura) VALUES (2,4,$id_empresa,'$link','$titulo','$descripcion','1.png')");
    $sentenciaSQL = $conn->query("INSERT INTO cursos (id_empresa,id_profesor,titulo_curso,miniatura,precio) VALUES ($id_empresa,$id_profesor,'$titulo','$fileName',$precio)");

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