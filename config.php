<?php

//ruta raiz del proyecto
define('ROOT', dirname(__FILE__));
//ROOT + carpeta imagenes
define('RUTAEMPRESAS', ROOT . '\uploads\empresas' . "\\");
define('RUTACURSOS', ROOT . '\uploads\cursos' . "\\");
define('RUTAVIDEOSMINIATURAS', ROOT . '\uploads\videos\miniaturas' . "\\");
define('RUTAVIDEOS', ROOT . '\uploads\videos' . "\\");

//Para servidor
/*define('ROOT', $_SERVER['DOCUMENT_ROOT']);
//ROOT + carpeta imagenes
define('RUTAEMPRESAS', ROOT . '/uploads/empresas/');
define('RUTACURSOS', ROOT . '/uploads/cursos/');
define('RUTAVIDEOSMINIATURAS', ROOT . '/uploads/videos/miniaturas/');
define('RUTAVIDEOS', ROOT . '/uploads/videos/');*/


define("PAIS", "Argentina");


function conectar(){
  //7muDZ5|QOiSWki|P
 // -}3BM(sM&%H_K)}t InstituZion
  //jairo
  //conteniluz
  $host = "localhost";
  $usuario = "root";
  $contrasenia = "";
  $base_de_datos = "pablo";
   /*$host = "localhost";
  $usuario = "id20164586_pablo";
  $contrasenia = "-}3BM(sM&%H_K)}t";
  $base_de_datos = "id20164586_instituzion";*/

 /*$host = "localhost";
  $usuario = "id19696295_jairo";
  $contrasenia = "7muDZ5|QOiSWki|P";
  $base_de_datos = "id19696295_conteniluz";*/


  $conn = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
  

  if ($conn->connect_errno) {
    echo "Falló la conexión a MySQL". mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
    error_log("You messed up!", 3, "errors.log");
    die;
  }else{

  }
  return $conn;
}

function desconectar($conn){
  $conn->close();
}

function geoLocalizacion(){
    $access_key = '8d222a82f44245c1c9c053915d083469';
    //$access_key = '6ac927af579cd91ad7507f5d9eb89e1d';
    //$ip = $_SERVER['REMOTE_ADDR'];
    //echo $ip;
    // Initialize CURL:
    $ch = curl_init('http://api.ipstack.com/check?access_key='.$access_key.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);
  
    // Decode JSON response:
    $api_result = json_decode($json, true);
  
    //isset($api_result['country_name']) ? $pais = $api_result['country_name'] : $pais = "Argentina";
    return $api_result['country_name'];
  }
  
  //comprobar si existe cookie pais
  if(!isset($_COOKIE['pais'])){
    //si no existe cookie pais, crearla por 1 año
      setcookie("pais", geoLocalizacion(), time() + (86400 * 365), "/");
  }

/*function geoLocalizacion(){
  //$access_key = '8d222a82f44245c1c9c053915d083469';
  $access_key = '6ac927af579cd91ad7507f5d9eb89e1d';
  $ip = $_SERVER['REMOTE_ADDR'];
  //echo $ip;
  // Initialize CURL:
  $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // Store the data:
  $json = curl_exec($ch);
  curl_close($ch);

  // Decode JSON response:
  $api_result = json_decode($json, true);

  //isset($api_result['country_name']) ? $pais = $api_result['country_name'] : $pais = "Argentina";
  return $api_result['country_name'];
}

//comprobar si existe cookie pais
if(!isset($_COOKIE['pais'])){
  //si no existe cookie pais, crearla por 1 año
    setcookie("pais", geoLocalizacion(), time() + (86400 * 365), "/");
}*/
?>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
