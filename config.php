<?php

//ruta raiz del proyecto
define('ROOT', dirname(__FILE__));
//ROOT + carpeta imagenes
define('RUTAEMPRESAS', ROOT . '\uploads\empresas' . "\\");
define('RUTACURSOS', ROOT . '\uploads\cursos' . "\\");
define('RUTAVIDEOSMINIATURAS', ROOT . '\uploads\videos\miniaturas' . "\\");
define('RUTAVIDEOS', ROOT . '\uploads\videos' . "\\");


define("PAIS", "Argentina");


function conectar(){
  $host = "localhost";
  $usuario = "root";
  $contrasenia = "";
  $base_de_datos = "pablo";


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

  // Output the "capital" object inside "location"
  //echo $api_result['location']['capital'];
 // var_dump($api_result['location']);
  isset($api_result['country_name']) ? $pais = $api_result['country_name'] : $pais = "Argentina";
  return $pais;
}


?>