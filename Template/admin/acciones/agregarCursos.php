<?php
session_start();
include '../../../config.php';//BD
$conectado = conectar();

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../../login.php";</script>';
}


isset($_GET['id_empresa']) ? $id_empresa = $_GET['id_empresa'] : $id_empresa = '';

//Obtengo los datos de los profesores pertenecientes a la empresa
$sentenciaSQL = $conectado->query("SELECT p.id,p.id_usuario,p.nombre,p.nombre,p.apellido,p.telefono, e.id AS id_empresa, e.id_usuario, e.nombre_empresa, e.miniatura FROM profesor AS p, empresa AS e WHERE e.id = $id_empresa AND e.id_usuario = p.id_usuario");
$profesores = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);


include 'Template/head.php';
?>

<body class="bg-theme bg-theme2">
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
						<li> <a href="agregarEmpresas.php"><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="verCursos.php?id_empresa=<?php echo $id_empresa; ?>"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Cursos</a>
						</li>
						<li> <a href="../pagos.php"><img src="../../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="cuentas.php"><img src="../../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
						</li>
						<li> <a href="../usuarios.php"><img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">Ver Cuentas</a>
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
							<div class="col-lg-10">
								<div class="card">
								<h2><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Nuevo curso</h2>
									<div class="card-body">
										<form action="acciones/crud.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height=""> Id Empresa</h6>
												</div>
												<div class="col-sm-9">
													<input type="text" name="idEmpresa" class="form-control" value="<?php echo $id_empresa; ?>" readonly/>
												</div>
											</div>
											<div class="input-group mb-3">
												<label class="input-group-text" for="inputGroupSelect01"><h6><img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">Profesor</h6></label>
												<select name="idProfesor" class="form-control" id="inputGroupSelect01" style="background-color:rgb(0 0 0 / 15%); !important">
													<?php foreach ($profesores as $profesor) { ?>
														<?php if($usuario === 1){ ?>
															<option style="background-color:grey !important"  value="<?php echo $profesor['id']; ?>" selected><?php echo $profesor['nombre']; ?></option>
															<?php }else{ ?>
																<option style="background-color:grey !important" value="<?php echo $profesor['id']; ?>"><?php echo $profesor['nombre']; ?></option>
															<?php } ?>
														<?php } ?>	
												</select>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height="">Titulo</h6>
												</div>
												<div class="col-sm-9">
													<input type="text" name="titulo" class="form-control" placeholder="Ingrese el titulo" />
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
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/pesos2.gif" width="40px" height="">Precio en pesos $</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="precioPesos" class="form-control" placeholder="$" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/pesos2.gif" width="40px" height="">Precio en dolares USD</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="precioDolares" class="form-control" placeholder="$" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/reloj2.gif" width="40px" height="">Duracion del curso</h6>
												</div>
												<div class="col-sm-9">
													<input type="number" min="1"  name="duracion" class="form-control" placeholder="3 Meses" required />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Descripcion del curso</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="cursodesc" class="form-control" rows="6" maxlength="300"></textarea>
													<!--<input type="text" name="viddesc" class="form-control" placeholder="Ingrese una descripcion" />-->
												</div>
											</div>
											<div class="mb-3">
												<h6 for="inputProductDescription" class="form-label"><img src="../../../assetsNuevo/iconos/foto2.gif" width="40px" height=""> Miniatura</h6>
												<input class="form-control" type="file" name="file1" accept="jpg" multiple>
											</div>
											<button type="submit" name="agregarCursos-btn" class="btn btn-success"><img src="../../../assetsNuevo/iconos/ok2.gif" width="40px" height=""> Agregar</button>
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
<script src="js.js"></script>