<?php
session_start();
include '../../config.php';
$conectado = conectar();

//recoger datos del form si se ha enviado
if(isset($_POST['submit'])){
    $clientIdPaypal = isset($_POST['clientIdPaypal']) ? $_POST['clientIdPaypal'] : null;
    $keyTokenPaypal = isset($_POST['keyTokenPaypal']) ? $_POST['keyTokenPaypal'] : null;
    $accessTokenMp = isset($_POST['accessTokenMp']) ? $_POST['accessTokenMp'] : null;

    $idEmpresaUsuario = explode("-", $_POST['idEmpresaUsuario']);
    $idEmpresa = $idEmpresaUsuario[0];
    $idUsuario = $idEmpresaUsuario[1];

    //si todo es distino de null
    if($clientIdPaypal != null && $keyTokenPaypal != null && $accessTokenMp != null){
        
        //inserto datos de paypal en la tabla paypal
        $sql = "INSERT INTO paypal (id_usuario,id_empresa,client_id_paypal,currency,key_token,moneda) VALUES ($idUsuario, $idEmpresa, '$clientIdPaypal', 'USD', '$keyTokenPaypal', 'USD')";
        $conectado->query($sql);

        //inserto datos de mercado pago en la tabla mercadopago
        $sql = "INSERT INTO mercadopago (id_usuario,id_empresa,access_token) VALUES ($idUsuario, $idEmpresa, '$accessTokenMp')";
        $conectado->query($sql);

        //redirecciono a la pagina de inicio
        $clientIdPaypal = null;
        $keyTokenPaypal = null;
        $accessTokenMp = null;
        echo '<script>window.location.href = "mpp.php";</script>';

    }
}
?>