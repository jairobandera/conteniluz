<?php
session_start();
include '../../../config.php';//BD
$conn = conectar();

if(isset($_GET['id_empresa'])){
    $idEmpresa = $_GET['id_empresa'];

    //Si existe la empresa la elimino
    $sentenciaSQL = $conn->query("DELETE FROM empresa WHERE id = $idEmpresa");
    if($sentenciaSQL){

        if(!isset($_SESSION['success']) OR !isset($_SESSION['error'])){
            $_SESSION['success'] = 'Empresa elimiada correctamente';
            header ('Location: ../admin.php');
        }else{
            $_SESSION['error'] = 'Error al eliminar la empresa';
            header ('Location: ../admin.php');
        }
    }
    else{
        echo mysqli_error($conn);
    }

    
}


?>