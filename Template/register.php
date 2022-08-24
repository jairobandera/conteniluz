<?php
session_start();
$_SESSION['pagar'] = true;

if(isset($_GET['id_curso'])){
    $id_curso = $_GET['id_curso'];
    $id_empresa = $_GET['id_empresa'];
	$precio = $_GET['precio'];
	$titulo = $_GET['titulo'];
}

if(isset($_SESSION['pagar']) AND $_SESSION['pagar'] == 1 AND isset($_SESSION['tipo']) AND $_SESSION['tipo'] == 'USUARIO'){
	$id_curso = $_GET['id_curso'];
    $id_empresa = $_GET['id_empresa'];
	$precio = $_GET['precio'];
	$titulo = $_GET['titulo'];
	header('Location: ../MercadoPago/index.php?id_curso='.$id_curso.'&id_empresa='.$id_empresa.'&precio='.$precio.'&titulo='.$titulo);
}

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
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="my-4 text-center">
							<img src="../assets/assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">REGISTRATE</h3>
										<p>Ya tienes una cuenta? <a href="login.php">Inisiar Sesion</a>
										</p>
									</div>
									<div class="form-body">
										<form class="row g-3" action="validarRegistro.php" method="post">
                                            <div class="col-sm-6">
												<input type="hidden" name="idCurso" value="<?php echo $id_curso ?>" class="form-control" id="inputIdCurso">
											</div>
                                            <div class="col-sm-6">
												<input type="hidden" name="idEmpresa" value="<?php echo $id_empresa ?>" class="form-control" id="inputIdEmpresa">
											</div>

											<div class="col-sm-6">
												<label for="inputFirstName" class="form-label">Primer Nombre</label>
												<input type="text" name="nombre" class="form-control" id="inputFirstName" placeholder="Jhon">
											</div>
											<div class="col-sm-6">
												<label for="inputLastName" class="form-label">Primer Apellido</label>
												<input type="text" name="apellido" class="form-control" id="inputLastName" placeholder="Deo">
											</div>
                                            <div class="col-sm-6">
												<label for="inputLastPhone" class="form-label">Telefono</label>
												<input type="text" name="telefono" class="form-control" id="inputLastPhone" placeholder="+598 xxx">
											</div>
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Usuario</label>
												<input type="text" name="usuario" class="form-control" id="inputEmailAddress" placeholder="Ingrese su usuario">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" name="registrar" class="btn btn-light"><i class='bx bx-user'></i>Registrarse</button>
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
</body>

</html>