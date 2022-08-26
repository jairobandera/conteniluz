<?php
session_start();
include '../../config.php';
$conectado = conectar();

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
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="index.php"><i class="bx bx-right-arrow-alt"></i>Agregar Curso</a>
						</li>
                        <li> <a href="cursos.php"><i class="bx bx-right-arrow-alt"></i>Ver Cursos</a>
						</li>
						<li> <a href="pagos.php"><i class="bx bx-right-arrow-alt"></i>Pagos</a>
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
        <div class="page-wrapper">
			<div class="page-content">
                <h6 class="mb-0 text-uppercase">Listado de cursos</h6>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">						
						<?php
							foreach ($videos as $video) { ?>
							<form action="../eliminarEditarVideo.php" method="POST" enctype="multipart/form-data">
								<div class="col">
									<div class="card">
										<img src="../../assets/img/cursos/<?php echo $video["miniatura"] ?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title"><?php echo $video["titulo_video"] ?></h5>
											<p class="card-title"><?php echo $video["descripcion"] ?></p>
											<input type="hidden" name="id" id="id" value="<?php echo $video["id"] ?>">
											<button type="submit" name="edit-btn" class="btn btn-info"><i class=""></i>Editar</button>
											<button type="submit" name="delete-btn" class="btn btn-danger"><i class=""></i>Eliminar</button>
										</div>
									</div>
								</div>
							</form>
						<?php } ?>
                    </div>               
            </div>
        </div>

        
<?php
include 'Template/footer.php';
?>