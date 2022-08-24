<?php
session_start();
include 'config.php';

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conectado = conectar();
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND pass = '$password'";
        $resultado = mysqli_query($conectado, $sql);
        if ($resultado) {
            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);
                $_SESSION['usuario'] = $fila['usuario'];
                $_SESSION['tipo'] = $fila['tipo'];
                $_SESSION['id_usuario'] = $fila['id'];
                //desconectar($conectado);

            if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'USUARIO'){
                header('Location: MercadoPago/index.php');
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
            }

            
        }
    }
}


?>