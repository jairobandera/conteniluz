<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../../login.php";</script>';
}

$id_usuario = $_SESSION['id_usuario'];	

include 'Template/head.php';

include '../../../config.php';//BD
$conn = conectar();
//traigo las empresas	
/*$sql = "SELECT * FROM empresa";
$result = $conn->query($sql);
$empresas = $result->fetch_all(MYSQLI_ASSOC);*/

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
					<a href="javascript:;" class="has-arrow" aria-expanded="true">
						<div class="parent-icon"><img src="../../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
                        <li> <a href="../admin.php"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height="">Ver Empresas</a>
						</li>
						<li> <a href="../pagos.php"><img src="../../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="../usuarios.php"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Cuentas</a>
						</li>
						<li><a href="../../cerrar.php"><img src="../../../assetsNuevo/iconos/exit2.gif" width="40px" height="">Cerrar Sesion</a></li>
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
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
						<img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
							<li class="nav-item dropdown dropdown-large">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_admin']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_admin']; ?></p>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									</div>
								</div>
							</li>
						</ul>
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
								<h2><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Nueva cuenta</h2>
									<div class="card-body">
										<form action="acciones/crud.php" method="POST" enctype="multipart/form-data">
								
										<div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Nombre</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="nombrePersona" class="form-control" placeholder="Ingrese un nombre" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Apellido</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="apellidoPersona" class="form-control" placeholder="Ingrese un apellido" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Telefono</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="telefonoPersona" class="form-control" placeholder="xxx xxx xxxx" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/cuentas2.gif" width="40px" height=""> Usuario</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="usuarioPersona" class="form-control" placeholder="Ingrese el usuario" />
											</div>
										</div>
                                        <div class="row mb-3">  
											<div class="col-sm-3">
												<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height=""> Contraseña</h6>
											</div>
											<div class="col-sm-9">
												<input type="text" name="passPersona" class="form-control" placeholder="***" />
											</div>
										</div>
                                        <div class="input-group mb-3">
											<label class="input-group-text" for="tipoPersona"><h6><img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height=""> Tipo</h6></label>
											<select name="tipoPersona" class="form-select" id="tipoPersona" style="background-color:rgb(0 0 0 / 15%); !important" onchange="habilitarPersona();">							
												<option  value="PROFESOR" selected>Profesor</option>
												<option value="USUARIO">Usuario</option>	
                                                <option value="ADMIN">Administrador</option>												
											</select>
										</div>

										<div class="input-group mb-3">
											<label class="input-group-text" for="tipoCurso" id="labelCurso"><h6><img src="../../../assetsNuevo/iconos/cursos2.gif" width="40px" height=""> Curso</h6></label>
											<select name="tipoCurso" class="form-select" id="tipoCurso" style="background-color:rgb(0 0 0 / 15%); !important">							
												<option  value="sinCurso" selected>Seleccione un curso</option>
												<?php foreach($cursos as $curso): ?>)
													<option value="<?php echo $curso['id']; ?>"><?php echo $curso['titulo_curso']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>										
										<button type="submit" name="agregarCuentas-btn" class="btn btn-success"><img src="../../../assetsNuevo/iconos/ok2.gif" width="40px" height=""> Agregar</button>
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