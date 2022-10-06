<?php
include '../../config.php';//BD
session_start();
$conectado = conectar();

$_SESSION['id_empresa'] = $id_empresa = $_GET['id_empresa'];
$_SESSION['id_curso'] = $id_curso = $_GET['id_curso'];

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
						<div class="menu-title">Tareas</div>
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
							<img src="../../assets/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">Pauline Seitz</p>
								<p class="designattion mb-0">Web Designer</p>
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
								<h2> + Nuevo Video</h2>
									<div class="card-body">
										<form action="../uploadVideos.php" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Titulo</h6>
												</div>
												<div class="col-sm-9">
													<input type="text" name="vidtitle" class="form-control" placeholder="Ingrese el titulo" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Descripcion</h6>
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
													<h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="vimeo" checked="checked" value="V"> Link Vimeo</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="linkVimeo" id="linkVimeo" class="form-control" placeholder="Id Vimeo" />
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="habilitar();" type="radio" name="link" id="youtube" value="Y"> Link Youtube</h6>
												</div>
												<div class="col-sm-9">
													<input type="text"  name="linkYoutube" id="linkYoutube" class="form-control" placeholder="Link Youtube" />
												</div>
											</div>
											<!-- lo muestro solo si no hay ningun video de presentacion -->
											<?php if($mostrar == 'Y'){ ?>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Video de presentacion</h6>
												</div>
												<div class="col-sm-3">
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="Y"> Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="presentacion" id="presentacion" value="N" checked="checked"> No</h6>
												</div>
											</div>
											<?php } ?>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 for="inputProductDescription" class="form-label">Miniatura</h6>
												</div>
												<div class="col-sm-9">
													<input class="form-control" type="file" name="file1" accept="jpg" multiple>
												</div>
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
<script src="js.js"></script>