<?php
session_start();
include '../../config.php';//BD
$conectado = conectar();

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
	//header("location: ../login.php");
}

$id_usuario = $_SESSION['id_usuario'];	

if(isset($_GET['id_curso'])){
    $id_curso = $_GET['id_curso'];
    $_SESSION['id_curso'] = $id_curso;
}
else{
    $id_curso = $_SESSION['id_curso'];
}

$resultado = $conectado->query("SELECT * FROM cursos WHERE id = $id_curso");    
$cursos = $resultado->fetch_all(MYSQLI_ASSOC);

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
					<h4 class="logo-text">Dashtrans</h4>
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
        <div class="page-wrapper">
			<div class="page-content">
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-10">
								<div class="card">
								<h2><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Editar Curso</h2>
									<div class="card-body">
										<form action="../validarEditarCursos.php" id="form" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Titulo</h6>
												</div>
												<div class="col-sm-9">
													<input type="text" name="vidtitle" class="form-control" value="<?php echo $cursos[0]['titulo_curso']; ?>"/>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/pesos2.gif" width="40px" height=""> Precio en pesos $</h6>
												</div>
												<div class="col-sm-9">
                                                <input type="text" name="precioPesos" class="form-control" value="<?php echo $cursos[0]['pesos']; ?>"/>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/pesos2.gif" width="40px" height=""> Precio en dolares USD</h6>
												</div>
												<div class="col-sm-9">
                                                <input type="text" name="precioDolares" class="form-control" value="<?php echo $cursos[0]['dolares']; ?>"/>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/reloj2.gif" width="40px" height=""> Duracion del curso</h6>
												</div>
												<div class="col-sm-9">
                                                <input type="number" name="duracion" min="1" class="form-control" value="<?php echo $cursos[0]['duracion']; ?>"/>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Descripcion del curso</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="cursodesc" class="form-control" rows="6" maxlength="300"><?php echo $cursos[0]['descripcion']; ?></textarea>
													<!--<input type="text" name="viddesc" class="form-control" placeholder="Ingrese una descripcion" />-->
												</div>
											</div>
											<div class="mb-3">
												<h6 for="inputProductDescription" class="form-label"><img src="../../assetsNuevo/iconos/foto2.gif" width="40px" height=""> Miniatura</h6>
												<input class="form-control" type="file" name="file1" accept="jpg" multiple>
											</div>
                                            <div class="row mb-sm-3">
                                                <div class="col-sm-3">
                                                    <img src="../../uploads/cursos/<?php echo $cursos[0]['miniatura']; ?>" width="100px" style="margin-bottom:5px;" alt="">
                                                </div>
                                            </div>
											<button type="submit" name="upload-btn" id="upload-btn" class="btn btn-success"><img src="../../assetsNuevo/iconos/ok2.gif" width="40px" height="">Guardar</button>
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