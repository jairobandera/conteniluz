<?php
//obtengo dato axios POST
$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if(is_array($datos)){
    if(!isset($_COOKIE['pais'])){
        setcookie("pais", $datos['pais'], time() + (365 * 24 * 60 * 60 * 1000), "/");
    }
}
