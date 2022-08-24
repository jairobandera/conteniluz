<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location: http://localhost/pablo/Template/login.php');

?>