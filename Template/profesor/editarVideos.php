<?php
session_start();
include '../../config.php';
$conectado = conectar();

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
	//header("location: ../login.php");
}

$id = $_GET['id'];

$resultado = $conectado->query("SELECT * FROM videos WHERE id = $id");

$videos = $resultado->fetch_all(MYSQLI_ASSOC);

include 'Template/head.php';
?>

<body class="bg-theme bg-theme2" onload="habilitar();">
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
						<li> <a href="cursos.php"><img src="../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Cursos</a>
						</li>
						<li> <a href="verVideos.php"><img src="../../assetsNuevo/iconos/youtube2.gif" width="40px" height="">Ver Videos</a>
						</li>
						<li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
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
								<h2><img src="../../assetsNuevo/iconos/youtube2.gif" width="40px" height=""> Editar Video</h2>
									<div class="card-body">
										<form action="../eliminarEditarVideo.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Titulo</h6>
												</div>
												<div class="col-sm-9">
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $videos[0]['id']; ?>" />
													<input type="text" name="vidtitle" class="form-control" value="<?php echo $videos[0]['titulo_video']; ?>" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Descripcion</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="viddesc" class="form-control" rows="6" maxlength="300"><?php echo $videos[0]['descripcion']; ?></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<!--<h6 for="inputProductDescription" class="form-label">Video</h6>
												<input class="form-control" type="file" name="file1" accept="video/*" multiple>-->
												<div class="col-sm-3">
                                                    <h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="vimeo" value="V" <?php if($videos[0]['tipo'] == 'V'){ echo 'checked="checked"'; } ?>><img src="../../assetsNuevo/iconos/vimeo2.gif" width="40px" height=""> Link Vimeo</h6>
                                                </div>
												<div class="col-sm-9">
													<input type="text"  name="linkVimeo" id="linkVimeo" class="form-control" value="<?php if($videos[0]['tipo'] == 'V'){ echo $videos[0]['id_video']; } ?>" />
												</div>
											</div>
											<div class="row mb-3">
												<!--<h6 for="inputProductDescription" class="form-label">Video</h6>
												<input class="form-control" type="file" name="file1" accept="video/*" multiple>-->
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="youtube" value="Y" <?php if($videos[0]['tipo'] == 'Y'){ echo 'checked="checked"'; } ?>><img src="../../assetsNuevo/iconos/youtube2.gif" width="40px" height=""> Link Youtube</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="linkYoutube" id="linkYoutube" class="form-control" value="<?php if($videos[0]['tipo'] == 'Y'){ echo $videos[0]['id_video']; } ?>" />
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Video de presentacion</h6>
												</div>
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="Y" <?php if($videos[0]['es_presentacion'] == 'Y'){ echo 'checked="checked"'; } ?>> Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="N" <?php if($videos[0]['es_presentacion'] == 'N'){ echo 'checked="checked"'; } ?>> No</h6>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 for="inputProductDescription" class="form-label"><img src="../../assetsNuevo/iconos/foto2.gif" width="40px" height=""> Miniatura</h6>
												</div>
												<div class="col-sm-9">
													<input class="form-control" type="file" name="file1" accept="jpg" multiple>
												</div>
											</div>
                                            <div class="row mb-sm-3">
                                                <div class="col-sm-3">
                                                    <img src="../../uploads/videos/miniaturas/<?php echo $videos[0]['miniatura']; ?>" width="100px" style="margin-bottom:5px;" alt="">
                                                </div>
                                            </div>
											<button type="submit" name="upload-btn" class="btn btn-success"><img src="../../assetsNuevo/iconos/ok2.gif" width="40px" height="">Editar</button>
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
//include 'Template/footer.php';
?>
<script src="js.js"></script>