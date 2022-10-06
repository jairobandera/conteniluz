<?php
include '../../../config.php';//BD
$conn = conectar();

//Eliminar cursos   
if(isset($_GET['id_curso']) and isset($_GET['id_empresa'])){
    $idCurso = $_GET['id_curso'];
    $idEmpresa = $_GET['id_empresa'];

    $sentenciaSQL = $conn->query("DELETE FROM cursos WHERE id = $idCurso");
    if($sentenciaSQL){
        header ('Location: verCursos.php?id_empresa='.$idEmpresa);
    }
    else{
        echo mysqli_error($conn);
    }
}