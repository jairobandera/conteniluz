
<?php
session_start();
include '../config.php';//BD


if(isset($_GET['id_curso'])){
    $conn = conectar();

   $conn->query("DELETE FROM cursos WHERE id = ".$_GET['id_curso']);

   header ('Location: /pablo/Template/profesor/cursos.php');
}

?>