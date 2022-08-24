<?php

/* Admin */
/* brinda usuario y contraseña para acceder al profesor/alumno
compra de cursos
cuantos profesores hay y datos

Proefesor

titulo/descripcion/video/miniatura/precio


alumno

manera de comunicarse con profesor

*/

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


?>