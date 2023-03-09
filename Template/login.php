<?php
session_start();

if(isset($_SESSION['habilitarCrearCuenta']) AND $_SESSION['habilitarCrearCuenta'] == true){
    $habilitarCrearCuenta = true;
    unset($_SESSION['habilitarCrearCuenta']);
}else{
    $habilitarCrearCuenta = false;
}

if(isset($_SESSION['precio'])){
    $precio = $_SESSION['precio'];
}

if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo'] == 'ADMIN'){
		header('Location: admin/admin.php');
	}else if($_SESSION['tipo'] == 'USUARIO'){
			//header('Location: alumno/index.php?id_empresa='.$id_empresa);
            echo '<script>window.location.href = "alumno/index.php";</script>';
	}else if($_SESSION['tipo'] == 'PROFESOR'){
			//header('Location: profesor/index.php');
            echo '<script>window.location.href = "profesor/index.php";</script>';
	}else{
			//header('Location: index.php');
            echo '<script>window.location.href = "index.php";</script>';
	}
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/assets/images/icono.png" type="image/png" />
    <!-- loader-->
    <link href="../assets/assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../assets/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!--Seet alert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/jsSweetAlert/sa.js"></script>
    <!--Jquery-->
    <script src="../assets/assets/js/jquery.min.js"></script>

    <link href="../assets/assets/css/app.css" rel="stylesheet">
    <link href="../assets/assets/css/icons.css" rel="stylesheet">
    <title>Iniciar sesion</title>
</head>

<body class="bg-theme bg-theme2">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <!--<img src="../assets/assets/images/logo-img.png" width="180" alt="" />-->
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Identifícate</h3>
                                        <img src="../assetsNuevo/iconos/huella.gif" width="50%" height="">
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="../validarUsuario.php">
                                            <div class="col-12">
                                                <label for="inputEmailAddress" style="font-size:25px;" class="form-label"><img src="../assetsNuevo/iconos/usuario.gif" width="50px" height="50px"><b>USUARIO</b></label>
                                                <input type="text" class="form-control" id="usuario" name="usuario"
                                                    placeholder="Ingrese su usuario" autocomplete="off">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" style="font-size:25px;" class="form-label"><img src="../assetsNuevo/iconos/pass.gif" width="50px" height="50px"><b>Password</b></label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="password" name="password" placeholder="Enter Password"
                                                        autocomplete="off"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <?php if($habilitarCrearCuenta == true){ 
                                                    echo '<a href="register.php" style="text-align:center;"><h3>Crear una cuenta</h3></a>'; 
                                                } ?>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <?php 
                                                        if(isset($_SESSION['error'])){
                                                            echo '<script>alertaLogin();</script>';                                                            
                                                            echo '<div class="alert alert-danger" style="color:red;" role="alert">'.$_SESSION['error'].'</div>';
                                                            unset($_SESSION['error']);
                                                            unset($_SESSION['success']);
                                                        }
                                                    ?>
                                                    <button type="submit" name="login" class="btn btn-light"><img src="../assetsNuevo/iconos/candado.gif" width="30px" height="">Inisiar sesion</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="../" class="btn btn-light"><img src="../assetsNuevo/iconos/exit.gif" width="30px" height="">Pagina princial</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!--Password show & hide js -->
    <script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
    </script>

</body>

</html>