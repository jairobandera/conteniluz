<?php
session_start();


if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'USUARIO'){
	header('Location: ../MercadoPago/index.php');
}else if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'PROFESOR'){
	echo '<script>alert("Ingrese como alumno");</script>';
}else if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'ADMIN'){
	echo '<script>alert("Ingrese como alumno");</script>';
}else{
	if(isset($_SESSION['tipo'])){
		if($_SESSION['tipo'] == 'ADMIN'){
			header('Location: admin/index.php');
		}else if($_SESSION['tipo'] == 'USUARIO'){
				header('Location: alumno/index.php');
		}else if($_SESSION['tipo'] == 'PROFESOR'){
				header('Location: profesor/index.php');
		}else{
				header('Location: index.php');
		}
	}
}
/*if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo'] == 'ADMIN'){
		header('Location: admin/index.php');
	}else if($_SESSION['tipo'] == 'USUARIO'){
			header('Location: alumno/index.php');
	}else if($_SESSION['tipo'] == 'PROFESOR'){
			header('Location: profesor/index.php');
	}else{
			header('Location: index.php');
	}
}*/


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/assets/images/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="../assets/assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../assets/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../assets/assets/css/app.css" rel="stylesheet">
    <link href="../assets/assets/css/icons.css" rel="stylesheet">
    <title>Dashtrans - Bootstrap5 Admin Template</title>
</head>

<body class="bg-theme bg-theme2">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="../assets/assets/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="../validarUsuario.php">
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Usuario</label>
                                                <input type="text" class="form-control" id="usuario" name="usuario"
                                                    placeholder="Ingrese su usuario" autocomplete="off">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="password" name="password" placeholder="Enter Password"
                                                        autocomplete="off"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light"><i
                                                            class="bx bxs-lock-open"></i>Sign in</button>
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



    <!--plugins-->
    <script src="../assets/assets/js/jquery.min.js"></script>
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