<?php
session_start();
include 'config.php';

if(isset($_POST['login'])){//viene del login
    /*Creo nuevo usuario*/
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
    
        comprobarUsuario($usuario, $password);
        tipo();
    }
    }else if(isset($_POST['registrar']) AND isset($_SESSION['id_empresa'])){//viene del registrar nuevo usuario
    $conectado = conectar();
    $_SESSION['nombre_alumno'] = $nombre = $_POST['nombre'];
    $_SESSION['apellido_alumno'] = $apellido = $_POST['apellido'];
    $_SESSION['telefono'] = $telefono = $_POST['telefono'];
    $_SESSION['usuario'] = $usuario = $_POST['usuario'];
    $_SESSION['password'] = $password = $_POST['password'];
    $idCurso = $_POST['idCurso'];
    $idEmpresa = $_POST['idEmpresa'];
    $password = md5($password);
    //Comprobar si existe ese nombre de usuario
    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND pass = '$password'";
    $resultado = mysqli_query($conectado, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            //ese usuario existe
            if(!isset($_SESSION['error'])){
                $_SESSION['error'] = 'El usuario ya existe';
                header('Location: Template/register.php');
            }else{
                $_SESSION['error'] = 'El usuario ya existe';
                header('Location: Template/register.php');
            }
        }else{
            $_SESSION['error'] = '';
            //Si no exisre lo creo        
            $newUsuario = $conectado->query("INSERT INTO usuario (usuario, pass, tipo,nombre,apellido,telefono) VALUES ('$usuario', '$password', 'USUARIO','$nombre','$apellido','$telefono')");
            $id_curso = $_SESSION['id_curso'];
            $_SESSION['tipo'] = 'USUARIO';
            validarAlumnoCurso($usuario, $password, $id_curso);
            //desconectar($conectado);
            if(!$newUsuario){
                header('Location: Template/register.php');
            }else{
                //tipo();
            }
        }
}else{
    if(isset($_SESSION['id_curso']) AND isset($_SESSION['id_empresa']) AND isset($_SESSION['titulo']) AND isset($_SESSION['precio'])){
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        $id_curso = $_SESSION['id_curso'];
        $id_empresa = $_SESSION['id_empresa'];

        comprobarUsuario($usuario, $password);
        validarAlumnoCurso($usuario, $password, $id_curso);
    }
   
}
    
function tipo(){
    $conectado = conectar();
    if(isset($_SESSION['tipo'])){
        if($_SESSION['tipo'] == 'ADMIN'){
            $usuario = $_POST['usuario'];
            $password = md5($_POST['password']);
            $sql = "SELECT u.id, u.nombre, u.apellido, u.telefono FROM usuario AS u WHERE usuario = '$usuario' AND pass = '$password'";
            $resultado = mysqli_query($conectado, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            $_SESSION['id_admin'] = $fila['id'];
            $_SESSION['nombre_admin'] = $fila['nombre'];
            $_SESSION['apellido_admin'] = $fila['apellido'];
            header('Location: Template/admin/admin.php');
        }else if($_SESSION['tipo'] == 'USUARIO'){
            $usuario = $_POST['usuario'];
            $password = md5($_POST['password']);
            $sql = "SELECT u.id, u.nombre, u.apellido, u.telefono, a.id AS idAlumno FROM usuario AS u, alumno AS a WHERE usuario = '$usuario' AND pass = '$password'";
            $resultado = mysqli_query($conectado, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            $_SESSION['id_alumno'] = $fila['idAlumno'];
            $_SESSION['nombre_alumno'] = $fila['nombre'];
            $_SESSION['apellido_alumno'] = $fila['apellido'];
            $_SESSION['telefono'] = $fila['telefono'];
            header('Location: Template/alumno/index.php');
        }else if($_SESSION['tipo'] == 'PROFESOR'){
            $usuario = $_POST['usuario'];
            $password = md5($_POST['password']);
            $sql = "SELECT u.id, u.nombre, u.apellido, u.telefono, e.id AS id_empresa, p.id as idProfesor FROM usuario AS u, profesor AS p, empresa AS e WHERE usuario = '$usuario' AND pass = '$password'";
            $resultado = mysqli_query($conectado, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            $_SESSION['id_profesor'] = $fila['idProfesor'];
            $_SESSION['id_empresa_profesor'] = $fila['id_empresa'];
            $_SESSION['nombre_profesor'] = $fila['nombre'];
            $_SESSION['apellido_profesor'] = $fila['apellido'];
            header('Location: Template/profesor/index.php');
        }else{
                header('Location: Template/register.php');
        }
    }
    desconectar($conectado);
}

function validarAlumnoCurso($usuario, $password,$id_curso){
    //Compruebo si ese usuario tiene un alumno
    $conectado = conectar();
    if($id_curso != 0){
        $sql = "SELECT * FROM usuario AS u, alumno AS a WHERE a.id_usuario = u.id AND u.usuario = '$usuario'
        AND u.pass = '$password' AND a.id_curso = '$id_curso'";
        $resultado = mysqli_query($conectado, $sql);
    }else{
        //echo 'entro aca';
       /* $sql = "SELECT * FROM usuario AS u, alumno AS a WHERE a.id_usuario = u.id AND u.usuario = '$usuario'
        AND u.pass = '$password'";
        $resultado = mysqli_query($conectado, $sql);
        $_SESSION['error'] = 'Debe elejir un curso';
        header('Location: index.php');*/
    }
    

    if (mysqli_num_rows($resultado) > 0) {//quiere decir que si tiene un alumno
        $sql = "SELECT a.id, a.id_curso,u.nombre, u.apellido, u.telefono, u.id AS idUsu, u.tipo FROM usuario AS u, alumno AS a 
        WHERE u.usuario = '$usuario' AND u.pass = '$password' AND u.id = a.id_usuario";
            $resultado = mysqli_query($conectado, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);
                $_SESSION['id_alumno'] = $fila['id'];
                $_SESSION['nombre_alumno'] = $fila['nombre'];
                $_SESSION['apellido_alumno'] = $fila['apellido'];
                $_SESSION['telefono'] = $fila['telefono'];
                $_SESSION['id_usuario'] = $fila['idUsu'];
                $_SESSION['tipo'] = $fila['tipo'];
                desconectar($conectado);
                $id_empresa = $_SESSION['id_empresa'];
                header('Location: Template/cursos.php?id_empresa='.$id_empresa);
                
            }else{
            //echo $fila['id'];
        }   
    }else{//quiere decir que no tiene un alumno
        //Creo al alumno
        $sql = "SELECT MAX(id) AS id FROM usuario";
        $resultado = $conectado->query($sql);
        $id = $resultado->fetch_assoc();
        $id_usuario = $id['id'];
        $sql = $conectado->query("INSERT INTO alumno (id_usuario, id_curso, pago) VALUES ($id_usuario,$id_curso,'N')");
        if($sql){
            $sql = "SELECT a.id, a.id_curso,u.nombre, u.apellido, u.telefono, u.id AS idUsu, u.tipo FROM usuario AS u, alumno AS a 
            WHERE u.usuario = '$usuario' AND u.pass = '$password' AND u.id = a.id_usuario";
                    $resultado = mysqli_query($conectado, $sql);
                    if (mysqli_num_rows($resultado) > 0) {
                        $fila = mysqli_fetch_assoc($resultado);
                        $_SESSION['id_alumno'] = $fila['id'];
                        $_SESSION['nombre_alumno'] = $fila['nombre'];
                        $_SESSION['apellido_alumno'] = $fila['apellido'];
                        $_SESSION['telefono'] = $fila['telefono'];
                        $_SESSION['id_usuario'] = $fila['idUsu'];
                        $_SESSION['tipo'] = $fila['tipo'];
                        desconectar($conectado);
                        $id_empresa = $_SESSION['id_empresa'];
                        $concatenar = 'Location: Template/cursos.php?id_empresa='.$id_empresa;
                        header($concatenar);
                    }else{
                        //echo $id_usuario;
                    }            
        }

    }
     
}

function comprobarUsuario($usuario, $password){
    $conectado = conectar();
    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND pass = '$password'";
            $resultado = mysqli_query($conectado, $sql);
            if ($resultado) {
                if (mysqli_num_rows($resultado) > 0) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $_SESSION['usuario'] = $fila['usuario'];
                    $_SESSION['tipo'] = $fila['tipo'];
                    $_SESSION['id_usuario'] = $fila['id'];
                    desconectar($conectado);
                }else{
                    //falta hacer si no existe el usuario;
                }
    }
}




            /*if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'USUARIO'){
                $id_curso = $_SESSION['id_curso'];
                $id_empresa = $_SESSION['id_empresa'];
                $precio = $_SESSION['precio'];
                $titulo =$_SESSION['titulo'];
                header('Location: MercadoPago/index.php?id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&precio='.$precio.'&titulo='.$titulo);
            }else if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'PROFESOR'){
                header('Location: Template/login.php');
            }else if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'ADMIN'){
                header('Location: Template/login.php');
            }else{
                if($_SESSION['tipo'] == 'ADMIN'){
                    header('Location: Template/admin/index.php');
                }else if($_SESSION['tipo'] == 'USUARIO'){
                    $sql = "SELECT a.id, a.id_curso,a.nombre, a.apellido, a.telefono FROM usuario AS u, alumno AS a WHERE usuario = '$usuario' AND pass = '$password' AND u.id = a.id_usuario";
                    $resultado = mysqli_query($conectado, $sql);
                    $fila = mysqli_fetch_assoc($resultado);
                    $_SESSION['id_alumno'] = $fila['id'];
                    $_SESSION['nombre_alumno'] = $fila['nombre'];
                    $_SESSION['apellido_alumno'] = $fila['apellido'];
                    $_SESSION['telefono'] = $fila['telefono'];
                    header('Location: Template/alumno/index.php');
                }else if($_SESSION['tipo'] == 'PROFESOR'){
                    $sql = "SELECT p.id, p.nombre, p.apellido, p.telefono, p.id_empresa FROM usuario AS u, profesor AS p WHERE usuario = '$usuario' AND pass = '$password' AND u.id = p.id_usuario";
                    $resultado = mysqli_query($conectado, $sql);
                    $fila = mysqli_fetch_assoc($resultado);
                    $_SESSION['id_profesor'] = $fila['id'];
                    $_SESSION['id_empresa_profesor'] = $fila['id_empresa'];
                    header('Location: Template/profesor/index.php');
                }else{
                        header('Location: index.php');
                }
            }*/

?>