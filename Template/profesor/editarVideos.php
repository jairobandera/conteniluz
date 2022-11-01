<?php
session_start();
include '../../config.php';
$conectado = conectar();

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
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="cursos.php"><i class="bx bx-right-arrow-alt"></i>Ver Cursos</a>
						</li>
						<li> <a href="verVideos.php"><i class="bx bx-right-arrow-alt"></i>Ver Videos</a>
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
								<h2> Editar Video</h2>
									<div class="card-body">
										<form action="../eliminarEditarVideo.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Titulo</h6>
												</div>
												<div class="col-sm-9">
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $videos[0]['id']; ?>" />
													<input type="text" name="vidtitle" class="form-control" value="<?php echo $videos[0]['titulo_video']; ?>" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Descripcion</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="viddesc" class="form-control" rows="6" maxlength="300"><?php echo $videos[0]['descripcion']; ?></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<!--<h6 for="inputProductDescription" class="form-label">Video</h6>
												<input class="form-control" type="file" name="file1" accept="video/*" multiple>-->
												<div class="col-sm-3">
                                                    <h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="vimeo" value="V" <?php if($videos[0]['tipo'] == 'V'){ echo 'checked="checked"'; } ?>> Link Vimeo</h6>
                                                </div>
												<div class="col-sm-9">
													<input type="text"  name="linkVimeo" id="linkVimeo" class="form-control" value="<?php if($videos[0]['tipo'] == 'V'){ echo $videos[0]['id_video']; } ?>" />
												</div>
											</div>
											<div class="row mb-3">
												<!--<h6 for="inputProductDescription" class="form-label">Video</h6>
												<input class="form-control" type="file" name="file1" accept="video/*" multiple>-->
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="youtube" value="Y" <?php if($videos[0]['tipo'] == 'Y'){ echo 'checked="checked"'; } ?>> Link Youtube</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="linkYoutube" id="linkYoutube" class="form-control" value="<?php if($videos[0]['tipo'] == 'Y'){ echo $videos[0]['id_video']; } ?>" />
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Video de presentacion</h6>
												</div>
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="Y" <?php if($videos[0]['es_presentacion'] == 'Y'){ echo 'checked="checked"'; } ?>> Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="N" <?php if($videos[0]['es_presentacion'] == 'N'){ echo 'checked="checked"'; } ?>> No</h6>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 for="inputProductDescription" class="form-label">Miniatura</h6>
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
											<button type="submit" name="upload-btn" class="btn btn-success"><i class=""></i>Editar</button>
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