<?php
session_start();
require '../config.php';
$conectado = conectar();

if(isset($_POST['registrar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $idCurso = $_POST['idCurso'];
    $idEmpresa = $_POST['idEmpresa'];
    $password = md5($password);
    
    $newUsuario = $conectado->query("INSERT INTO usuario (usuario, pass, tipo) VALUES ('$usuario', '$password', 'USUARIO')");
    if($newUsuario){
        /*Si se registro correctamente el usuario*/
        /*Inserto datos alumno*/
          /*obtener ultimo id de la tabla usuario*/
        $sql = "SELECT MAX(id) AS id FROM usuario";
        $resultado = $conectado->query($sql);
        $id = $resultado->fetch_assoc();
        $id_usuario = $id['id'];
        $resultado = $conectado->query("INSERT INTO alumno (id_curso, id_empresa, id_usuario, nombre, apellido, telefono) VALUES ($idCurso,$idEmpresa,$id_usuario,'$nombre', '$apellido', '$telefono')");
    }else{
        return;
    }
    
    $_SESSION['usuario'] = $usuario;
    header ('Location: ../MercadoPago/index.php');
}


?>