<?php
//incluyo carpeta config
//include_once '../config.php';

session_start();
$_SESSION = array();
session_destroy();
//header('Location: login.php');
echo '<script>window.location.href = "login.php";</script>';

?>