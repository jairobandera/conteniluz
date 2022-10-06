<?php
//session_start();
/*require '../config.php';
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
    require '../validarUsuario.php';
    tipo($usuario, $password);
        /*$sql = "SELECT MAX(id) AS id FROM usuario";
        $resultado = $conectado->query($sql);
        $id = $resultado->fetch_assoc();
        $id_usuario = $id['id'];
       $sql = $conectado->query("INSERT INTO alumno (id_usuario, id_curso, nombre, apellido, telefono, pago) VALUES ($id_usuario,$idCurso,'$nombre', '$apellido', '$telefono','N')");
        if($sql){
            $sql = "SELECT a.id, a.id_curso,a.nombre, a.apellido, a.telefono, u.id as idUsu, u.tipo FROM usuario AS u, alumno AS a WHERE usuario = '$usuario' AND pass = '$password' AND u.id = a.id_usuario";
                    $resultado = mysqli_query($conectado, $sql);
                    $fila = mysqli_fetch_assoc($resultado);
                    $_SESSION['id_alumno'] = $fila['id'];
                    $_SESSION['nombre_alumno'] = $fila['nombre'];
                    $_SESSION['apellido_alumno'] = $fila['apellido'];
                    $_SESSION['telefono'] = $fila['telefono'];
                    $_SESSION['id_usuario'] = $fila['idUsu'];
                    $_SESSION['tipo'] = $fila['tipo'];
                    require '../validarUsuario.php';
                    tipo($usuario, $password);
        }
    }else{
        header('Location: register.php');
    }
    
    /*$_SESSION['usuario'] = $usuario;
    header ('Location: ../MercadoPago/index.php');
}*/


?>