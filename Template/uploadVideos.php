<?php
session_start();
include '../config.php';//BD

require 'config.php'; //config de vimeo
require '../vendor/autoload.php';
use Vimeo\Vimeo;

$client = new Vimeo($clientId, $clientSecret, $accessToken);

$response = $client->request('/tutorial', array(), 'GET');
//echo '<pre>';
//print_r($response);
$file = $_FILES['file1'];
$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];

$dir = dirname(__DIR__ . 1) . '\uploads' . "\\" . $fileName;

/*if(file_exists($dir)){
    echo "El archivo ya existe";
    $uri = $client->upload("$dir", array(
        "name" => "Untitled",
        "description" => "The description goes here."
    ));
}else{
    move_uploaded_file($fileTmpName, "../uploads/".$fileName);
    if(file_exists($dir)){
        echo "El archivo no existia y se subio correctamente";
        $uri = $client->upload("$dir", array(
            "name" => "Untitled",
            "description" => "The description goes here."
        ));
    }
}*/


/*$uri = $client->upload("$fileTmpName", array(
    "name" => "Untitled",
    "description" => "The description goes here."
));*/

/*move_uploaded_file($fileTmpName, "../uploads/".$fileName);
//obtengo la ruta del archivo
$filePath = "C:/xampp/htdocs/pablo/uploads/".$fileName;
echo $filePath;

$uri = $client->upload("$filePath", array(
    "name" => "Untitled",
    "description" => "The description goes here."
));*/

/*$file_name = '$fileName';
$uri = $client->upload("$fileTmpName", array(
  "name" => "Untitled",
  "description" => "The description goes here."
));*/

if(isset($_POST['upload-btn'])){
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
    $id_curso = $_SESSION['id_curso'];
    $id_empresa = $_SESSION['id_empresa'];

    $id_profesor = $_SESSION['id_profesor'];

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
    
    if($sentenciaSQL){
        header ('Location: /pablo/Template/profesor/verVideos.php');
    }
    else{
        echo mysqli_error($conn);
    }



}

?>