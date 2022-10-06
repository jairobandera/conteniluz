<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];	

include 'Template/head.php';

include '../../../config.php';//BD
$conn = conectar();
//traigo las empresas	
$sql = "SELECT * FROM empresa";
$result = $conn->query($sql);
$empresas = $result->fetch_all(MYSQLI_ASSOC);

//traigo los cursos
$sql = "SELECT * FROM cursos";
$result = $conn->query($sql);
$cursos = $result->fetch_all(MYSQLI_ASSOC);
?>

<body class="bg-theme bg-theme2" onload="habilitarPersona()">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../../../assets/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Conteniluz</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul>
                        <li> <a href="../admin.php"><i class="bx bx-right-arrow-alt"></i>Ver Empresas</a>
						</li>
						<li> <a href="../pagos.php"><i class="bx bx-right-arrow-alt"></i>Pagos</a>
						</li>
                        <li> <a href="../usuarios.php"><i class="bx bx-right-arrow-alt"></i>Ver Cuentas</a>
						</li>
						<li><a href="../../cerrar.php"><i class="bx bx-right-arrow-alt"></i>Cerrar Sesion</a></li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<!--<img src="../../assets/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">-->	
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_admin']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_admin']; ?></p>
							</div>
						</a>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-8">
								<div class="card">
								<h2> + Nueva cuenta</h2>
									<div class="card-body">
										<form action="acciones/crud.php" method="POST" enctype="multipart/form-data">
								
										<div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0">Nombre</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="nombrePersona" class="form-control" placeholder="Ingrese un nombre" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0">Apellido</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="apellidoPersona" class="form-control" placeholder="Ingrese un apellido" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0">Telefono</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="telefonoPersona" class="form-control" placeholder="xxx xxx xxxx" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0">Usuario</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="usuarioPersona" class="form-control" placeholder="Ingrese el usuario" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0">Contraseña</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="passPersona" class="form-control" placeholder="***" />
											</div>
										</div>
                                        <div class="input-group mb-3">
											<label class="input-group-text" for="tipoPersona"><h6>Tipo</h6></label>
											<select name="tipoPersona" class="form-select" id="tipoPersona" style="background-color:rgb(0 0 0 / 15%); !important" onchange="habilitarPersona();">							
												<option  value="PROFESOR" selected>Profesor</option>
												<option value="USUARIO">Usuario</option>	
                                                <option value="ADMIN">Administrador</option>												
											</select>
										</div>

										<div class="input-group mb-3">
											<label class="input-group-text" for="tipoEmpresa" id="labelEmpresa"><h6>Empresa</h6></label>
											<select name="tipoEmpresa" class="form-select" id="tipoEmpresa" style="background-color:rgb(0 0 0 / 15%); !important">							
												<option  value="sinEmpresa" selected>Selecione una empresa</option>	
												<?php foreach($empresas as $empresa): ?>)
													<option value="<?php echo $empresa['id']; ?>"><?php echo $empresa['nombre_empresa']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>

										<div class="input-group mb-3">
											<label class="input-group-text" for="tipoCurso" id="labelCurso"><h6>Curso</h6></label>
											<select name="tipoCurso" class="form-select" id="tipoCurso" style="background-color:rgb(0 0 0 / 15%); !important">							
												<option  value="sinCurso" selected>Seleccione un curso</option>
												<?php foreach($cursos as $curso): ?>)
													<option value="<?php echo $curso['id']; ?>"><?php echo $curso['titulo_curso']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
											
											<button type="submit" name="agregarCuentas-btn" class="btn btn-success"><i class=""></i>+Agregar</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
include 'Template/footer.php';
?>