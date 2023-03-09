<?php
session_start();
include '../../config.php';
$conectado = conectar();

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
	//header("location: ../login.php");
}

$id_usuario = $_SESSION['id_usuario'];
$id_profesor = $_SESSION['id_profesor'];

if(isset($_GET['id_curso'])){
	$id_curso = $_GET['id_curso'];
	$_SESSION['id_curso'] = $id_curso;
}
else{
	$id_curso = $_SESSION['id_curso'];
}
//$id_curso = $_SESSION['id_curso'];

$resultado = $conectado->query("SELECT * FROM videos AS v WHERE EXISTS(
	SELECT * FROM cursos AS c WHERE EXISTS(
	SELECT * FROM profesor AS p WHERE p.id = c.id_profesor
	AND v.id_curso = $id_curso AND p.id = $id_profesor))");

$videos = $resultado->fetch_all(MYSQLI_ASSOC);

include 'Template/head.php';
?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
			<ul class="metismenu" id="menu" aria-expanded="true">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><img src="../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
						<li> <a href="index.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Agregar Curso</a>
						</li>
                        <li> <a href="cursos.php"><img src="../../assetsNuevo/iconos/pass2.gif" width="40px" height=""> Ver Cursos</a>
						</li>
						<li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height=""> Pagos</a>
						</li>
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
                <h6 class="mb-0 text-uppercase"><img src="../../assetsNuevo/iconos/youtube2.gif" width="40px" height=""> Listado de videos</h6>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">						
						<?php
							foreach ($videos as $video) { ?>
							<form action="../eliminarEditarVideo.php" method="POST" enctype="multipart/form-data">
								<div class="col">
									<div class="card">
										<img src="../../uploads/videos/miniaturas/<?php echo $video["miniatura"] ?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title"><?php echo $video["titulo_video"] ?></h5>
											<p class="card-title"><?php echo $video["descripcion"] ?></p>
											<input type="hidden" name="id" id="id" value="<?php echo $video["id"] ?>">
											<button type="submit" name="edit-btn" class="btn btn-info"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height="">Editar</button>
											<button type="submit" name="delete-btn" class="btn btn-danger"><img src="../../assetsNuevo/iconos/borrar2.gif" width="40px" height="">Eliminar</button>
										</div>
									</div>
								</div>
							</form>
						<?php } ?>
                    </div>               
            </div>
        </div>

<script src='js.js'></script>   
<?php
include 'Template/footer.php';
?>