<?php
session_start();
include '../../../config.php';//BD
$conn = conectar();

if(isset($_GET['id_empresa'])){
    $idEmpresa = $_GET['id_empresa'];

    //Si existe la empresa la elimino
    $sentenciaSQL = $conn->query("DELETE FROM empresa WHERE id = $idEmpresa");
    if($sentenciaSQL){
        header ('Location: ../admin.php');
    }
    else{
        echo mysqli_error($conn);
    }

    
}


?>