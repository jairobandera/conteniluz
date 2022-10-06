<?php
include '../../config.php';//BD
session_start();
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
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul>
						<li> <a href="cursos.php"><i class="bx bx-right-arrow-alt"></i>Ver Cursos</a>
						</li>
						<li> <a href="pagos.php"><i class="bx bx-right-arrow-alt"></i>Pagos</a>
						</li>
						<li><a href="../cerrar.php"><i class="bx bx-right-arrow-alt"></i>Cerrar Sesion</a></li>
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
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_profesor']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_profesor']; ?></p>
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
								<h2> + Nuevo curso</h2>
									<div class="card-body">
										<form action="../upload.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Titulo</h6>
												</div>
												<div class="col-sm-9">
													<input type="hidden" name="id_usuario" class="form-control" value="<?php echo $id_usuario; ?>"/>
													<input type="text" name="vidtitle" class="form-control" placeholder="Ingrese el titulo" />
												</div>
											</div>
											<!--<div class="input-group mb-3">
												<div class="col-sm-3">
													<label style="border:none; background-color:transparent; margin-left:-10px; !important" class="input-group-text" for="inputGroupSelect01"><h6>Moneda</h6></label>
												</div>
												<div class="col-sm-1" style="margin-left:6px;">
													<select name="moneda" class="form-control" id="inputGroupSelect01" style="background-color:rgb(0 0 0 / 15%); !important">
														<option value="pesos" selected>$</option>
														<option value="dolares">USD</option>
													</select>
												</div>
											</div>-->
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Precio en pesos</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="precioPesos" class="form-control" placeholder="$" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Precio en dolares</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="precioDolares" class="form-control" placeholder="USD" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Duracion del curso</h6>
												</div>
												<div class="col-sm-9">
													<input type="number" min="1"  name="duracion" class="form-control" placeholder="3 Meses" required />
												</div>
											</div>
											<div class="mb-3">
												<h6 for="inputProductDescription" class="form-label">Miniatura</h6>
												<input class="form-control" type="file" name="file1" accept="jpg" multiple>
											</div>
											<button type="submit" name="upload-btn" class="btn btn-success"><i class=""></i>+Agregar</button>
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