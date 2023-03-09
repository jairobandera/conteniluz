<?php
session_start();
include '../../config.php';//BD

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
	//header("location: ../login.php");
}

$id_usuario = $_SESSION['id_usuario'];	

include 'Template/head.php';
?>

<body class="bg-theme bg-theme2">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../../assets/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
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
						<div class="parent-icon"><img src="../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
						<li> <a href="cursos.php"><img src="../../assetsNuevo/iconos/cursos2.gif" width="40px" height="">Ver Cursos</a>
						</li>
						<li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
						<li> <a href="mpp.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Configuracion</a>
						</li>
						<li><a href="../cerrar.php"><img src="../../assetsNuevo/iconos/exit2.gif" width="40px" height="">Cerrar Sesion</a></li>
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
						<img src="../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
							<li class="nav-item dropdown dropdown-large">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_profesor']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_profesor']; ?></p>
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
							<div class="col-lg-10">
								<div class="card">
								<h2><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Nuevo curso</h2>
									<div class="card-body">
										<form action="../upload.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Titulo</h6>
												</div>
												<div class="col-sm-9">
													<input type="hidden" name="id_usuario" class="form-control" value="<?php echo $id_usuario; ?>"/>
													<input type="text" name="vidtitle" class="form-control" placeholder="Ingrese el titulo" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/pesos2.gif" width="40px" height=""> Precio en pesos</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="precioPesos" class="form-control" placeholder="$" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/pesos2.gif" width="40px" height=""> Precio en dolares</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="precioDolares" class="form-control" placeholder="USD" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/reloj2.gif" width="40px" height=""> Duracion del curso</h6>
												</div>
												<div class="col-sm-9">
													<input type="number" min="1"  name="duracion" class="form-control" placeholder="3 Meses" required />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Descripcion del curso</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="cursodesc" class="form-control" rows="6" maxlength="300"></textarea>
													<!--<input type="text" name="viddesc" class="form-control" placeholder="Ingrese una descripcion" />-->
												</div>
											</div>
											<div class="mb-3">
												<h6 for="inputProductDescription" class="form-label"><img src="../../assetsNuevo/iconos/foto2.gif" width="40px" height=""> Miniatura</h6>
												<input class="form-control" type="file" name="file1" accept="jpg" multiple>
											</div>
											<button type="submit" name="upload-btn" class="btn btn-success"><img src="../../assetsNuevo/iconos/ok2.gif" width="40px" height=""> Agregar</button>
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