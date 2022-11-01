<?php
include '../../../config.php';//BD
session_start();
$conectado = conectar();

//$_SESSION['id_empresa'] = $id_empresa = $_GET['id_empresa'];
//$_SESSION['id_curso'] = $id_curso = $_GET['id_curso'];
isset($_GET['id_empresa']) ? $id_empresa = $_GET['id_empresa'] : $id_empresa = '';
isset($_GET['id_curso']) ? $id_curso = $_GET['id_curso'] : $id_curso = '';
isset($_GET['id_profesor']) ? $id_profesor = $_GET['id_profesor'] : $id_profesor = '';

$resultado = $conectado->query("SELECT v.es_presentacion FROM videos AS v WHERE v.id_curso = '$id_curso'");
	
//echo $id_profesor;
	
$es_presentacion = $resultado->fetch_all(MYSQLI_ASSOC);

if($es_presentacion){
	foreach($es_presentacion as $tiene){
		if($tiene['es_presentacion'] == 'Y'){
			$mostrar = 'N';
			break;
		}else{
			$mostrar = 'Y';
		}
	}
}else{
	$mostrar = 'Y';
}


include 'Template/head.php';

?>

<body class="bg-theme bg-theme2" onload="habilitar();">
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
						<div class="parent-icon"><img src="../../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul>
					<li> <a href="agregarEmpresas.php"><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="../pagos.php"><img src="../../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="cuentas.php"><img src="../../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
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
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
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
							<div class="col-lg-10">
								<div class="card">
								<h2><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Nuevo Video</h2>
									<div class="card-body">
										<form action="acciones/crud.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height="">Titulo</h6>
												</div>
												<div class="col-sm-9">
                                                    <input type="hidden" name="id_profesor" class="form-control" value="<?php echo $id_profesor; ?>" />
                                                    <input type="hidden" name="id_empresa" class="form-control" value="<?php echo $id_empresa; ?>" />
                                                    <input type="hidden" name="id_curso" class="form-control" value="<?php echo $id_curso; ?>" />
													<input type="text" name="vidtitle" class="form-control" placeholder="Ingrese el titulo" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height="">Descripcion</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="viddesc" class="form-control" rows="6" maxlength="300"></textarea>
													<!--<input type="text" name="viddesc" class="form-control" placeholder="Ingrese una descripcion" />-->
												</div>
											</div>
											<div class="row mb-3">
												<!--<h6 for="inputProductDescription" class="form-label">Video</h6>
												<input class="form-control" type="file" name="file1" accept="video/*" multiple>-->
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="vimeo" checked="checked" value="V"><img src="../../../assetsNuevo/iconos/vimeo2.gif" width="40px" height=""> Link Vimeo</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="linkVimeo" id="linkVimeo" class="form-control" placeholder="Id Vimeo" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="youtube" value="Y"><img src="../../../assetsNuevo/iconos/youtube2.gif" width="40px" height=""> Link Youtube</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="linkYoutube" id="linkYoutube" class="form-control" placeholder="Link Youtube" />
												</div>
											</div>
											<!-- lo muestro solo si no hay ningun video de presentacion -->
											<?php if($mostrar == 'Y'){ ?>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Video de presentacion</h6>
												</div>
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="Y"> Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="N" checked="checked"> No</h6>
												</div>
											</div>
											<?php } ?>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 for="inputProductDescription" class="form-label"><img src="../../../assetsNuevo/iconos/foto2.gif" width="40px" height=""> Miniatura</h6>
												</div>
												<div class="col-sm-9">
													<input class="form-control" type="file" name="file1" accept="jpg" multiple>
												</div>
											</div>
											<button type="submit" name="uploadVideos-btn" class="btn btn-success"><img src="../../../assetsNuevo/iconos/ok2.gif" width="40px" height=""> Agregar</button>
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
<script src="../js.js"></script>